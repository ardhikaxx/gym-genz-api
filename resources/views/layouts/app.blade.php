<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Dashboard - Gym GenZ Admin')</title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        <div class="row">
            <!-- Sidebar -->
            @include('partials.sidebar')
            
            <!-- Main Content -->
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Header -->
                @include('partials.header')
                
                <!-- Main Content Area -->
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            const sidebarClose = document.getElementById('sidebarClose');
            const mainContent = document.querySelector('.main-content');
            
            // Fungsi untuk membuka sidebar
            function openSidebar() {
                sidebar.classList.add('active');
                sidebarOverlay.classList.add('active');
                document.body.style.overflow = 'hidden'; // Mencegah scroll background
            }
            
            // Fungsi untuk menutup sidebar
            function closeSidebar() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = ''; // Mengembalikan scroll
            }
            
            // Toggle sidebar saat tombol diklik
            sidebarToggle.addEventListener('click', function(e) {
                e.stopPropagation(); // Mencegah event bubbling
                openSidebar();
            });
            
            // Tutup sidebar saat overlay diklik
            sidebarOverlay.addEventListener('click', function() {
                closeSidebar();
            });

            sidebarClose.addEventListener('click', function() {
                closeSidebar();
            });
            
            // Tutup sidebar saat item menu diklik (untuk mobile)
            const sidebarLinks = document.querySelectorAll('#sidebar .nav-link');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        closeSidebar();
                    }
                });
            });
            
            // Tutup sidebar saat window di-resize ke ukuran desktop
            function handleResize() {
                if (window.innerWidth >= 768) {
                    closeSidebar();
                }
            }
            
            // Event listener untuk resize
            window.addEventListener('resize', handleResize);
            
            // Tutup sidebar dengan tombol ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeSidebar();
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>