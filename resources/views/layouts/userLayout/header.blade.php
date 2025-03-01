<header>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fs-3 d-flex gap-1 align-items-center" href="/">
                <img src="{{asset('assets/images/icon.svg')}}" height="50" alt="" style="filter: drop-shadow(1px 1px 10px var(--primary))">
                <span>Art-Express</span>
            </a>
          <a href="{{route('admin.profile')}}" class="nav-link dropdown-toggle no-togggle-icon fs-6 ms-auto mx-1 d-md-none">
              <img class="rounded-circle" src="{{asset('storage/users-avatar/'.auth()->user()->avatar)}}" alt="{{auth()->user()->name}}" height="30">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff0cd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-justify"><path d="M3 12h18"/><path d="M3 18h18"/><path d="M3 6h18"/></svg>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto gap-2 text-center">
              <li class="nav-item pt-1">
                <a class="nav-link fs-6" href="{{route('user.store')}}">Store</a>
              </li>
              <li class="nav-item pt-1">
                <a class="nav-link fs-6" href="{{route('user.order')}}">Orders</a>
              </li>
              <li class="nav-item pt-1">
                <a class="nav-link fs-6" href="{{route('user.ranking')}}">Top Artists</a>
              </li>
              <li class="nav-item pt-1">
                <a class="nav-link fs-6" href="{{route('user.artist')}}">Artists</a>
              </li>
              <li class="nav-item pt-1">
                <a class="nav-link fs-6" href="{{route('messenger')}}">
                @php
                    if (auth()->check()){
                        $unreadCount = App\Models\ChMessage::where('to_id', auth()->id())
                                                    ->where('seen', 0)
                                                    ->count();
                    }
                    else{
                        $unreadCount=0;
                    }
                @endphp
                @if ($unreadCount>0)
                <span class="bg-danger p-2 rounded-pill text-white fw-bold d-inline-flex align-items-center justify-content-center" style="min-width: 24px; height: 24px; font-size: 0.9rem;">
                    {{$unreadCount}}
                </span>
                @endif
                Messages
                </a>
              </li>
              <li class="nav-item pt-1">
                <a class="nav-link fs-6" href="{{route('user.auction')}}">Auctions</a>
              </li>
              <li class="nav-item dropdown d-none d-md-block">
                <a class="nav-link dropdown-toggle no-togggle-icon fs-6" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="rounded-circle" src="{{asset('storage/users-avatar/'.auth()->user()->avatar)}}" alt="{{auth()->user()->name}}" height="30" width="30">
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <abbr title="View Profile">
                  <li><center>
                    <a class="d-flex flex-column text-decoration-none gap-1 pb-0" href="{{route('user.profile')}}">
                        <div class="profile-image rounded-full">
                        <img class="rounded-circle" src="{{asset('storage/users-avatar/'.auth()->user()->avatar)}}" style="height: 4rem; width: 4rem" alt="{{auth()->user()->name}}">
                        </div>
                        <p class="text-wrap" style="color:var(--primary)">{{auth()->user()->name}}</p>
                    </a>
                </center></li></abbr>
                  <li><a class="dropdown-item fs-6 text-center" id="logout"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     <span class="text-danger">Logout</span>
                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
</header>
