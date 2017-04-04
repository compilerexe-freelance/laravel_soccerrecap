<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PermissionMember;

class ManageMember extends Controller
{
    public function SendMessage() {
        session()->put('navbar', 'member');
    }

    public function Permission() {
        session()->put('navbar', 'member');
        $permissions = \App\PermissionMember::all();
        return view('admin.member.permission')
            ->with('permissions', $permissions);
    }

    public function TemporarySuspendConfirm(Request $request) {
        $temporary_suspend = \App\PermissionMember::find($request->member_id);
        $temporary_suspend->temporary_suspend = 1;
        $temporary_suspend->save();
        return redirect()->back();
    }

    public function TemporarySuspendCancel(Request $request) {
        $temporary_suspend = \App\PermissionMember::find($request->member_id);
        $temporary_suspend->temporary_suspend = 0;
        $temporary_suspend->save();
        return redirect()->back();
    }

    public function SuspendedConfirm(Request $request) {
        $suspended = \App\PermissionMember::find($request->member_id);
        $suspended->suspended = 1;
        $suspended->save();
        return redirect()->back();
    }

    public function SuspendedCancel(Request $request) {
        $suspended = \App\PermissionMember::find($request->member_id);
        $suspended->suspended = 0;
        $suspended->save();
        return redirect()->back();
    }
}
