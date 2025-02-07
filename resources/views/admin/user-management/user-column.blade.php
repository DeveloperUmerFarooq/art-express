<div class="d-flex align-items-center gap-2">
    <img class="rounded-circle" src="{{$user->profile->profile_image}}" alt="" style="height: 40px; width: 40px; object-fit: cover;">
    <div class="d-flex flex-column">
        <b><p class="mb-0 text-center" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            {{$user->name}}
        </p></b>
        <p class="mb-0" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            <small>{{$user->email}}</small>
        </p>
    </div>
</div>
