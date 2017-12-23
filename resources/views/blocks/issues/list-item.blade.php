<a href="{{ route('issue_single', ['issue' => $issue]) }}" class="list-group-item list-group-item-action d-block">
    <div class="d-flex mb-1">
        <h5 class="mr-auto mb-0">{{ $issue->name }}</h5>
        <span title="Assigned to">{{ $issue->owner->name }}</span>
    </div>
    <div class="d-flex">
        <div class="mr-auto">
            <small>Created {{ $issue->created_at->diffForHumans() }}</small>
        </div>
        <div>
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
</a>
