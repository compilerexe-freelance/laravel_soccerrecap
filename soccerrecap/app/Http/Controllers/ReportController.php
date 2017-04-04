<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Story;
use App\StoryCount;
use App\Member;
use App\FollowsMember;

class ReportController extends Controller
{
    public function Follows() {
        session()->put('navbar', 'report');
        $follows_member = \App\FollowsMember::all();
        return view('admin.report.follows')
            ->with('follows_member', $follows_member);
    }

    public function StoryLikes() {
        session()->put('navbar', 'report');
        $storys = \App\Story::all();
        return view('admin.report.story_likes')
            ->with('storys', $storys);
    }
}
