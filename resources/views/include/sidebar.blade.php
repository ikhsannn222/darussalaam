<div class="sidebar">
    <!-- Logo Header -->
    <div class="sidebar-logo">
        <div class="logo-header">
            <a href="{{ route('dashboard') }}" class="logo">
                Daar es salam Al-islami
            </a>
        </div>
    </div>

    <!-- Menu Items -->
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <!-- Dashboard -->
                <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- Akademik Section Title -->
                <li class="nav-section">Akademik</li>

                <!-- Kategori Kelas -->
                <li class="nav-item {{ request()->routeIs('kategori_kelas.*') ? 'active' : '' }}">
                    <a href="{{ route('kategori_kelas.index') }}">
                        <i class="fas fa-layer-group"></i>
                        <span>Kategori Kelas</span>
                    </a>
                </li>

                <!-- Kelas -->
                <li class="nav-item {{ request()->routeIs('kelas.*') ? 'active' : '' }}">
                    <a href="{{ route('kelas.index') }}">
                        <i class="fas fa-school"></i>
                        <span>Kelas</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- CSS Styling -->
<style>
.sidebar {
    background-color: #f4f5fa;
    color: #111;
    font-family: 'Inter', sans-serif;
}

.logo-header {
    background-color: #fff;
    padding: 16px;
}

.logo {
    display: flex;
    align-items: center;
    font-weight: bold;
    font-size: 1.25rem;
    color: #1a1a1a;
    text-decoration: none;
}

/* Section Title */
.nav-section {
    padding: 12px 20px 6px;
    font-size: 11px;
    color: #999;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* Navigation List */
.nav-secondary {
    list-style: none;
    padding: 0 12px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    margin: 0;
}

/* Navigation Item */
.nav-item > a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 16px;
    background-color: transparent;
    border-radius: 16px;
    font-size: 14px;
    color: #333;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
    text-decoration: none;
}

/* Icon Styling */
.nav-item > a i {
    background-color: #ffffff;
    color: #555;
    font-size: 14px;
    border-radius: 8px;
    padding: 6px;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Hover Effect */
.nav-item > a:hover {
    background-color: #edefff;
    color: #4f3cc9;
}

/* Active Style */
.nav-item.active > a {
    background: linear-gradient(to right, #a66eff, #914eff);
    color: #fff !important;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(145, 78, 255, 0.3);
}

.nav-item.active > a i {
    background-color: #fff;
    color: #914eff;
}
</style>
