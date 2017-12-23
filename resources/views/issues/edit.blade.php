@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Edit Issue
                </div>
                <div class="card-body">
                    @include('blocks.issues.edit-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
