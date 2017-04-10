<?php

namespace App\Http\Controllers;

use App\Mail\Newsletter;
use App\StoryCount;
use Illuminate\Http\Request;
use Session;

use Auth;
use App\Story;
use App\Tag;
use App\Report;
use App\StickNavbarFeed;

class HomeController extends Controller
{
    public function Home(Request $request) {
        \App::setLocale(session()->get('locale'));

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
//            ->with('tags', $tags)
//            ->with('contact_title', $contact_title)
//            ->with('contact_detail', $contact_detail)
            ->with('pin_story', $pin_story);
    }

    public function FollowingUsers(Request $request) {
        \App::setLocale(session()->get('locale'));
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
        \App::setLocale(session()->get('locale'));
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
        \App::setLocale(session()->get('locale'));
        Session()->put('navbar', 'top_stories');
        // Pin Story
        $pin_story = \App\StickNavbarFeed::find(1);
        if (!$pin_story) {
            $create_pin = new StickNavbarFeed;
            $create_pin->story_id_1 = 0;
            $create_pin->story_id_2 = 0;
            $create_pin->save();
        }

        $filter_top_like = \App\StoryCount::orderBy('count_like', 'desc')->get();

        $January = array();
        $February = array();
        $March = array();
        $April = array();
        $May = array();
        $June = array();
        $July = array();
        $August = array();
        $September = array();
        $October = array();
        $November = array();
        $December = array();

        foreach ($filter_top_like as $item) {

            $month = \Carbon\Carbon::parse($item->created_at)->month;

            if ($month == 1) {

                if (count($January) <= 10) {
                    array_push($January, $item->story_id);
                }

            } else if ($month == 2) {

                if (count($February) <= 10) {
                    array_push($February, $item->story_id);
                }

            } else if ($month == 3) {

                if (count($March) <= 10) {
                    array_push($March, $item->story_id);
                }

            } else if ($month == 4) {

                if (count($April) <= 10) {
                    array_push($April, $item->story_id);
                }

            } else if ($month == 5) {

                if (count($May) <= 10) {
                    array_push($May, $item->story_id);
                }

            } else if ($month == 6) {

                if (count($June) <= 10) {
                    array_push($June, $item->story_id);
                }

            } else if ($month == 7) {

                if (count($July) <= 10) {
                    array_push($July, $item->story_id);
                }

            } else if ($month == 8) {

                if (count($August) <= 10) {
                    array_push($August, $item->story_id);
                }

            } else if ($month == 9) {

                if (count($September) <= 10) {
                    array_push($September, $item->story_id);
                }

            } else if ($month == 10) {

                if (count($October) <= 10) {
                    array_push($October, $item->story_id);
                }

            } else if ($month == 11) {

                if (count($November) <= 10) {
                    array_push($November, $item->story_id);
                }

            } else {

                if (count($December) <= 10) {
                    array_push($December, $item->story_id);
                }

            }

        }

        $list_month = array($January, $February, $March, $April, $May, $June, $July, $August, $September, $October, $November, $December);

        return view('top_stories')
            ->with('pin_story', $pin_story)
            ->with('list_month', $list_month);
    }

    public function Bookmarks() {
        \App::setLocale(session()->get('locale'));
        Session()->put('navbar', 'bookmarks');
        // Pin Story
        $pin_story = \App\StickNavbarFeed::find(1);
        if (!$pin_story) {
            $create_pin = new StickNavbarFeed;
            $create_pin->story_id_1 = 0;
            $create_pin->story_id_2 = 0;
            $create_pin->save();
        }

        $bookmarks = \App\Bookmark::all();

        return view('bookmarks')
            ->with('pin_story', $pin_story)
            ->with('bookmarks', $bookmarks);
    }

    public function Search(Request $request) {
        \App::setLocale(session()->get('locale'));
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
        \App::setLocale(session()->get('locale'));
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
        \App::setLocale(session()->get('locale'));
        Session()->put('navbar', null);
        $tag = \App\Tag::find($request->id);
        $nearby_tags = \App\Tag::where('tag_name', $tag->tag_name)->get();
        $current_sort = "Current sort by like";

        return view('tag')
            ->with('tag', $tag)
            ->with('nearby_tags', $nearby_tags)
            ->with('current_sort', $current_sort);
    }

//    public function NotificationCheck(Request $request) {
//        $notifications = \App\FollowsMember::where('follow_member_id', $request->member_id)->orderBy('created_at', 'desc')->limit(1)->first();
//        $fillter_username = \App\Member::find($notifications->member_id);
//        return json_encode($fillter_username);
//    }

    public function Contact() {
        \App::setLocale(session()->get('locale'));
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

    public function NotificationFetch() {
        return view('notification_fetch');
    }

    public function NotificationSeen(Request $request) {
        $notifications = \App\NotificationFollow::where('alert_member_id', $request->member_id)
            ->where('status', 1)
            ->get();
        foreach ($notifications as $notification) {
            $seen = \App\NotificationFollow::find($notification->id);
            $seen->status = 0;
            $seen->save();
        }
    }

}
