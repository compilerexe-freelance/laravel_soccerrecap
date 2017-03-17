<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoryController extends Controller
{
    public function ReadStory() {
        session()->put('navbar', null);
        return view('read_story');
    }

    public function WriteStory() {
        session()->put('navbar', null);
        return view('write_story');
    }
}
