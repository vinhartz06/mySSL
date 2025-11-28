<!-- [file name]: show.blade.php -->
@extends('layouts.app')

@section('title', $club->name . ' - Club Details')

@push('styles')
<style>
    .club-hero {
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        color: white;
        height: 100dvh;
        display: flex;
        align-items: center;
        padding-top: 0;
        margin-top: 0;
    }

    .detail-card {
        background: white;
        border-radius: 10px;
        padding: 30px;
        margin-bottom: 20px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    }

    .club-logo-large {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #4A148C 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: white;
        margin: 0 auto 20px;
    }

    .back-btn {
        background: #6B7280;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .back-btn:hover {
        background: #4B5563;
        transform: translateY(-2px);
        color: white;
    }

    .hero-content {
        padding-top: 60px; /* Reduced from 80px to account for smaller navbar */
        padding-bottom: 80px;
    }
</style>
@endpush

@section('content')
    <!-- Club Hero Section -->
    <section class="club-hero">
        <div class="max-w-6xl mx-auto w-full px-4 text-center">
            <div class="hero-content">
                <div class="club-logo-large">
                    <i class="fas fa-futbol"></i>
                </div>
                <h1 class="text-5xl font-bold mb-4">{{ $club->name }}</h1>
                <p class="text-xl opacity-90 mb-6">Soegija Super League Club</p>
                <p class="text-lg opacity-80 mb-8">Coach: {{ $club->coach }}</p>
                <a href="#club-details" class="bg-white text-purple-800 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                    View Club Details
                </a>
            </div>
        </div>
    </section>

    <!-- Club Details -->
    <section id="club-details" class="py-16 bg-gray-100">
        <div class="max-w-4xl mx-auto px-4">
            <div class="detail-card">
                <h2 class="text-2xl font-bold mb-6 text-center">Club Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                        <h3 class="font-semibold text-purple-800 mb-2">Club Name</h3>
                        <p class="text-lg">{{ $club->name }}</p>
                    </div>
                    <div class="text-center p-4 bg-purple-50 rounded-lg">
                        <h3 class="font-semibold text-purple-800 mb-2">Head Coach</h3>
                        <p class="text-lg">{{ $club->coach }}</p>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-4">About the Club</h3>
                    <p class="text-gray-600 mb-4">
                        {{ $club->name }} is one of the prominent clubs in the Soegija Super League, 
                        known for their dedication and competitive spirit in every match.
                    </p>
                    <p class="text-gray-600">
                        Under the guidance of Coach {{ $club->coach }}, the team continues to strive 
                        for excellence and aims to achieve remarkable results in the current season.
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center mt-8">
                <a href="{{ route('clubs.index') }}" class="back-btn inline-flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Back to All Clubs
                </a>
            </div>
        </div>
    </section>
@endsection