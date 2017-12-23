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
                @include('blocks.issues.list-item', ['issue' => $issue])
            @endforeach
        </div>
    </div>
</div>
@endsection
