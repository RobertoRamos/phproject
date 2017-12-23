@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    New Issue
                </div>
                <div class="card-body">
                    <form action="{{ route('new_issue_post') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label for="issueSizeEstimate" class="sr-only">Name</label>
                                    <input type="text" class="form-control form-control-lg" name="name" id="issueName" placeholder="Name" autofocus required>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="issueSizeEstimate" class="sr-only">Size Estimate</label>
                                    <input type="text" class="form-control form-control-lg" name="size_estimate" id="issueSizeEstimate" placeholder="Size">
                                </div>
                            </div>
                        </div>

                        <hr class="mt-0">

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group row">
                                    <label for="issueTypeId" class="col-sm-4 col-form-label">Type</label>
                                    <div class="col-sm">
                                        <select class="form-control" name="type_id" id="issueTypeId">
                                            @foreach ($issueTypes as $type)
                                                <option value="{{ $type->id }}" {{ $specifiedType == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="issueStatusId" class="col-sm-4 col-form-label">Status</label>
                                    <div class="col-sm">
                                        <select class="form-control" name="status_id" id="issueStatusId">
                                            @foreach ($issueStatuses as $status)
                                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="issuePriorityValue" class="col-sm-4 col-form-label">Priority</label>
                                    <div class="col-sm">
                                        <select class="form-control" name="priority_value" id="issuePriorityValue">
                                            @foreach ($issuePriorities as $priority)
                                                <option value="{{ $priority->value }}" {{ !$priority->value ? 'selected' : '' }}>{{ $priority->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group row">
                                    <label for="issueAuthorId" class="col-sm-4 col-form-label">Author</label>
                                    <div class="col-sm">
                                        @if (Auth::user()->role == 'admin')
                                            <select class="form-control" name="author_id" id="issueAuthorId">
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" {{ !$user->id == Auth::id() ? 'selected' : '' }}>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="issueOwnerId" class="col-sm-4 col-form-label">Assigned To</label>
                                    <div class="col-sm">
                                        <select class="form-control" name="owner_id" id="issueOwnerId">
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}" {{ !$user->id == Auth::id() ? 'selected' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-0">

                        <div class="form-group row">
                            <label for="issueDescription" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm">
                                <textarea class="form-control" name="description" id="issueDescription"></textarea>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
