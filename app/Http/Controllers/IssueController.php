<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class IssueController extends Controller
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
     * Browse all issues.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO: add filtering
        $issues = \App\Issue::all();
        return view('issues.browse')
            ->with('issues', $issues)
            ->with('issuePriorities', \App\IssuePriority::all())
            ->with('issueStatuses', \App\IssueStatus::all())
            ->with('title', 'Issues');
    }

    /**
     * View a single issue
     *
     * @param  \App\Issue $issue
     * @return \Illuminate\Http\Response
     */
    public function single(\App\Issue $issue)
    {
        return view('issues.single')
                ->with('issue', $issue)
                ->with('title', sprintf('#%s %s', $issue->id, $issue->name));
    }

    /**
     * Show issue creation page
     *
     * @param  string $type
     * @return \Illuminate\Http\Response
     */
    public function create($type = null)
    {
        $statuses = \App\IssueStatus::all();
        $priorities = \App\IssuePriority::all()->sortByDesc('value');
        $users = \App\User::all()->sortBy('name');
        return view('issues.new')
                ->with('specifiedType', $type)
                ->with('issueStatuses', $statuses)
                ->with('issuePriorities', $priorities)
                ->with('users', $users)
                ->with('title', 'New Issue');
    }

    /**
     * Create a new issue
     *
     * @return \Illuminate\Http\Response
     */
    public function createPost(Request $request)
    {
        $issue = \App\Issue::create([
            'name' => $request->input('name'),
            'size_estimate' => $request->input('size_estimate'),
            'type_id' => $request->input('type_id'),
            'status_id' => $request->input('status_id'),
            'priority_value' => $request->input('priority_value'),
            'author_id' => $request->input('author_id', Auth::id()),
            'owner_id' => $request->input('owner_id'),
            'description' => $request->input('description'),
        ]);
        return redirect()->route('issue_single', ['id' => $issue->id]);
    }
}
