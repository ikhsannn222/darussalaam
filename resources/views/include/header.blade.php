<div class="main-header">
  <div class="main-header-logo">
    <div class="logo-header" data-background-color="dark">
      <a href="{{ route('dashboard') }}" class="logo"></a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
  </div>
  <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
      <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
        <li class="nav-item topbar-user dropdown hidden-caret">
          <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
            <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; font-size: 18px;">
              {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <span class="profile-username">
              <span class="op-7">Hi,</span>
              <span class="fw-bold">{{ Auth::user()->name }}</span>
            </span>
          </a>
          <ul class="dropdown-menu dropdown-user animated fadeIn">
            <div class="dropdown-user-scroll scrollbar-outer">
              <li>
                <div class="user-box text-center p-3">
                  <div class="avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" style="width: 60px; height: 60px; font-size: 24px;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                  </div>
                  <div class="u-text">
                    <h4>{{ Auth::user()->name }}</h4>
                    <p class="text-muted">{{ Auth::user()->email }}</p>
                    <a href="#" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                  </div>
                </div>
              </li>
              <li>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="dropdown-item d-flex align-items-center">
                    <i class="fas fa-sign-out-alt me-2 text-danger"></i> Logout
                  </button>
                </form>
              </li>
            </div>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</div>
