@if ($user->hasRole('artist'))
<a href="{{ route($role.'.profile.view', $user->id) }}"
   class="text-decoration-none text-dark ">
    <div class="d-flex align-items-center gap-3 p-2  rounded">
        <img loading="lazy"
             class="rounded-circle border-2 border-white shadow-sm"
             src="{{ asset('storage/users-avatar/'.$user->avatar) }}"
             alt="{{ $user->name }}"
             style="height: 45px; width: 45px; object-fit: cover;">
        <div class="d-flex flex-column overflow-hidden">
            <span class="fw-bold text-truncate">
                {{ $user->name }}
            </span>
            <small class="text-muted">Artist</small>
        </div>
    </div>
</a>
@else
<a href="{{ route($role.'.profile.details.view', $user->id) }}"
   class="text-decoration-none text-dark ">
    <div class="d-flex align-items-center gap-3 p-2  rounded">
        <img loading="lazy"
             class="rounded-circle border-2 border-white shadow-sm"
             src="{{ asset('storage/users-avatar/'.$user->avatar) }}"
             alt="{{ $user->name }}"
             style="height: 45px; width: 45px; object-fit: cover;">
        <div class="d-flex flex-column overflow-hidden">
            <span class="fw-bold text-truncate">
                {{ $user->name }}
            </span>
            <small class="text-muted">User</small>
        </div>
    </div>
</a>
@endif
