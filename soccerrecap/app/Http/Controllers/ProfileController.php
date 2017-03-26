<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Validator;

use App\Profile;
use App\Member;
use App\Story;
use App\Tag;

class ProfileController extends Controller
{
    public function Profile(Request $request) {
        session()->put('navbar', null);
        return view('profile');
    }

    public function MyStories(Request $request) {
        $storys = \App\Story::where('member_id', $request->user()->id)->get();
        return view('my_stories')
            ->with('storys', $storys);
    }

    public function GetUpdateStory(Request $request) {
        $story = \App\Story::find($request->id);
        $tags = \App\Tag::where('story_id', $story->id)->get();
        return view('update_story')
            ->with('story', $story)
            ->with('tags', $tags);
    }

    public function PostUpdateStory(Request $request) {

        $story = \App\Story::find($request->id);

        if ($request->file('story_picture')) {
            $request->file('story_picture')->storeAs('story_pictures', $request->id);
        }

        $story->member_id = $request->user()->id;
        $story->story_title = $request->story_title;
        $story->story_detail = $request->story_detail;
        $story->save();

        if (isset($request->tag_1)) {
            $tag = \App\Tag::find($request->tag_id_1);
            $tag->tag_name = $request->tag_1;
            $tag->save();
        }
        if (isset($request->tag_2)) {
            $tag = \App\Tag::find($request->tag_id_2);
            $tag->tag_name = $request->tag_2;
            $tag->save();
        }
        if (isset($request->tag_3)) {
            $tag = \App\Tag::find($request->tag_id_3);
            $tag->tag_name = $request->tag_3;
            $tag->save();
        }
        if (isset($request->tag_4)) {
            $tag = \App\Tag::find($request->tag_id_4);
            $tag->tag_name = $request->tag_4;
            $tag->save();
        }
        if (isset($request->tag_5)) {
            $tag = \App\Tag::find($request->tag_id_5);
            $tag->tag_name = $request->tag_5;
            $tag->save();
        }

        return redirect('my_stories');

    }

    public function Setting() {
        session()->put('navbar', null);
        return view('setting');
    }

    public function UpdateImage(Request $request) {
        $request->file('profile_image')->storeAs('profile_images', $request->user()->id);
        return redirect()->back();
    }

    public function UpdateCover(Request $request) {
        $request->file('cover_profile')->storeAs('profile_covers', $request->user()->id);
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
}
