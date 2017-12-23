<div class="list-group">
    @foreach ($issues as $issue)
        @include('blocks.issues.list-item', ['issue' => $issue])
    @endforeach
</div>
