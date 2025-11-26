<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - mySSL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        background-color: transparent;
    }

    /* Menggunakan warna ungu utama #4A148C untuk navbar setelah di-scroll */
    .navbar-scrolled {
        background-color: rgba(74, 20, 140, 0.95); /* #4A148C dengan sedikit transparansi (95%) */
        backdrop-filter: blur(6px);
    }
    
    /* Hapus padding-top pada body agar konten hero section bisa mulai dari paling atas layar */
    /* Jika Anda ingin konten selanjutnya tidak tertutup navbar, tambahkan padding pada elemen setelah hero. */
    body {
        /* padding-top: 70px; */ /* Dihapus/Dikomenterkan */
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-futbol"></i> mySSL
            </a>
            
            @auth
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">
                    Halo, {{ auth()->user()->name }}
                </span>
                {{-- <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                </form> --}}
                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
            </div>
            @else
            <div class="navbar-nav ms-auto">
                <a href="#" class="btn btn-outline-light me-2">Login</a>
                <a href="#" class="btn btn-light">Register</a>
                {{-- <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-light">Register</a> --}}
            </div>
            @endauth
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-dark text-light py-4 mt-5">
        <div class="container text-center">
            <p>&copy; 2025/2026 mySSL - Soegija Super League</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            // Menambah jarak scroll lebih jauh (misalnya 50px) agar transparan lebih terasa
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