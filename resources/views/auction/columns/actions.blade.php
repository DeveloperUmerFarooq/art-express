@php
    use Carbon\Carbon;
    $startDate = Carbon::parse($query->start_date);
@endphp
<button type="button" class="btn btn-secondary btn-sm"
    data-bs-toggle="popover"
    data-bs-html="true"
    data-bs-content='
        <ul class="list-unstyled mb-0">
            <li><a href="{{route($role.'.auction.items',$query->id)}}" class="dropdown-item mb-1"><i class="fas fa-eye me-2"></i> View Items</a></li>
            <li><a href="#" class="dropdown-item mb-1"><i class="fas fa-running me-2"></i> Participate</a></li>
            <li><a href="#" class="dropdown-item mb-1"><i class="fas fa-undo-alt me-2"></i> Claim Refund</a></li>
            <li><a href="#" class="dropdown-item mb-1"><i class="fas fa-user-plus me-2"></i> Register</a></li>
            @if (!($startDate->toDateString() >= now()->toDateString()))
            <li><a href="#" class="dropdown-item mb-1"><i class="fas fa-edit me-2"></i> Edit</a></li>
            <li><a href="#" class="dropdown-item mb-1 text-danger"><i class="fas fa-trash-alt me-2"></i> Delete</a></li>
            @endif
        </ul>
    '>
    Actions
</button>

<script>
    var popoverTrigger = document.querySelector('[data-bs-toggle="popover"]');
    var popover = new bootstrap.Popover(popoverTrigger, {
      trigger: 'focus',
      placement: 'bottom'
    });
</script>

