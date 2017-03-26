<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Story;
use App\Tag;
use App\Profile;
use App\Comment;
use App\StoryCount;
use App\RememberLike;

class StoryController extends Controller
{
    public function ReadStory(Request $request) {
        session()->put('navbar', null);
        $story = \App\Story::find($request->id);
        $tags = \App\Tag::where('story_id', $story->id)->get();
        $member = \App\Member::find($story->member_id);
        $profile = \App\Profile::find($member->id);
        $comments = \App\Comment::where('story_id', $story->id)->get();
        $count = \App\StoryCount::find($story->id);
        $count->count_view = ++$count->count_view;
        $count->save();

        return view('read_story')
            ->with('story', $story)
            ->with('tags', $tags)
            ->with('member', $member)
            ->with('profile', $profile)
            ->with('comments', $comments)
            ->with('count', $count);
    }

    public function WriteStory() {
        session()->put('navbar', null);
        return view('write_story');
    }

    public function InsertStory(Request $request) {

        $story = new Story;

        $last_id = count($story->all());
        $last_id++;

        if ($request->file('story_picture')) {
            $request->file('story_picture')->storeAs('story_pictures', $last_id);
        }

        $story->member_id = $request->user()->id;
        $story->story_title = $request->story_title;
        $story->story_detail = $request->story_detail;
        $story->save();

        $count = new StoryCount;
        $count->story_id = $last_id;
        $count->count_view = 0;
        $count->count_like = 0;
        $count->save();

        if (isset($request->tag_1)) {
            $tag = new Tag;
            $tag->story_id = $last_id;
            $tag->tag_name = $request->tag_1;
            $tag->save();
        }
        if (isset($request->tag_2)) {
            $tag = new Tag;
            $tag->story_id = $last_id;
            $tag->tag_name = $request->tag_2;
            $tag->save();
        }
        if (isset($request->tag_3)) {
            $tag = new Tag;
            $tag->story_id = $last_id;
            $tag->tag_name = $request->tag_3;
            $tag->save();
        }
        if (isset($request->tag_4)) {
            $tag = new Tag;
            $tag->story_id = $last_id;
            $tag->tag_name = $request->tag_4;
            $tag->save();
        }
        if (isset($request->tag_5)) {
            $tag = new Tag;
            $tag->story_id = $last_id;
            $tag->tag_name = $request->tag_5;
            $tag->save();
        }

        return redirect('/');

    }

    public function PostComment(Request $request) {
        $comment = new Comment;
        $comment->story_id = $request->id;
        $comment->member_id = $request->user()->id;
        $comment->comment_detail = $request->comment_detail;
        $comment->save();
        return redirect()->back();
    }

    public function LikeStory(Request $request) {

        $member = \App\RememberLike::where('member_id', $request->user()->id)
            ->where('story_id', $request->id)
            ->first();

        if (!$member) {
            $count = \App\StoryCount::find($request->id);
            $count->count_like = ++$count->count_like;
            $count->save();

            $remember_like = new RememberLike;
            $remember_like->member_id = $request->member_id;
            $remember_like->story_id = $request->id;
            $remember_like->save();

            return $count->count_like;
        } else {
            $count = \App\StoryCount::find($request->id);
            return $count->count_like;
        }
    }

}
