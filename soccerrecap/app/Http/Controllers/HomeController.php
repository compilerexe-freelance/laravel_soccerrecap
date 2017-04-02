<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Story;
use App\Tag;

class HomeController extends Controller
{
    public function Home() {
        session()->put('navbar', 'home');
        $storys = \App\Story::orderBy('id', 'desc')->get();
        $tags = \App\Tag::orderByRaw('RAND()')->limit(20)->get();
        return view('home')
            ->with('storys', $storys)
            ->with('tags', $tags);
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

}
