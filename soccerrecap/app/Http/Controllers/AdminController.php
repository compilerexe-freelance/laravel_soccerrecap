<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;
use Auth;
use App\Administrator;
use Hash;
use Session;

class AdminController extends Controller
{
    public function Login() {
        return view('admin.login');
    }

    public function AuthAdmin(Request $request) {
        Auth::shouldUse('admin');
        if (Auth::guard('admin')->attempt([
            'username' => $request->username,
            'password' => $request->password],
            $request->username))
        {
            return redirect('admin/main');
        } else {
            return redirect()->route('administrator');
        }
    }

    public function Logout(Request $request) {
        Auth::guard('admin')->logout();
        return redirect('administrator');
    }

    public function Main(Request $request) {
        $request->session()->put('navbar', 'main');
        $visitors = \App\Report::find(1);
        return view('admin.main')
            ->with('count_visitor', $visitors->count_visitor);
    }
}
