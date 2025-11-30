<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Inter', sans-serif;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .admin-navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 2000;
        transition: background-color 0.3s ease, backdrop-filter 0.3s ease;
        background-color: rgba(220, 38, 38, 0.95);
        backdrop-filter: blur(5px);
    }

    .admin-navbar-scrolled {
        background-color: rgba(220, 38, 38, 0.7);
        backdrop-filter: blur(10px);
    }

    .sidebar {
        position: fixed;
        top: 60px;
        left: 0;
        height: calc(100vh - 60px);
        width: 250px;
        background: white;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        z-index: 1000;
    }

    .main-content {
        margin-left: 250px;
        margin-top: 60px;
        padding: 20px;
        min-height: calc(100vh - 60px);
        background: #f8f9fa;
    }

    .mobile-menu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
        background-color: rgba(220, 38, 38, 0.95);
    }

    .mobile-menu.active {
        max-height: 500px;
    }

    .hamburger span {
        display: block;
        width: 25px;
        height: 3px;
        background-color: white;
        margin: 5px 0;
        transition: 0.3s;
    }

    .hamburger.active span:nth-child(1) {
        transform: rotate(-45deg) translate(-5px, 6px);
    }

    .hamburger.active span:nth-child(2) {
        opacity: 0;
    }

    .hamburger.active span:nth-child(3) {
        transform: rotate(45deg) translate(-5px, -6px);
    }

    @media (max-width: 1024px) {
        .sidebar {
            transform: translateX(-100%);
        }
        
        .sidebar.active {
            transform: translateX(0);
        }
        
        .main-content {
            margin-left: 0;
        }
    }
</style>

<body class="bg-gray-100">
    <!-- Admin Navbar -->
    <nav class="admin-navbar text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-3">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-lg sm:text-xl font-semibold flex items-center gap-2">
                        <i class="fas fa-crown"></i> 
                        <span class="hidden xs:inline">Admin Panel</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="hover:text-gray-200 transition">Public Site</a>
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-200 transition {{ request()->routeIs('admin.dashboard') ? 'font-bold' : '' }}">Dashboard</a>
                    <a href="{{ route('admin.matches.index') }}" class="hover:text-gray-200 transition {{ request()->routeIs('admin.matches.*') ? 'font-bold' : '' }}">Matches</a>
                    <a href="{{ route('admin.clubs.index') }}" class="hover:text-gray-200 transition {{ request()->routeIs('admin.clubs.*') ? 'font-bold' : '' }}">Clubs</a>
                    <a href="{{ route('admin.players.index') }}" class="hover:text-gray-200 transition {{ request()->routeIs('admin.players.*') ? 'font-bold' : '' }}">Players</a>
                    <a href="{{ route('admin.standings.index') }}" class="hover:text-gray-200 transition {{ request()->routeIs('admin.players.*') ? 'font-bold' : '' }}">Standings</a>
                </div>

                <!-- Desktop User Menu -->
                <div class="hidden lg:flex items-center gap-4">
                    <span class="text-white text-sm xl:text-base truncate max-w-[150px]">
                        Hello, Admin!
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="border border-white text-white px-3 py-1.5 rounded text-sm hover:bg-white hover:text-red-600 transition whitespace-nowrap">
                            Logout
                        </button>
                    </form>
                </div>

                <!-- Mobile Menu Button - Moved to right -->
                <button class="lg:hidden hamburger flex flex-col justify-center items-center w-10 h-10 ml-auto" id="mobile-menu-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div class="mobile-menu lg:hidden" id="mobile-menu">
                <div class="py-4 space-y-3 border-t border-red-600">
                    <!-- Public Site Link -->
                    <a href="{{ route('home') }}" class="block py-2 px-4 hover:bg-red-700 rounded transition flex items-center gap-2">
                        <i class="fas fa-globe w-4"></i>
                        Public Site
                    </a>
                    
                    <!-- Admin Navigation Links -->
                    <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-red-700 rounded transition {{ request()->routeIs('admin.dashboard') ? 'font-bold bg-red-700' : '' }} flex items-center gap-2">
                        <i class="fas fa-tachometer-alt w-4"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.matches.index') }}" class="block py-2 px-4 hover:bg-red-700 rounded transition {{ request()->routeIs('admin.matches.*') ? 'font-bold bg-red-700' : '' }} flex items-center gap-2">
                        <i class="fas fa-calendar-alt w-4"></i>
                        Matches
                    </a>
                    <a href="{{ route('admin.clubs.index') }}" class="block py-2 px-4 hover:bg-red-700 rounded transition {{ request()->routeIs('admin.clubs.*') ? 'font-bold bg-red-700' : '' }} flex items-center gap-2">
                        <i class="fas fa-users w-4"></i>
                        Clubs
                    </a>
                    <a href="{{ route('admin.players.index') }}" class="block py-2 px-4 hover:bg-red-700 rounded transition {{ request()->routeIs('admin.players.*') ? 'font-bold bg-red-700' : '' }} flex items-center gap-2">
                        <i class="fas fa-user w-4"></i>
                        Players
                    </a>
                    <a href="{{ route('admin.standings.index') }}" class="block py-2 px-4 hover:bg-red-700 rounded transition {{ request()->routeIs('admin.standings.*') ? 'font-bold bg-red-700' : '' }} flex items-center gap-2">
                        <i class="fas fa-trophy w-4"></i>
                        Standings
                    </a>

                    <!-- Quick Actions -->
                    <div class="pt-2 border-t border-red-500">
                        <a href="{{ route('admin.matches.create') }}" class="block py-2 px-4 hover:bg-red-700 rounded transition flex items-center gap-2">
                            <i class="fas fa-plus w-4"></i>
                            Add Match
                        </a>
                        <a href="{{ route('admin.players.create') }}" class="block py-2 px-4 hover:bg-red-700 rounded transition flex items-center gap-2">
                            <i class="fas fa-user-plus w-4"></i>
                            Add Player
                        </a>
                    </div>

                    <!-- Mobile Logout Section -->
                    <div class="pt-3 border-t border-red-600">
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-left py-2 px-4 hover:bg-red-700 rounded transition flex items-center gap-2">
                                <i class="fas fa-sign-out-alt w-4"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="p-6 space-y-6">
            <!-- Navigation Links -->
            <div class="space-y-2">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Management</h3>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 p-2 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded transition {{ request()->routeIs('admin.dashboard') ? 'bg-red-50 text-red-600 font-semibold' : '' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    Dashboard
                </a>
                <a href="{{ route('admin.matches.index') }}" class="flex items-center gap-3 p-2 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded transition {{ request()->routeIs('admin.matches.*') ? 'bg-red-50 text-red-600 font-semibold' : '' }}">
                    <i class="fas fa-calendar-alt w-5"></i>
                    Matches
                </a>
                <a href="{{ route('admin.clubs.index') }}" class="flex items-center gap-3 p-2 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded transition {{ request()->routeIs('admin.clubs.*') ? 'bg-red-50 text-red-600 font-semibold' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    Clubs
                </a>
                <a href="{{ route('admin.players.index') }}" class="flex items-center gap-3 p-2 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded transition {{ request()->routeIs('admin.players.*') ? 'bg-red-50 text-red-600 font-semibold' : '' }}">
                    <i class="fas fa-user w-5"></i>
                    Players
                </a>
                <a href="{{ route('admin.standings.index') }}" class="flex items-center gap-3 p-2 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded transition {{ request()->routeIs('admin.standings.*') ? 'bg-red-50 text-red-600 font-semibold' : '' }}">
                    <i class="fas fa-trophy w-5"></i>
                    Standings
                </a>
            </div>

            <!-- Quick Actions -->
            <div class="space-y-2">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Quick Actions</h3>
                <a href="{{ route('admin.matches.create') }}" class="flex items-center gap-3 p-2 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded transition">
                    <i class="fas fa-plus w-5"></i>
                    Add Match
                </a>
                <a href="{{ route('admin.players.create') }}" class="flex items-center gap-3 p-2 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded transition">
                    <i class="fas fa-user-plus w-5"></i>
                    Add Player
                </a>
            </div>

            <!-- Public Site Link in Sidebar -->
            <div class="space-y-2">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Public Site</h3>
                <a href="{{ route('home') }}" class="flex items-center gap-3 p-2 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded transition">
                    <i class="fas fa-globe w-5"></i>
                    View Public Site
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <script>
        // Scroll navbar effect
        document.addEventListener('scroll', function() {
            const navbar = document.querySelector('.admin-navbar');
            if (window.scrollY > 50) { 
                navbar.classList.add('admin-navbar-scrolled');
            } else {
                navbar.classList.remove('admin-navbar-scrolled');
            }
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            mobileMenuBtn.classList.toggle('active');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInsideMenu = mobileMenu.contains(event.target);
            const isClickOnButton = mobileMenuBtn.contains(event.target);
            
            if (!isClickInsideMenu && !isClickOnButton && mobileMenu.classList.contains('active')) {
                mobileMenu.classList.remove('active');
                mobileMenuBtn.classList.remove('active');
            }
        });

        // Close mobile menu when window is resized to desktop size
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                mobileMenu.classList.remove('active');
                mobileMenuBtn.classList.remove('active');
            }
        });

        // Sidebar toggle for mobile (if you still want to keep sidebar functionality)
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const sidebar = document.querySelector('.sidebar');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                sidebarToggle.classList.toggle('active');
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth < 1024) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggle = sidebarToggle ? sidebarToggle.contains(event.target) : false;
                
                if (!isClickInsideSidebar && !isClickOnToggle && sidebar.classList.contains('active')) {
                    sidebar.classList.remove('active');
                    if (sidebarToggle) sidebarToggle.classList.remove('active');
                }
            }
        });
    </script>

    @stack('scripts')
</body>
</html>