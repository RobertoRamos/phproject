@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-sm jumbotron-fluid">
    <div class="container d-flex">
        <div class="mr-4">
            {{-- TODO: set width via SCSS --}}
            <img src="{{ asset('img/default-avatar.svg') }}" width="72" class="img-fluid rounded-circle" alt>
        </div>
        <div>
            <h1>{{ $user->name }}</h1>
            {{ '@' . $user->username }}
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-3 order-sm-2">
            <h4>Groups</h4>
            <p>(TODO)</p>
        </div>
        <div class="col-sm">
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-assigned"
                        data-toggle="tab" href="#tab-content-assigned"
                        role="tab" aria-controls="tab-content-assigned" aria-selected="true">
                        Assigned issues
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tab-created"
                        data-toggle="tab" href="#tab-content-created"
                        role="tab" aria-controls="tab-content-created" aria-selected="false">
                        Created issues
                    </a>
                </li>
            </ul>
            <div class="tab-content mt-3">
                <div class="tab-pane active" id="tab-content-assigned" aria-labelledby="tab-assigned">
                    @include('blocks.issues.list', ['issues' => $user->authoredIssues])
                </div>
                <div class="tab-pane" id="tab-content-created" aria-labelledby="tab-created">
                    @include('blocks.issues.list', ['issues' => $user->ownedIssues])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
