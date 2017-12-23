@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-sm jumbotron-fluid">
    <div class="container">
        <div class="d-flex align-items-center">
            <h1 class="mr-auto">{{ $issue->name }}</h1>
            <div>
                <a href="#edit" class="btn btn-secondary">Edit</a>
                <a href="#close" class="btn btn-primary">Complete</a>
            </div>
        </div>
        Created {{ $issue->created_at->diffForHumans() }}
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-3 order-sm-2">
            <h4>Author</h4>
            @include('blocks/user-tiny', ['user' => $issue->author])

            <h4>Assigned to</h4>
            @include('blocks/user-tiny', ['user' => $issue->owner])

            <h4>Watchers</h4>
            <p>(TODO)</p>
        </div>
        <div class="col-sm">
            {{ $issue->description }}
        </div>
    </div>
</div>
@endsection
