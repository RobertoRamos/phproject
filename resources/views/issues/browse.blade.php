@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Issues</h1>
    <div class="card mt-3">
        <div class="card-header">
            <form action="{{ route('issues') }}" class="form-inline d-flex w-100 align-items-center justify-content-between">
                <ul class="nav nav-pills">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Type
                        </a>
                        <div class="dropdown-menu">
                            @foreach ($issueTypes as $type)
                                <a class="dropdown-item" href="#" data-id="{{ $type->id }}">{{ $type->name }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Status
                        </a>
                        <div class="dropdown-menu">
                            @foreach ($issueStatuses as $status)
                                <a class="dropdown-item" href="#" data-id="{{ $status->id }}">{{ $status->name }}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Priority
                        </a>
                        <div class="dropdown-menu">
                            @foreach ($issuePriorities as $priorities)
                                <a class="dropdown-item" href="#" data-id="{{ $priorities->id }}">{{ $priorities->name }}</a>
                            @endforeach
                        </div>
                    </li>
                </ul>
                <input type="search" class="form-control" placeholder="Filter items">
            </form>
        </div>
        <div class="list-group list-group-flush">
            @foreach ($issues as $issue)
                @include('blocks.issues.list-item', ['issue' => $issue])
            @endforeach
        </div>
    </div>
</div>
@endsection
