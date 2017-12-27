@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-sm jumbotron-fluid">
    <div class="container">
        <div class="d-flex align-items-center">
            <h1 class="mr-auto">{{ $issue->name }}</h1>
            <form action="{{ route('issue_toggle_close', ['issue' => $issue]) }}" method="post">
                {{ csrf_field() }}
                <a href="{{ route('issue_edit', ['issue' => $issue]) }}" class="btn btn-secondary">Edit</a>
                @if ($issue->status->closed)
                    <button type="submit" class="btn btn-warning">Reopen</button>
                @else
                    <button type="submit" class="btn btn-primary">Complete</button>
                @endif
            </form>
        </div>
        Created {{ $issue->created_at->diffForHumans() }}&ensp;
        <span class="badge badge-secondary">{{ $issue->status->name }}</span>
        @if ($issue->priority->value == 0)
            <span class="badge badge-secondary">{{ $issue->priority->name }}</span>
        @elseif ($issue->priority->value < 1)
            <span class="badge badge-info">{{ $issue->priority->name }}</span>
        @else
            <span class="badge badge-danger">{{ $issue->priority->name }}</span>
        @endif
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-3 order-sm-2">
            <h4>Author</h4>
            @include('blocks.user-tiny', ['user' => $issue->author])

            <h4>Assigned to</h4>
            @include('blocks.user-tiny', ['user' => $issue->owner])

            <h4>Watchers</h4>
            <p>(TODO)</p>
        </div>
        <div class="col-sm">
            {{ $issue->description }}
        </div>
    </div>
</div>
@endsection
