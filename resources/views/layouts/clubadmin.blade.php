<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Club Admin Panel</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
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

    .clubadmin-navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 2000;
        transition: background-color 0.3s ease, backdrop-filter 0.3s ease;
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
        backdrop-filter: blur(5px);
    }

    .clubadmin-navbar-scrolled {
        background: linear-gradient(135deg, rgba(5, 150, 105, 0.95) 0%, rgba(16, 185, 129, 0.95) 100%);
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
        background: linear-gradient(135deg, #059669 0%, #10B981 100%);
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
    <!-- Club Admin Navbar -->
    <nav class="clubadmin-navbar text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-3">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('clubadmin.dashboard') }}" class="text-lg sm:text-xl font-semibold flex items-center gap-2">
                        <i class="fas fa-shield-alt"></i> 
                        <span class="hidden xs:inline">Club Admin Panel</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="hover:text-green-100 transition">Public Site</a>
                    <a href="{{ route('clubadmin.dashboard') }}" class="hover:text-green-100 transition {{ request()->routeIs('clubadmin.dashboard') ? 'font-bold' : '' }}">Dashboard</a>
                    <a href="{{ route('clubadmin.club.show') }}" class="hover:text-green-100 transition {{ request()->routeIs('clubadmin.club.*') ? 'font-bold' : '' }}">Club</a>
                    <a href="{{ route('clubadmin.matches.upcoming') }}" class="hover:text-green-100 transition {{ request()->routeIs('clubadmin.matches.*') ? 'font-bold' : '' }}">Matches</a>
                    <a href="{{ route('clubadmin.players.index') }}" class="hover:text-green-100 transition {{ request()->routeIs('clubadmin.players.*') ? 'font-bold' : '' }}">Players</a>
                </div>

                <!-- Desktop User Menu -->
                <div class="hidden lg:flex items-center gap-4">
                    <span class="text-white text-sm xl:text-base truncate max-w-[150px]">
                        Hello, {{ Auth::user()->name }}!
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="border border-white text-white px-3 py-1.5 rounded text-sm hover:bg-white hover:text-green-600 transition whitespace-nowrap">
                            Logout
                        </button>
                    </form>
                </div>

                <!-- Mobile Menu Button -->
                <button class="lg:hidden hamburger flex flex-col justify-center items-center w-10 h-10 ml-auto" id="mobile-menu-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div class="mobile-menu lg:hidden" id="mobile-menu">
                <div class="py-4 space-y-3 border-t border-green-600">
                    <!-- Public Site Link -->
                    <a href="{{ route('home') }}" class="block py-2 px-4 hover:bg-green-700 rounded transition flex items-center gap-2">
                        <i class="fas fa-globe w-4"></i>
                        Public Site
                    </a>
                    
                    <!-- Club Admin Navigation Links -->
                    <a href="{{ route('clubadmin.dashboard') }}" class="block py-2 px-4 hover:bg-green-700 rounded transition {{ request()->routeIs('clubadmin.dashboard') ? 'font-bold bg-green-700' : '' }} flex items-center gap-2">
                        <i class="fas fa-tachometer-alt w-4"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('clubadmin.club.show') }}" class="block py-2 px-4 hover:bg-green-700 rounded transition {{ request()->routeIs('clubadmin.club.*') ? 'font-bold bg-green-700' : '' }} flex items-center gap-2">
                        <i class="fas fa-users w-4"></i>
                        Club Details
                    </a>
                    <a href="{{ route('clubadmin.matches.upcoming') }}" class="block py-2 px-4 hover:bg-green-700 rounded transition {{ request()->routeIs('clubadmin.matches.*') ? 'font-bold bg-green-700' : '' }} flex items-center gap-2">
                        <i class="fas fa-calendar-alt w-4"></i>
                        Matches
                    </a>
                    <a href="{{ route('clubadmin.players.index') }}" class="block py-2 px-4 hover:bg-green-700 rounded transition {{ request()->routeIs('clubadmin.players.*') ? 'font-bold bg-green-700' : '' }} flex items-center gap-2">
                        <i class="fas fa-user w-4"></i>
                        Players
                    </a>

                    <!-- Mobile Logout Section -->
                    <div class="pt-3 border-t border-green-600">
                        <form action="{{ route('logout') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-left py-2 px-4 hover:bg-green-700 rounded transition flex items-center gap-2">
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
                <a href="{{ route('clubadmin.dashboard') }}" class="flex items-center gap-3 p-2 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded transition {{ request()->routeIs('clubadmin.dashboard') ? 'bg-green-50 text-green-600 font-semibold' : '' }}">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    Dashboard
                </a>
                <a href="{{ route('clubadmin.club.show') }}" class="flex items-center gap-3 p-2 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded transition {{ request()->routeIs('clubadmin.club.*') ? 'bg-green-50 text-green-600 font-semibold' : '' }}">
                    <i class="fas fa-users w-5"></i>
                    Club Details
                </a>
                <a href="{{ route('clubadmin.matches.upcoming') }}" class="flex items-center gap-3 p-2 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded transition {{ request()->routeIs('clubadmin.matches.*') ? 'bg-green-50 text-green-600 font-semibold' : '' }}">
                    <i class="fas fa-calendar-alt w-5"></i>
                    Matches
                </a>
                <a href="{{ route('clubadmin.players.index') }}" class="flex items-center gap-3 p-2 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded transition {{ request()->routeIs('clubadmin.players.*') ? 'bg-green-50 text-green-600 font-semibold' : '' }}">
                    <i class="fas fa-user w-5"></i>
                    Players
                </a>
            </div>

            <!-- Quick Actions -->
            <div class="space-y-2">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Quick Actions</h3>
                <a href="{{ route('clubadmin.players.create') }}" class="flex items-center gap-3 p-2 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded transition">
                    <i class="fas fa-user-plus w-5"></i>
                    Add Player
                </a>
            </div>

            <!-- Public Site Link in Sidebar -->
            <div class="space-y-2">
                <h3 class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Public Site</h3>
                <a href="{{ route('home') }}" class="flex items-center gap-3 p-2 text-gray-700 hover:bg-green-50 hover:text-green-600 rounded transition">
                    <i class="fas fa-globe w-5"></i>
                    View Public Site
                </a>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                    <span class="sr-only">Dismiss</span>
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                    <span class="sr-only">Dismiss</span>
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        // Scroll navbar effect
        document.addEventListener('scroll', function() {
            const navbar = document.querySelector('.clubadmin-navbar');
            if (window.scrollY > 50) { 
                navbar.classList.add('clubadmin-navbar-scrolled');
            } else {
                navbar.classList.remove('clubadmin-navbar-scrolled');
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

        // Sidebar toggle for mobile
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

