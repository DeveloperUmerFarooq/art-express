@php
    $statusClass = match($query->status) {
        'upcoming' => 'badge bg-info text-dark',
        'ongoing' => 'badge bg-success',
        'ended' => 'badge bg-secondary',
        default => 'badge bg-dark',
    };

    $formattedStatus = ucfirst($query->status);
@endphp

<div class="d-flex align-items-center">
    <span class="{{ $statusClass }}">{{ $formattedStatus }}</span>
</div>
