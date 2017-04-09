<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use Hash;
use App\Member;
use App\Profile;
use App\SettingMember;
use App\PermissionMember;
use App\Bookmark;

class MemberController extends Controller
{

    public function SignUp(Request $request) {

        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:member|min:8|max:15',
            'email' => 'required|unique:member',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
//            $errors = $validator->errors();
            return redirect('/')
                ->withErrors($validator)
                ->withInput();
        }

        $member = new Member;
        $member->username = $request->username;
        $member->email = $request->email;
        $member->password = Hash::make($request->password);
        $member->save();

        $profile = new Profile;
        $profile->member_id = $member->id;
        $profile->describe_profile = "Profile describe ...";
        $profile->save();

        $permission = new PermissionMember;
        $permission->member_id = $member->id;
        $permission->temporary_suspend = 0;
        $permission->suspended = 0;
        $permission->save();

        $setting = new SettingMember;
        $setting->member_id = $member->id;
        $setting->status_new_sletter = 0;
        $setting->save();

        return redirect('/')
            ->with('status_sign_up', 'success');
    }

    public function SignIn(Request $request) {

        // Check Permissions
        $status_permission = 0;
        $member = \App\Member::where('email', $request->sign_in_email)->first();
        if ($member) {
            $permissions = \App\PermissionMember::find($member->id);
            if ($permissions->suspended == 1) {
                $status_permission = 1;
            } else {
                if ($permissions->temporary_suspend == 1) {
                    $status_permission = 1;
                }
            }
        } else {
            $status_permission = 1;
        }

        if ($status_permission == 0) {
            if (Auth::attempt(['email' => $request->sign_in_email, 'password' => $request->sign_in_password])) {
                return redirect('/');
            } else {
                return redirect('/')
                    ->withInput($request->except('sign_in_password'))
                    ->with('status_sign_in', 'fail');
            }
        } else {
            return redirect('/');
        }

    }

    public function SignOut() {
        Auth::logout();
        return redirect('/');
    }

    public function Bookmark(Request $request) {
        $check_bookmark = \App\Bookmark::where('member_id', $request->user()->id)
            ->where('story_id', $request->story_id)
            ->first();
        if ($check_bookmark) {
            $check_bookmark->delete();
        } else {
            $bookmark = new Bookmark;
            $bookmark->member_id = $request->user()->id;
            $bookmark->story_id = $request->story_id;
            $bookmark->save();
        }
        return redirect()->back();
    }
}
