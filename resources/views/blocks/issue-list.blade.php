<div class="list-group">
    @foreach ($issues as $issue)
        @include('blocks/issue-list-item', ['issue' => $issue])
    @endforeach
</div>
