<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Auth;
use Hash;
use App\Member;
use App\Profile;
use App\SettingMember;
use App\PermissionMember;
use App\Bookmark;
use Socialite;
use App\FacebookLogin;

class MemberController extends Controller
{

    public function SignUp(Request $request) {

        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:member|min:2|max:15',
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
        $setting->status_new_sletter = 1;
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

            if ($request->remember == 1) {

                if (Auth::attempt(['email' => $request->sign_in_email,
                    'password' => $request->sign_in_password], true)) {
                    return redirect('/');
                } else {
                    return redirect('/')
                        ->withInput($request->except('sign_in_password'))
                        ->with('status_sign_in', 'fail');
                }

            } else {

                // Not remember
                if (Auth::attempt(['email' => $request->sign_in_email,
                    'password' => $request->sign_in_password])) {
                    return redirect('/');
                } else {
                    return redirect('/')
                        ->withInput($request->except('sign_in_password'))
                        ->with('status_sign_in', 'fail');
                }

            }

        } else {
            return redirect('/');
        }
    }

    public function SignOut() {
        Auth::logout();
        session()->flush();
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

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request)
    {
        $user = Socialite::driver('facebook')->fields(['id', 'email', 'name', 'first_name', 'last_name'])->user();



        $check_facebook_login = \App\Member::where('email', $user->email)
            ->first();

        if (!$check_facebook_login) {
            $member = new Member;
            $member->username = $user->user['first_name'];

            if ($user->email == null) {
                $member->email = $user->id;
            } else {
                $member->email = $user->email;
            }

            $member->facebook_id = $user->id;
            $member->password = Hash::make($user->id);
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
        }
//        else {
//            return redirect('/')
//                ->with('facebook_error', 'fail')
//                ->with('facebook_email', $user->email);
//        }

        if ($user->email == null) {
            if (Auth::attempt(['email' => $user->id, 'password' => $user->id], true)) {
                return redirect('/');
            }
        } else {
            if (Auth::attempt(['email' => $user->email, 'password' => $user->id], true)) {
                return redirect('/');
            }
        }

    }
}
