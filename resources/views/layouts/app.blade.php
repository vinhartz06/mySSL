<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - mySSL</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

    .navbar-custom {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 2000;
        transition: background-color 0.3s ease, backdrop-filter 0.3s ease;
        background-color: rgba(74, 20, 140, 0.95);
        backdrop-filter: blur(5px);
    }

    .navbar-scrolled {
        background-color: rgba(74, 20, 140, 0.7);
        backdrop-filter: blur(10px);
    }

    /* Mobile menu animation */
    .mobile-menu {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
        background-color: rgba(74, 20, 140, 0.95);
    }

    .mobile-menu.active {
        max-height: 500px;
    }

    /* Hamburger menu animation */
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

    /* Main content area */
    main {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* Footer */
    footer {
        margin-top: auto;
    }
</style>

<body class="bg-gray-100">
    <nav class="navbar-custom text-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-3">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-lg sm:text-xl font-semibold flex items-center gap-2">
                    <i class="fas fa-futbol"></i> 
                    <span class="hidden xs:inline">mySSL</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="hover:text-gray-200 transition {{ request()->routeIs('home') ? 'font-bold' : '' }}">Home</a>
                    <a href="{{ route('clubs.index') }}" class="hover:text-gray-200 transition {{ request()->routeIs('clubs.*') ? 'font-bold' : '' }}">Clubs</a>
                    <a href="{{ route('matches.index') }}" class="hover:text-gray-200 transition {{ request()->routeIs('matches.*') ? 'font-bold' : '' }}">Matches</a>
                    <a href="{{ route('standings') }}" class="hover:text-gray-200 transition {{ request()->routeIs('standings') ? 'font-bold' : '' }}">Standings</a>
                </div>

                <!-- Desktop Auth Buttons -->
                <div class="hidden lg:flex items-center gap-4">
                    @auth
                    <span class="text-white text-sm xl:text-base truncate max-w-[150px]">
                        Hello, {{ auth()->user()->name }} 👋
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="border border-white text-white px-3 py-1.5 rounded text-sm hover:bg-white hover:text-purple-800 transition whitespace-nowrap">
                            Logout
                        </button>
                    </form>
                    @else
                    <a href="{{ route('show.login') }}" class="border border-white text-white px-3 py-1.5 rounded text-sm hover:bg-white hover:text-purple-800 transition whitespace-nowrap">
                        Login
                    </a>
                    <a href="{{ route('show.register') }}" class="bg-white text-purple-800 px-3 py-1.5 rounded text-sm hover:bg-gray-200 transition whitespace-nowrap">
                        Register
                    </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button class="lg:hidden hamburger flex flex-col justify-center items-center w-10 h-10" id="mobile-menu-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div class="mobile-menu lg:hidden" id="mobile-menu">
                <div class="py-4 space-y-3 border-t border-purple-600">
                    <!-- Mobile Navigation Links -->
                    <a href="{{ route('home') }}" class="block py-2 px-4 hover:bg-purple-700 rounded transition {{ request()->routeIs('home') ? 'font-bold bg-purple-700' : '' }}">
                        Home
                    </a>
                    <a href="{{ route('clubs.index') }}" class="block py-2 px-4 hover:bg-purple-700 rounded transition {{ request()->routeIs('clubs.*') ? 'font-bold bg-purple-700' : '' }}">
                        Clubs
                    </a>
                    <a href="{{ route('matches.index') }}" class="block py-2 px-4 hover:bg-purple-700 rounded transition {{ request()->routeIs('matches.*') ? 'font-bold bg-purple-700' : '' }}">
                        Matches
                    </a>
                    <a href="{{ route('standings') }}" class="block py-2 px-4 hover:bg-purple-700 rounded transition {{ request()->routeIs('standings') ? 'font-bold bg-purple-700' : '' }}">
                        Standings
                    </a>

                    <!-- Mobile Auth Section -->
                    <div class="pt-3 border-t border-purple-600">
                        @auth
                        <div class="px-4 py-2">
                            <p class="text-sm text-gray-200 mb-3">Hello, {{ auth()->user()->name }} 👋</p>
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full border border-white text-white px-3 py-2 rounded hover:bg-white hover:text-purple-800 transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                        @else
                        <div class="px-4 space-y-2">
                            <a href="{{ route('show.login') }}" class="block w-full text-center border border-white text-white px-3 py-2 rounded hover:bg-white hover:text-purple-800 transition">
                                Login
                            </a>
                            <a href="{{ route('show.register') }}" class="block w-full text-center bg-white text-purple-800 px-3 py-2 rounded hover:bg-gray-200 transition">
                                Register
                            </a>
                        </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-[#4A148C] text-white py-6 sm:py-8">
        <div class="max-w-6xl mx-auto text-center px-4">
            <p class="text-sm sm:text-base">&copy; 2025/2026 mySSL - Soegija Super League</p>
        </div>
    </footer>

    <script>
        // Scroll navbar effect
        document.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) { 
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
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
    </script>

    @stack('scripts')
</body>
</html>