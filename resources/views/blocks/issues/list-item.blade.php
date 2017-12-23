<a href="{{ route('issue_single', ['issue' => $issue]) }}" class="list-group-item list-group-item-action d-flex align-items-end">
    <div class="mr-auto">
        <h5 class="mb-1">{{ $issue->name }}</h5>
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
</a>
