<!-- [file name]: app.blade.php -->
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

    body {
        font-family: 'Inter', sans-serif;
    }

    .navbar-custom {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 2000;
        transition: background-color 0.3s ease, backdrop-filter 0.3s ease;
        background-color: rgba(74, 20, 140, 1);
        backdrop-filter: blur(5px);
    }

    .navbar-scrolled {
        background-color: rgba(74, 20, 140, 0.7);
        backdrop-filter: blur(10px);
    }

    /* Remove default margin and padding */
    body, html {
        margin: 0;
        padding: 0;
    }
</style>

<body class="bg-gray-100">
    <nav class="navbar-custom text-white">
        <div class="max-w-6xl mx-auto flex items-center justify-between py-3 px-4"> <!-- Reduced py-4 to py-3 -->
            <a href="{{ route('home') }}" class="text-xl font-semibold flex items-center gap-2">
                <i class="fas fa-futbol"></i> mySSL
            </a>

            <div class="hidden md:flex items-center gap-8"> <!-- Increased gap from gap-6 to gap-8 -->
                <a href="{{ route('home') }}" class="hover:text-gray-200 transition {{ request()->routeIs('home') ? 'font-bold' : '' }}">Home</a>
                <a href="{{ route('standings') }}" class="hover:text-gray-200 transition {{ request()->routeIs('standings') ? 'font-bold' : '' }}">Standings</a>
                <a href="{{ route('clubs.index') }}" class="hover:text-gray-200 transition {{ request()->routeIs('clubs.*') ? 'font-bold' : '' }}">Clubs</a>
            </div>

            @auth
            <div class="flex items-center gap-4">
                <span class="text-white">
                    Halo, {{ auth()->user()->name }}
                </span>
                <button type="submit" class="border border-white text-white px-3 py-1 rounded hover:bg-white hover:text-purple-800 transition">
                    Logout
                </button>
            </div>
            @else
            <div class="flex items-center gap-4"> <!-- Increased gap from gap-3 to gap-4 -->
                {{-- <a href="{{ route('login') }}" class="border border-white text-white px-3 py-1 rounded hover:bg-white hover:text-purple-800 transition"> --}}
                <a href="#" class="border border-white text-white px-3 py-1 rounded hover:bg-white hover:text-purple-800 transition">
                    Login
                </a>
                {{-- <a href="{{ route('register') }}" class="bg-white text-purple-800 px-3 py-1 rounded hover:bg-gray-200 transition"> --}}
                <a href="#" class="bg-white text-purple-800 px-3 py-1 rounded hover:bg-gray-200 transition">
                    Register
                </a>
            </div>
            @endauth
        </div>
    </nav>

    <main class="min-h-screen pt-0"> <!-- Added pt-0 to remove padding-top -->
        @yield('content')
    </main>

    <footer class="bg-[#4A148C] text-white py-4 mt-5">
        <div class="max-w-6xl mx-auto text-center">
            <p>&copy; 2025/2026 mySSL - Soegija Super League</p>
        </div>
    </footer>

    <script>
        document.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) { 
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>