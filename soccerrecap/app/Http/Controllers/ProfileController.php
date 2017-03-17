<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function Profile() {
        session()->put('navbar', null);
        return view('profile');
    }

    public function Setting() {
        session()->put('navbar', null);
        return view('setting');
    }
}
