<form action="{{route('admin.management.user.status',$user->id)}}" method="POST" id="status-form-{{$user->id}}">
    @csrf
    <select class="form-select status-dropdown" name="status" onchange="document.getElementById('status-form-{{$user->id}}').submit()">
        <option value="0" {{ $user->status==0? 'selected' : '' }}>🟢 Active</option>
        <option value="1" {{ $user->status==1? 'selected' : '' }}>🔴 Suspended</option>
    </select>
</form>
