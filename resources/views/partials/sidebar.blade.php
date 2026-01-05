<!-- Sidebar -->
<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
    <div class="position-sticky pt-3">
        <div class="sidebar-brand text-center py-4">
            <div class="logo-container mx-auto mb-3">
                <i class="fas fa-dumbbell"></i>
            </div>
            <h2 class="brand-name">Gym GenZ</h2>
            <p class="brand-tagline">Fitness Management</p>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home me-2"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('manajemen-pengguna.index') || request()->routeIs('manajemen-pengguna.*') ? 'active' : '' }}"
                    href="{{ route('manajemen-pengguna.index') }}">
                    <i class="fas fa-users me-2"></i>
                    Manajemen Pengguna
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('manajemen-food.index') || request()->routeIs('manajemen-food.*') ? 'active' : '' }}"
                    href="{{ route('manajemen-food.index') }}">
                    <i class="fas fa-utensils me-2"></i>
                    Food Plan
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('manajemen-jadwal.index') || request()->routeIs('manajemen-jadwal.*') ? 'active' : '' }}"
                    href="{{ route('manajemen-jadwal.index') }}">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Jadwal Workout
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-dumbbell me-2"></i>
                    Manajemen Workout
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('manajemen-admin.index') || request()->routeIs('manajemen-admin.*') ? 'active' : '' }}"
                    href="{{ route('manajemen-admin.index') }}">
                    <i class="fas fa-user-shield me-2"></i>
                    Manajemen Admin
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}"
                    href="{{ route('admin.profile') }}">
                    <i class="fas fa-user-gear me-2"></i>
                    Profile
                </a>
            </li>
        </ul>
    </div>
</nav>
