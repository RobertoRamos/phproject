@extends('layouts.app')

@section('content')
<div class="container mt-3">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Assigned Issues
        </div>
        <div class="list-group list-group-flush">
            @foreach ($issues as $issue)
                <a class="list-group-item list-group-item-action" href="{{ url('/issues/{$issue->id}') }}">
                    {{ $issue->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
