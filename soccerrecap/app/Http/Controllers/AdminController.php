<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;

class AdminController extends Controller
{
    public function Main() {
        session()->put('navbar', 'main');
        $visitors = \App\Report::find(1);
        return view('admin.main')
            ->with('count_visitor', $visitors->count_visitor);
    }
}
