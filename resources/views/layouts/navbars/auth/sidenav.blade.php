<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl fixed-start pt-4"
    id="sidenav-main"
    style="top: 16px; height: calc(100vh - 16px); width: 250px; border-left: 4px solid #f56036; background-color: #ffffff;">

    <!-- Header -->
    <div class="sidenav-header d-flex flex-row align-items-center justify-content-start mt-3 ps-3">
        <a class="d-flex align-items-center text-decoration-none" href="{{ route('home') }}" target="_blank">
            <img src="{{ asset('img/logo-drs.jpg') }}" class="navbar-brand-img me-2" style="max-height: 50px;" alt="main_logo">
            <h6 class="mb-0 font-weight-bold text-dark">Darussalaam</h6>
        </a>
    </div>

    <hr class="horizontal dark mt-2 mb-2">

    <!-- Menu Items -->
    <div class="collapse navbar-collapse overflow-auto" id="sidenav-collapse-main" style="height: calc(100vh - 150px);">
        <ul class="navbar-nav ps-2 pe-2">

            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                   href="{{ route('home') }}"
                   style="{{ Route::currentRouteName() == 'home' ? 'background-color: #f8f9fa; border-radius: 12px; font-weight: bold;' : '' }}">
                    <div class="icon icon-shape icon-sm me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm"></i>
                    </div>
                    <span class="nav-link-text text-sm">Dashboard</span>
                </a>
            </li>

            <!-- Section Heading -->
            <li class="nav-item mt-3">
                <h6 class="text-uppercase text-xs font-weight-bolder opacity-6">Laravel Examples</h6>
            </li>

            <!-- Profile -->
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
                   href="{{ route('profile') }}"
                   style="{{ Route::currentRouteName() == 'profile' ? 'background-color: #f8f9fa; border-radius: 12px; font-weight: bold;' : '' }}">
                    <div class="icon icon-shape icon-sm me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-single-02 text-dark text-sm"></i>
                    </div>
                    <span class="nav-link-text text-sm">Profile</span>
                </a>
            </li>
            <!-- Section Heading -->
            <li class="nav-item mt-3">
                <h6 class="text-uppercase text-xs font-weight-bolder opacity-6">Pages</h6>
            </li>
        </ul>
    </div>
</aside>
