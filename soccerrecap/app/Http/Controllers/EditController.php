<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\EditorPick;

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
}
