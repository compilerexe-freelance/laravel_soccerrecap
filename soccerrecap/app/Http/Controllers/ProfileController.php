<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Validator;

use Image;
use App\Profile;
use App\Member;
use App\Story;
use App\Tag;
use App\StoryCount;
use App\FollowsMember;
use App\FollowsTag;
use App\NotificationFollow;

class ProfileController extends Controller
{
    public function Profile(Request $request) {
        \App::setLocale(session()->get('locale'));
        session()->put('navbar', null);
        $profile = \App\Profile::find($request->user()->id);
        $following = \App\FollowsMember::where('member_id', $request->user()->id)->get();
        $followers = \App\FollowsMember::where('follow_member_id', $request->user()->id)->get();
        $tag_following = \App\FollowsTag::where('member_id', $request->user()->id)->get();

        // Result like
        $total_like = 0;
        $storys = \App\Story::all();
        foreach ($storys as $story) {
            if ($story->member_id == $request->user()->id) {
                $story_count = \App\StoryCount::find($story->id);
                $total_like = $total_like + $story_count->count_like;
            }
        }

        $storys = \App\Story::where('member_id', $request->user()->id)->orderBy('created_at', 'desc')->get();

        return view('profile')
            ->with('profile', $profile)
            ->with('total_like', $total_like)
            ->with('storys', $storys)
            ->with('following', count($following))
            ->with('followers', count($followers))
            ->with('tag_following', count($tag_following));
    }

    public function MyStories(Request $request) {
        \App::setLocale(session()->get('locale'));
        session()->put('navbar', null);
        $storys = \App\Story::where('member_id', $request->user()->id)->orderBy('created_at', 'desc')->get();
        return view('my_stories')
            ->with('storys', $storys);
    }

    public function GetUpdateStory(Request $request) {
        \App::setLocale(session()->get('locale'));
        $story = \App\Story::find($request->id);
        $tags = \App\Tag::where('story_id', $story->id)->get();
        return view('update_story')
            ->with('story', $story)
            ->with('tags', $tags);
    }

    public function PostUpdateStory(Request $request) {

        $story = \App\Story::find($request->id);

        if ($request->file('story_picture')) {
            $file = $request->file('story_picture');
            $filename = $request->id;
            $path = "uploads/story_pictures";
            $file->move($path, $filename);
        }

        $story->member_id = $request->user()->id;
        $story->story_title = $request->story_title;
        $story->story_detail = $request->story_detail;
        $story->save();

        for ($i = 1; $i <= 5; $i++) {

            $tag = \App\Tag::find($request->get('tag_id_'.$i));
            if ($request->get('tag_'.$i) != null) {
                if ($tag) {
                    $tag->tag_name = $request->get('tag_'.$i);
                    $tag->save();
                } else {
                    $create_tag = new Tag;
                    $create_tag->story_id = $request->id;
                    $create_tag->tag_name = $request->get('tag_'.$i);
                    $create_tag->save();
                }
            } else {
                if ($tag) {
                    $tag->delete();
                }
            }

        }

        return redirect('my_stories');

    }

    public function SettingMember(Request $request) {
        \App::setLocale(session()->get('locale'));
        session()->put('navbar', null);
        $setting = \App\SettingMember::find($request->user()->id);
        return view('setting')
            ->with('setting', $setting);
    }

    public function UpdateNewsletter(Request $request) {
        $setting = \App\SettingMember::find($request->user()->id);
        $setting->status_new_sletter = $request->status_new_sletter;
        $setting->save();
        return redirect()->back();
    }

    public function UpdateImage(Request $request) {
//        $request->file('profile_image')->storeAs('profile_images', $request->user()->id);
        $file = $request->file('profile_image');
        $filename = $request->user()->id;
        $path = "uploads/profile_images/".$filename;
        Image::make($file->getRealPath())->resize(100, 100)->orientate()->save($path);
//        $file->move($path, $filename);
        return redirect()->back();
    }

    public function UpdateCover(Request $request) {
//        $request->file('cover_profile')->storeAs('profile_covers', $request->user()->id);
        $file = $request->file('cover_profile');
        $filename = $request->user()->id;
        $path = "uploads/profile_covers";
        $file->move($path, $filename);
        return redirect()->back();
    }

    public function UpdateDescribe(Request $request) {
        $profile = \App\Profile::find($request->user()->id);
        $profile->describe_profile = $request->describe_profile;
        $profile->save();
        return redirect()->back();
    }

    public function UpdatePassword(Request $request) {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
//            $errors = $validator->errors();
            return redirect('setting')
                ->withErrors($validator)
                ->withInput();
        }

        $member = \App\Member::find($request->user()->id);
        $member->password = Hash::make($request->password);
        $member->save();
        return redirect('sign_out');
    }

    public function UserProfile(Request $request) {
        \App::setLocale(session()->get('locale'));
        $member = \App\Member::find($request->id);
        $profile = \App\Profile::find($request->id);
        $followers = \App\FollowsMember::where('follow_member_id', $request->id)->get();
        $following = \App\FollowsMember::where('member_id', $request->id)->get();
        $tag_following = \App\FollowsTag::where('member_id', $request->id)->get();

        // Result like
        $total_like = 0;
        $storys = \App\Story::all();
        foreach ($storys as $story) {
            if ($story->member_id == $request->id) {
                $story_count = \App\StoryCount::find($story->id);
                $total_like = $total_like + $story_count->count_like;
            }
        }

        $storys = \App\Story::where('member_id', $request->id)->get();

        return view('view_profile')
            ->with('member', $member)
            ->with('profile', $profile)
            ->with('total_like', $total_like)
            ->with('storys', $storys)
            ->with('followers', count($followers))
            ->with('following', count($following))
            ->with('tag_following', count($tag_following));
    }

    public function Follow(Request $request) {

        $duplicate_check = \App\FollowsMember::where('member_id', $request->user()->id)
            ->where('follow_member_id', $request->id)
            ->first();

        if (!$duplicate_check) {
            $follow = new FollowsMember;
            $follow->member_id = $request->user()->id;
            $follow->follow_member_id = $request->id;
            $follow->save();

            $notification_follow = new NotificationFollow;
            $notification_follow->follows_id = $follow->id;
            $notification_follow->alert_member_id = $request->id;
            $notification_follow->status = 1;
            $notification_follow->save();
        }

    }

    public function Unfollow(Request $request) {
//        \App\FollowsMember::where('member_id', $request->user()->id)
//            ->where('follow_member_id', $request->id)
//            ->delete();
        $follows_member = \App\FollowsMember::where('member_id', $request->user()->id)
            ->where('follow_member_id', $request->id)
            ->first();

        \App\NotificationFollow::where('follows_id', $follows_member->id)->delete();
        $follows_member->delete();
    }

    public function ListFollowers(Request $request) {
        \App::setLocale(session()->get('locale'));
        session()->put('navbar', null);
        if ($request->user()->id != $request->id) {
            return redirect('profile');
        }
        $list_followers = \App\FollowsMember::where('follow_member_id', $request->id)->get();
        return view('list_followers')
            ->with('list_followers', $list_followers);
    }

    public function ListTagFollowing(Request $request) {
        \App::setLocale(session()->get('locale'));
        session()->put('navbar', null);
        if ($request->user()->id != $request->id) {
            return redirect('profile');
        }
        $list_tag_followings = \App\FollowsTag::where('member_id', $request->user()->id)->get();
        return view('list_tag_following')
            ->with('list_tag_followings', $list_tag_followings);
    }

    public function OtherListFollowers(Request $request) {
        \App::setLocale(session()->get('locale'));
        session()->put('navbar', null);
        $list_followers = \App\FollowsMember::where('follow_member_id', $request->id)->get();
        return view('list_followers')
            ->with('list_followers', $list_followers);
    }

    public function OtherListTagFollowing(Request $request) {
        \App::setLocale(session()->get('locale'));
        session()->put('navbar', null);
        $list_tag_followings = \App\FollowsTag::where('member_id', $request->id)->get();
        return view('list_tag_following')
            ->with('list_tag_followings', $list_tag_followings);
    }

    public function TagFollow(Request $request) {
        $duplicate_check = \App\FollowsTag::where('member_id', $request->user()->id)
            ->where('follow_tag_id', $request->id)
            ->first();

        if (!$duplicate_check) {
            $follow = new FollowsTag;
            $follow->member_id = $request->user()->id;
            $follow->follow_tag_id = $request->id;
            $follow->save();
        }
    }

    public function TagUnfollow(Request $request) {
        \App\FollowsTag::where('member_id', $request->user()->id)
            ->where('follow_tag_id', $request->id)
            ->delete();
    }

}
