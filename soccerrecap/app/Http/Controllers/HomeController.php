<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Story;
use App\Tag;
use App\Report;

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

        return view('home')
            ->with('storys', $storys)
            ->with('tags', $tags)
            ->with('contact_title', $contact_title)
            ->with('contact_detail', $contact_detail);
    }

    public function FollowingUsers(Request $request) {
        Session()->put('navbar', 'following');
        $follows_users = \App\FollowsMember::where('member_id', $request->user()->id)->get();
        return view('following_users')
            ->with('follows_users', $follows_users);
    }

    public function FollowingTags(Request $request) {
        Session()->put('navbar', 'following');
        $follows_tags = \App\FollowsTag::where('member_id', $request->user()->id)->get();
        return view('following_tags')
            ->with('follows_tags', $follows_tags);
    }

    public function TopStories() {
        Session()->put('navbar', 'top_stories');
        return view('top_stories');
    }

    public function Bookmarks() {
        Session()->put('navbar', 'bookmarks');
        return view('bookmarks');
    }

    public function Search() {
        Session()->put('navbar', null);
        return view('search');
    }

    public function Tag(Request $request) {
        Session()->put('navbar', null);
        $tag = \App\Tag::find($request->id);
        $nearby_tags = \App\Tag::where('tag_name', $tag->tag_name)->get();
        return view('tag')
            ->with('tag', $tag)
            ->with('nearby_tags', $nearby_tags);
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
