<div class="d-flex align-items-center mb-3">
    <div class="mr-2">
        {{-- TODO: set width via SCSS --}}
        <img src="{{ asset('img/default-avatar.svg') }}" width="32" class="img-fluid rounded-circle" alt>
    </div>
    <div class="line-height-sm">
        <div><a href="{{ route('user', ['user' => $user]) }}">{{ $user->name }}</a></div>
        <small>{{ '@' . $user->username }}</small>
    </div>
</div>
