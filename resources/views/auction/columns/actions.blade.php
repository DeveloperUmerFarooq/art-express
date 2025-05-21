@php
    use Carbon\Carbon;
    $startDate = Carbon::parse($query->start_date);
@endphp

<!-- Actions Dropdown -->
<div class="dropdown d-inline">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionDropdown{{ $query->id }}"
        data-bs-toggle="dropdown" aria-expanded="false">
        Actions
    </button>

    <ul class="dropdown-menu dropdown-menu-start auction-dropdown" aria-labelledby="actionDropdown{{ $query->id }}">
        <li>
            <a class="dropdown-item auction-dropdown-item" href="{{ route($role . '.auction.items', $query->id) }}">
                <i class="fas fa-eye me-2"></i> View Items
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="#">
                <i class="fas fa-running me-2"></i> Participate
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="#">
                <i class="fas fa-undo-alt me-2"></i> Claim Refund
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="#">
                <i class="fas fa-user-plus me-2"></i> Register
            </a>
        </li>

        {{-- @if (!($startDate->toDateString() >= now()->toDateString())) --}}
        @can('edit auction')
        <li>
            <a class="dropdown-item" href="#"
            data-bs-toggle="modal" data-bs-target="#editAuctionModal"
            onclick="edit({{$query}})">
                <i class="fas fa-edit me-2"></i> Edit
            </a>
        </li>
        @endcan
        @can('delete auction')
        <li onclick="deleteAuction('{{route($role.'.auction.delete',$query->id)}}')">
            <a class="dropdown-item text-danger">
                <i class="fas fa-trash-alt me-2"></i> Delete
            </a>
        </li>
        @endcan
        {{-- @endif --}}
    </ul>
</div>
