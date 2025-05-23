<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center text-white fw-bold fs-5"
                style="text-decoration: none;">
                Daar es salam Al-islami
            </a>
        </div>
        <!-- End Logo Header -->

        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item {{ request()->routeIs('kategori_kelas.*') ? 'active' : '' }}">
                        <a href="{{ route('kategori_kelas.index') }}">
                            <i class="fas fa-tags"></i>
                            <p>Kategori Kelas</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
