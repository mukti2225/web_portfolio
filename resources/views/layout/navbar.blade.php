<nav class="navbar sticky-top navbar-expand-lg navbar-dark">
  <div class="container">
    <!-- Logo/Brand -->
    <a class="navbar-brand fw-bold" href="/">Portfolio</a>

    <!-- Toggler for mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Centered Navigation Menu -->
      <ul class="navbar-nav mx-auto nav-pill-group">
        <li class="nav-item">
          <a class="nav-link" href="#beranda">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#tentang">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#skill">Skill</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#portfolio">Projects</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#kontak">Contact</a>
        </li>
      </ul>

      <!-- Right side - Auth Menu -->
      @auth
      <div class="dropdown ms-3">
        <button class="btn text-light btn-sm dropdown-toggle" 
                id="userName" 
                data-bs-toggle="dropdown" 
                aria-expanded="false">
          {{ auth()->user()->name }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userName">
          <li>
            <a class="dropdown-item" href="{{ route('filament.admin.auth.login') }}">
              <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
          </li>
          <li>
            <form method="POST" action="{{ route('filament.admin.auth.logout') }}">
              @csrf
              <button type="submit" class="dropdown-item">
                <i class="bi bi-box-arrow-right me-2"></i>Logout
              </button>
            </form>
          </li>
        </ul>
      </div>
      @else
      <button class="btn btn-outline-light btn-sm rounded-circle ms-3" style="width: 40px; height: 40px;">
        <i class="bi bi-grid-3x3-gap"></i>
      </button>
      @endauth
    </div>
  </div>
</nav>