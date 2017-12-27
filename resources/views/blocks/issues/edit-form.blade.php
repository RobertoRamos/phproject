<form action="{{ isset($issue) ? route('issue_edit_post', ['issue' => $issue]) : route('new_issue_post') }}" method="post">
    {{ csrf_field() }}
    <div class="form-row">
        <div class="col-md">
            <div class="form-group">
                <label for="issueSizeEstimate" class="sr-only">Name</label>
                <input type="text" class="form-control form-control-lg" name="name" id="issueName" placeholder="Name" autofocus required value="{{ $issue->name ?? null }}">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="issueSizeEstimate" class="sr-only">Size Estimate</label>
                <input type="text" class="form-control form-control-lg" name="size_estimate" id="issueSizeEstimate" placeholder="Size" value="{{ $issue->size_estimate ?? null }}">
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
                            @if ((isset($issue) && $issue->type_id == $type->id) || (isset($specifiedType) && $specifiedType == $type->id))
                                <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                            @else
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="issueStatusId" class="col-sm-4 col-form-label">Status</label>
                <div class="col-sm">
                    <select class="form-control" name="status_id" id="issueStatusId">
                        @foreach ($issueStatuses as $status)
                            @if (isset($issue) && $issue->status_id == $status->id)
                                <option value="{{ $status->id }}" selected>{{ $status->name }}</option>
                            @else
                                <option value="{{ $status->id }}">{{ $status->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="issuePriorityValue" class="col-sm-4 col-form-label">Priority</label>
                <div class="col-sm">
                    <select class="form-control" name="priority_value" id="issuePriorityValue">
                        @foreach ($issuePriorities as $priority)
                            @if ((isset($issue) && $issue->priority_value == $priority->value) || (!isset($issue) && !$priority->value))
                                <option value="{{ $priority->value }}" selected>{{ $priority->name }}</option>
                            @else
                                <option value="{{ $priority->value }}">{{ $priority->name }}</option>
                            @endif
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
                                @if ((isset($issue) && $issue->author_id == $type->id) || (isset($specifiedType) && $specifiedType == $type->id))
                                    <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                                @else
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endif
                                <option value="{{ $user->id }}" {{ !$user->id == Auth::id() ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    @else
                        <input type="text" class="form-control" value="{{ isset($issue) ? $issue->author->name : Auth::user()->name }}" disabled>
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
        @if (isset($issue))
            <a href="{{ route('issue_single', ['issue' => $issue]) }}" class="btn btn-secondary">Cancel</a>
        @endif
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
