@php
    use Carbon\Carbon;
    $startDate = Carbon::parse($query->start_date);
@endphp

<td  style="position: relative;">
    <div class="dropdown d-inline">
        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionDropdown{{ $query->id }}"
            data-bs-toggle="dropdown" aria-expanded="false">
            Actions
        </button>

        <ul class="dropdown-menu auction-dropdown" aria-labelledby="actionDropdown{{ $query->id }}">
            <li>
                <a class="dropdown-item auction-dropdown-item" href="{{ route('auction.items', $query->id) }}">
                    <i class="fas fa-eye me-2"></i> View Items
                </a>
            </li>
            @if ($query->status!=="ended")
            @can('can register in auction')
            @if (!auth()->user()->hasRegisteredForAuction($query->id))
            @if ($query->host_id!==auth()->id())
            <li data-bs-toggle="modal" data-bs-target="#registerAuctionModal" onclick="openRegister({{$query->id}})">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user-plus me-2"></i> Register
                </a>
            </li>
            @endif
            @else
            @if ($query->status==="ongoing")
            <li>
               <a class="dropdown-item" href="{{route('auction.participate',$query->id)}}">
                   <i class="fas fa-running me-2"></i> Participate
               </a>
           </li>
            @endif
            @if ($query->status==="upcoming")
            <li>
                <a class="dropdown-item" href="{{route('auction.refund',$query->id)}}">
                    <i class="fas fa-undo-alt me-2"></i> Claim Refund
                </a>
            </li>
            @endif
            @endif
            @endcan
            @if (($role!=="user"&&$query->status==="upcoming")&&$startDate->toDateString() === now()->toDateString())
            <li>
                <a class="dropdown-item" href="{{route($role.'.auction.start',$query->id)}}">
                    <i class="fas fa-gavel me-2"></i> Start
                </a>
            </li>
            @endif

            @if ($startDate->toDateString() > now()->toDateString())
            @can('edit auction')
            @if ($query->host_id===auth()->id()&&$query->status==="upcoming")
            <li>
                <a class="dropdown-item" href="#"
                data-bs-toggle="modal" data-bs-target="#editAuctionModal"
                onclick="edit({{$query}})">
                    <i class="fas fa-edit me-2"></i> Edit
                </a>
            </li>
            @endif
            @endcan
            @can('delete auction')
            @if ($query->host_id===auth()->id()&&$query->status==="upcoming")
            <li onclick="deleteAuction('{{route($role.'.auction.delete',$query->id)}}')">
                <a class="dropdown-item text-danger" href="#">
                    <i class="fas fa-trash-alt me-2"></i> Delete
                </a>
            </li>
            @endif
            @endcan
            @endif
            @endif
        </ul>
    </div>
</td>
