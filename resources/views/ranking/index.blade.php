@extends('layouts.' . $role . 'Layout.layout')
@section('title')
   Artist Ranking | Art-Express
@endsection
@section('page')
<div class="container my-4">
    <h2 class="mb-4 text-center fw-bold"><i class="fas fa-palette me-1 text-primary"></i>
        Top Performing Artists</h2>

    @if($topArtists->count() > 0)
        @foreach($topArtists as $artist)
            <a href="{{ route($role.'.profile.view', $artist->id) }}"
               class="text-decoration-none text-dark">
                <div class="d-flex align-items-center justify-content-between p-3 mb-3 bg-white border rounded shadow-sm hover-shadow transition">
                    <div class="d-flex align-items-center gap-3">
                        <img loading="lazy"
                             class="rounded-circle border border-white shadow"
                             src="{{ asset('storage/users-avatar/'.$artist->avatar) }}"
                             alt="{{ $artist->name }}"
                             style="height: 55px; width: 55px; object-fit: cover;">

                        <div class="d-flex flex-column overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="fw-bold text-truncate fs-5">{{ $artist->name }}</span>
                                <small class="text-muted fw-bold">Rank #{{ $loop->iteration }}</small>
                            </div>
                            <small class="text-muted">🎭 Artist</small>

                            <div class="d-flex gap-3 mt-1 text-muted small flex-wrap">
                                <span>🖼 Products: {{ $artist->products_count }}</span>
                                <span>💰 Sales: {{ $artist->sales_count }}</span>
                                <span>📊 Ratio: {{ number_format($artist->ratio, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <abbr title="Start a chatt">
                        <a href="/messenger/{{$artist->id}}" target="_blank">
                            <i class="fa-solid fa-message fs-2"></i>
                        </a>
                    </abbr>
                </div>
            </a>
        @endforeach
    @else
        <div class="card shadow-sm mt-4">
            <div class="card-body text-center">
                <h5 class="card-title">No Rankings Produced</h5>
                <p class="card-text">It looks like all artists have products count below 10
                or does not have enough sales !</p>
            </div>
        </div>
    @endif
</div>
@endsection
