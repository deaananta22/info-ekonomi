  {{-- Navbar --}}
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
      <a class="navbar-brand" href="#">✨ INFO EKONOMI</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav ms-auto align-items-center gap-2">
          {{-- Dropdown Tim Kerja --}}
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="timDropdown" role="button" data-bs-toggle="dropdown">
              Tim Kerja
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">Tim Kemiskinan</a></li>
              <li><a class="dropdown-item" href="#">Tim Kawasan Industri & PSN</a></li>
              <li><a class="dropdown-item" href="#">Tim Peluang Investasi</a></li>
              <li><a class="dropdown-item" href="#">Tim CSR</a></li>
              <li><a class="dropdown-item" href="#">Tim DBH perkebunan</a></li>
            </ul>
          </li>

          {{-- Agenda Rapat --}}
          <li class="nav-item">
            <a class="nav-link" href="#">Agenda Rapat</a>
          </li>

          {{-- Login / Logout --}}
          @auth
            <li class="nav-item me-2 text-white">
              Halo, {{ Auth::user()->name }}
            </li>
            <li class="nav-item">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-login btn-sm">Logout</button>
              </form>
            </li>
          @else
            <li class="nav-item">
              <a class="btn btn-login btn-sm" href="{{ route('login') }}">Login</a>
            </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>