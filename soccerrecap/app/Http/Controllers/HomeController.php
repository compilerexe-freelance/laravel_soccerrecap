<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Story;
use App\Tag;
use App\Report;
use App\StickNavbarFeed;

class HomeController extends Controller
{
    public function Home() {

        // Report visitor
        $field_check = \App\Report::find(1);
        if ($field_check) {
            $field_check->count_visitor = ++$field_check->count_visitor;
            $field_check->save();
        } else {
            $visitor = new Report;
            $visitor->count_visitor = 1;
            $visitor->save();
        }

        session()->put('navbar', 'home');
        $storys = \App\Story::orderBy('id', 'desc')->get();
        $tags = \App\Tag::orderByRaw('RAND()')->limit(20)->get();

        // Contact
        $contact_title = "";
        $contact_detail = "";
        $check_contact = \App\Contact::find(1);
        if ($check_contact) {
            $contact_title = $check_contact->contact_title;
            $contact_detail = $check_contact->contact_detail;
        }

        // Pin Story
        $pin_story = \App\StickNavbarFeed::find(1);
        if (!$pin_story) {
            $create_pin = new StickNavbarFeed;
            $create_pin->story_id_1 = 0;
            $create_pin->story_id_2 = 0;
            $create_pin->save();
        }

        return view('home')
            ->with('storys', $storys)
            ->with('tags', $tags)
            ->with('contact_title', $contact_title)
            ->with('contact_detail', $contact_detail)
            ->with('pin_story', $pin_story);
    }

    public function FollowingUsers(Request $request) {
        Session()->put('navbar', 'following');
        $follows_users = \App\FollowsMember::where('member_id', $request->user()->id)->get();

        // Pin Story
        $pin_story = \App\StickNavbarFeed::find(1);
        if (!$pin_story) {
            $create_pin = new StickNavbarFeed;
            $create_pin->story_id_1 = 0;
            $create_pin->story_id_2 = 0;
            $create_pin->save();
        }

        return view('following_users')
            ->with('follows_users', $follows_users)
            ->with('pin_story', $pin_story);
    }

    public function FollowingTags(Request $request) {
        Session()->put('navbar', 'following');
        $follows_tags = \App\FollowsTag::where('member_id', $request->user()->id)->get();

        // Pin Story
        $pin_story = \App\StickNavbarFeed::find(1);
        if (!$pin_story) {
            $create_pin = new StickNavbarFeed;
            $create_pin->story_id_1 = 0;
            $create_pin->story_id_2 = 0;
            $create_pin->save();
        }

        return view('following_tags')
            ->with('follows_tags', $follows_tags)
            ->with('pin_story', $pin_story);
    }

    public function TopStories() {
        Session()->put('navbar', 'top_stories');
        // Pin Story
        $pin_story = \App\StickNavbarFeed::find(1);
        if (!$pin_story) {
            $create_pin = new StickNavbarFeed;
            $create_pin->story_id_1 = 0;
            $create_pin->story_id_2 = 0;
            $create_pin->save();
        }

        return view('top_stories')
            ->with('pin_story', $pin_story);
    }

    public function Bookmarks() {
        Session()->put('navbar', 'bookmarks');
        // Pin Story
        $pin_story = \App\StickNavbarFeed::find(1);
        if (!$pin_story) {
            $create_pin = new StickNavbarFeed;
            $create_pin->story_id_1 = 0;
            $create_pin->story_id_2 = 0;
            $create_pin->save();
        }

        return view('bookmarks')
            ->with('pin_story', $pin_story);
    }

    public function Search(Request $request) {

        Session()->put('navbar', null);

        $tags = \App\Tag::groupBy('story_id')
            ->orderBy('created_at', 'desc')
            ->where('tag_name', 'LIKE', '%'.$request->keyword.'%')
            ->get();
        if ($tags->count()) {
            $data = array("tags", $tags);
        } else {

            $storys = \App\Story::groupBy('id')
                ->orderBy('created_at', 'desc')
                ->where('story_title', 'LIKE', '%'.$request->keyword.'%')
                ->get();
            if ($storys->count()) {
                $data = array("storys", $storys);
            } else {

                $members = \App\Member::where('username', 'LIKE', '%'.$request->keyword.'%')->get();
                if($members->count()) {
                    $data = array("members", $members);
                }   else {
                    $data = "not found anything.";
                }

            }

        }

        return view('search')
            ->with('keyword', $request->keyword)
            ->with('data', $data);
    }

    public function Tag(Request $request) {
        Session()->put('navbar', null);
        $tag = \App\Tag::find($request->id);
        $nearby_tags = \App\Tag::where('tag_name', $tag->tag_name)->orderBy('created_at', 'desc')->get();
        $current_sort = "Current sort by latest";

        return view('tag')
            ->with('tag', $tag)
            ->with('nearby_tags', $nearby_tags)
            ->with('current_sort', $current_sort);
    }

    public function TagSortByLike(Request $request) {
        Session()->put('navbar', null);
        $tag = \App\Tag::find($request->id);
        $nearby_tags = \App\Tag::where('tag_name', $tag->tag_name)->get();
        $current_sort = "Current sort by like";

        return view('tag')
            ->with('tag', $tag)
            ->with('nearby_tags', $nearby_tags)
            ->with('current_sort', $current_sort);
    }

    public function NotificationCheck(Request $request) {
        $notifications = \App\FollowsMember::where('follow_member_id', $request->member_id)->orderBy('created_at', 'desc')->limit(1)->first();
        $fillter_username = \App\Member::find($notifications->member_id);
        return json_encode($fillter_username);
    }

    public function Contact() {
        $check_contact = \App\Contact::find(1);
        $contact_title = "";
        $contact_detail = "";
        if ($check_contact) {
            $contact_title = $check_contact->contact_title;
            $contact_detail = $check_contact->contact_detail;
        }
        return view('contact')
            ->with('contact_title', $contact_title)
            ->with('contact_detail', $contact_detail);
    }

}
