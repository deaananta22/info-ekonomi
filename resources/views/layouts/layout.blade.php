<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Info Ekonomi')</title>

  {{-- Bootstrap & Fonts --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

  <style>
    body {
      font-family: 'Inter', sans-serif;

      background: linear-gradient(135deg,rgb(89, 109, 198),rgb(230, 103, 213),rgb(241, 242, 244));
      color: #fff;
      margin: 0;
    }

    .navbar {
      background:rgb(12, 85, 241);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .navbar-brand {
      font-weight: 700;
      font-size: 1.4rem;
      color: #fff;
    }

    .nav-link, .dropdown-toggle {
      color: rgba(255, 255, 255, 0.85) !important;
      font-weight: 500;
    }

    .nav-link:hover, .dropdown-toggle:hover {
      color: #fff !important;
    }

    .btn-login {
      background: linear-gradient(135deg, #f093fb, #f5576c);
      color: white;
      border-radius: 20px;
      padding: 6px 16px;
      font-weight: 500;
    }

    .btn-login {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-radius: 25px;
    padding: 10px 24px;
    font-weight: 600;
    box-shadow: 0 4px 12px rgba(118, 75, 162, 0.3);
    transition: all 0.3s ease;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(251, 251, 251, 0.5);
}
 
.card:hover {
    transform: translateY(-5px);
    transition: 0.3s;
    box-shadow: 0 0 20px rgba(236, 237, 242, 1);
}


    /* .content-wrapper {
      margin-top: 2rem;
      background: rgb(234, 230, 230);
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgb(239, 234, 234);
    } */
  </style>
</head>
<body>

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

  {{-- Konten --}}
  <main class="container">
    <div class="content-wrapper">
      @yield('content')
    </div>
  </main>

  {{-- Script Bootstrap --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  
</body>

</html>
