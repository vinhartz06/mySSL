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
        background-color: rgba(74, 20, 140, 0.3);
        backdrop-filter: blur(5px);
    }

    .navbar-scrolled {
        background-color: rgba(74, 20, 140, 0.9);
        backdrop-filter: blur(10px);
    }
</style>

<body class="bg-gray-100">

    <nav class="navbar-custom text-white">
        <div class="max-w-6xl mx-auto flex items-center justify-between py-4 px-4">

            <a href="{{ route('home') }}" class="text-xl font-semibold flex items-center gap-2">
                <i class="fas fa-futbol"></i> mySSL
            </a>

            @auth
            <div class="flex items-center gap-4">
                <span class="text-white">
                    Halo, {{ auth()->user()->name }}
                </span>

                <button type="submit"
                    class="border border-white text-white px-3 py-1 rounded hover:bg-white hover:text-purple-800 transition">
                    Logout
                </button>
            </div>

            @else
            <div class="flex items-center gap-3">
                <a href="#"
                    class="border border-white text-white px-3 py-1 rounded hover:bg-white hover:text-purple-800 transition">
                    Login
                </a>

                <a href="#"
                    class="bg-white text-purple-800 px-3 py-1 rounded hover:bg-gray-200 transition">
                    Register
                </a>
            </div>
            @endauth

        </div>
    </nav>

    <main>
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