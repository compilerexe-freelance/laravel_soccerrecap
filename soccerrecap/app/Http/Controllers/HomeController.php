<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    public function Home() {
        session()->put('navbar', 'home');
        return view('home');
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
