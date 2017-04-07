<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\EditorPick;
use App\Contact;
use App\Knowledge;
use App\StickNavbarFeed;
use App\StickTagFeed;

class EditController extends Controller
{
    public function TagsStory() {
        session()->put('navbar', 'edit');
        $storys = \App\Story::all();
        return view('admin.edit.tags_story')
            ->with('storys', $storys);
    }

    public function UpdateTagsStory(Request $request) {
        if ($request->tag1_id != 0) {
            $tag = \App\Tag::find($request->tag1_id);
            $tag->tag_name = $request->tag_1;
            $tag->save();
        }

        if ($request->tag2_id != 0) {
            $tag = \App\Tag::find($request->tag2_id);
            $tag->tag_name = $request->tag_2;
            $tag->save();
        }

        if ($request->tag3_id != 0) {
            $tag = \App\Tag::find($request->tag3_id);
            $tag->tag_name = $request->tag_3;
            $tag->save();
        }

        if ($request->tag4_id != 0) {
            $tag = \App\Tag::find($request->tag4_id);
            $tag->tag_name = $request->tag_4;
            $tag->save();
        }

        if ($request->tag5_id != 0) {
            $tag = \App\Tag::find($request->tag5_id);
            $tag->tag_name = $request->tag_5;
            $tag->save();
        }

        return redirect()->back();
    }

    public function EditorPick() {
        session()->put('navbar', 'edit');
        $storys = \App\Story::all();
        return view('admin.edit.editor_pick')
            ->with('storys', $storys);
    }

    public function UpdateEditorPick(Request $request) {
        $check_editor_pick = \App\EditorPick::find(1);
        if ($check_editor_pick) {
            $editor_pick = \App\EditorPick::find(1);
            $editor_pick->story_id_1 = $request->editor_pick_1;
            $editor_pick->story_id_2 = $request->editor_pick_2;
            $editor_pick->story_id_3 = $request->editor_pick_3;
            $editor_pick->story_id_4 = $request->editor_pick_4;
            $editor_pick->story_id_5 = $request->editor_pick_5;
            $editor_pick->save();
        } else {
            $editor_pick = new EditorPick;
            $editor_pick->story_id_1 = $request->editor_pick_1;
            $editor_pick->story_id_2 = $request->editor_pick_2;
            $editor_pick->story_id_3 = $request->editor_pick_3;
            $editor_pick->story_id_4 = $request->editor_pick_4;
            $editor_pick->story_id_5 = $request->editor_pick_5;
            $editor_pick->save();
        }
        return redirect()->back();
    }

    public function Contact(Request $request) {
        session()->put('navbar', 'edit');
        $check_contact = \App\Contact::find(1);
        $contact_title = "";
        $contact_detail = "";
        if ($check_contact) {
            $contact_title = $check_contact->contact_title;
            $contact_detail = $check_contact->contact_detail;
        }
        return view('admin.edit.contact')
            ->with('contact_title', $contact_title)
            ->with('contact_detail', $contact_detail);
    }

    public function UpdateContact(Request $request) {
        $check_contact = \App\Contact::find(1);
        if ($check_contact) {
            $contact = \App\Contact::find(1);
            $contact->contact_title = $request->contact_title;
            $contact->contact_detail = $request->contact_detail;
            $contact->save();
        } else {
            $contact = new Contact;
            $contact->contact_title = $request->contact_title;
            $contact->contact_detail = $request->contact_detail;
            $contact->save();
        }
        return redirect()->back();
    }

    public function Knowledge() {
        session()->put('navbar', 'edit');
        $knowledges = \App\Knowledge::all();
        return view('admin.edit.knowledge')
            ->with('knowledges', $knowledges);
    }

    public function InsertKnowledge(Request $request) {
        $count_sort = \App\Knowledge::all();
        $knowledge = new Knowledge;
        $knowledge->tag_id = $request->tag_id;
        $knowledge->sort = count($count_sort) + 1;
        $knowledge->save();
        return redirect()->back();
    }

    public function UpdateSortKnowledge(Request $request) {
        $knowledge = \App\Knowledge::find($request->id);
        $knowledge->sort = $request->sort;
        $knowledge->save();
        return redirect()->back();
    }

    public function DeleteSortKnowledge(Request $request) {
        $knowledge = \App\Knowledge::find($request->id)->delete();
        return redirect()->back();
    }

    public function PinStory() {
        session()->put('navbar', 'edit');
        $pin_story = \App\StickNavbarFeed::find(1);
        if (!$pin_story) {
            $create_pin = new StickNavbarFeed;
            $create_pin->story_id_1 = 0;
            $create_pin->story_id_2 = 0;
            $create_pin->save();
        }
        return view('admin.edit.pin_story')
            ->with('pin_story', $pin_story);
    }

    public function UpdatePinStory(Request $request) {
        $pin_story = \App\StickNavbarFeed::find(1);
        if ($request->story_id_1) {
            $pin_story->story_id_1 = $request->story_id_1;
        } else {
            $pin_story->story_id_2 = $request->story_id_2;
        }
        $pin_story->save();
        return redirect()->back();
    }

    public function DisablePinStory(Request $request) {
        $pin_story = \App\StickNavbarFeed::find(1);
        if ($request->id == 1) {
            $pin_story->story_id_1 = 0;
        } else {
            $pin_story->story_id_2 = 0;
        }
        $pin_story->save();
        return redirect()->back();
    }

    public function PinStoryTag() {
        session()->put('navbar', 'edit');
        $tags = \App\Tag::all();
        return view('admin.edit.pin_story_tag')
            ->with('tags', $tags);
    }

    public function UpdatePinStoryTag(Request $request) {

        $pin_tag = \App\StickTagFeed::find($request->id);

        if ($pin_tag) {
            $pin_tag->story_id = $request->story_id;
            $pin_tag->save();
        } else {
            $create_pin_tag = new StickTagFeed;
            $create_pin_tag->tag_id = $request->id;
            $create_pin_tag->story_id = $request->story_id;
            $create_pin_tag->save();
        }

        return redirect()->back();
    }
}
