<!-- [file name]: index.blade.php -->
@extends('layouts.app')

@section('title', 'Clubs')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        color: white;
        height: 100dvh;
        display: flex;
        align-items: center;
        padding-top: 0;
        margin-top: 0;
    }

    .club-card {
        transition: transform 0.3s, box-shadow 0.3s;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .club-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .club-logo {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: white;
        margin: 0 auto 15px;
    }

    .view-more-btn {
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 5px;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
    }

    .view-more-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(74, 20, 140, 0.4);
        color: white;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: #4A148C;
        margin-bottom: 0.5rem;
    }

    .club-name {
        color: #4A148C;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .coach-text {
        color: #6B7280;
        margin-bottom: 1rem;
    }

    .hero-content {
        padding-top: 60px; /* Reduced from 80px to account for smaller navbar */
        padding-bottom: 80px;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="max-w-6xl mx-auto w-full px-4">
            <div class="hero-content text-center">
                <h1 class="text-5xl font-bold mb-6">mySSL</h1>
                <p class="text-xl mb-8 opacity-90 max-w-3xl mx-auto">
                    Discover all the amazing clubs competing in the Soegija Super League
                </p>
                <div class="flex justify-center gap-4">
                    <a href="#clubs-grid" class="bg-white text-purple-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                        Explore Clubs
                    </a>
                    {{-- <a href="{{ route('standings') }}" class="border border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-800 transition duration-300"> --}}
                    <a href="#" class="border border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-800 transition duration-300">
                        View Standings
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Clubs Grid Section -->
    <section id="clubs-grid" class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Soegija Super League Clubs</h2>
                <p class="text-gray-600 text-lg">Meet the teams competing in this season's tournament</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                @foreach($clubs as $club)
                <div class="club-card bg-white p-6 text-center">
                    <div class="club-logo">
                        <i class="fas fa-futbol"></i>
                    </div>
                    <h3 class="club-name text-xl">{{ $club->name }}</h3>
                    <p class="coach-text">
                        <strong>Coach:</strong> {{ $club->coach }}
                    </p>
                    <a href="{{ route('clubs.show', $club->id) }}" 
                       class="view-more-btn">
                        View Details <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                @endforeach
            </div>

            <!-- Stats Section -->
            <div class="bg-white rounded-xl p-8 shadow-lg">
                <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">League Overview</h2>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="stat-number">{{ $clubs->count() }}</div>
                        <p class="text-gray-600 font-medium">Clubs</p>
                    </div>
                    <div class="text-center">
                        <div class="stat-number">10+</div>
                        <p class="text-gray-600 font-medium">Professional Coaches</p>
                    </div>
                    <div class="text-center">
                        <div class="stat-number">200+</div>
                        <p class="text-gray-600 font-medium">Active Players</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection