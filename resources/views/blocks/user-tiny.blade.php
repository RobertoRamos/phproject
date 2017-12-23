<div class="d-flex align-items-center mb-3">
    <div class="mr-3">
        <img src="//placehold.it/40x40" class="img-fluid rounded-circle" alt>
    </div>
    <div>
        <div><a href="{{ route('user', ['user' => $user]) }}">{{ $user->name }}</a></div>
        <small>{{ '@' . $user->username }}</small>
    </div>
</div>
