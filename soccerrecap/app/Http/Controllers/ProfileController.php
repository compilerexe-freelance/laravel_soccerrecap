<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Profile;

class ProfileController extends Controller
{
    public function Profile(Request $request) {
        session()->put('navbar', null);
        return view('profile');
    }

    public function Setting() {
        session()->put('navbar', null);
        return view('setting');
    }

    public function UpdateImage(Request $request) {
        $request->file('image_profile')->storeAs('image_profiles', $request->user()->id);

        $profile = \App\Profile::find($request->user()->id);
        $profile->image_profile = $request->user()->id;
        $profile->save();

        return redirect()->back();
    }

    public function UpdateDescribe(Request $request) {
        $profile = \App\Profile::find($request->user()->id);
        $profile->describe_profile = $request->describe_profile;
        $profile->save();
        return redirect()->back();
    }
}
