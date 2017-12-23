<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $issues = \App\Issue::where('owner_id', Auth::id())->get();
        return view('dashboard')->with('issues', $issues);
    }

    /**
     * Show a single user page.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function single(\App\User $user)
    {
        // Preload issue metadata
        $user->load([
            'authoredIssues.type',
            'authoredIssues.status',
            'authoredIssues.priority',
            'ownedIssues.type',
            'ownedIssues.status',
            'ownedIssues.priority',
        ]);
        return view('user.single')->with('user', $user);
    }
}
