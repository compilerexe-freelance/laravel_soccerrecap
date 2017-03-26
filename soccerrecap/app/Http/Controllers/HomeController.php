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

    public function Following() {
        Session()->put('navbar', 'following');
        return view('following');
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

}
