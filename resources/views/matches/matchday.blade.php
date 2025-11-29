@extends('layouts.app')

@section('title', "Matchday $matchday")

@push('styles')
<style>
    .matches-container {
        padding-top: 80px;
        padding-bottom: 60px;
    }
    
    .matchday-header {
        background: linear-gradient(135deg, #4A148C 0%, #6A1B9A 100%);
        color: white;
    }
    
    /* Reuse styles from matches index */
</style>
@endpush

@section('content')
<div class="matches-container">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold mb-2">Matchday {{ $matchday }}</h1>
            <p class="text-gray-600">Soegija Super League 2025/2026</p>
        </div>

        <!-- Back to all matches -->
        <div class="text-center mb-6">
            <a href="{{ route('matches.index') }}" class="inline-flex items-center text-purple-600 hover:text-purple-800">
                <i class="fas fa-arrow-left mr-2"></i> Back to All Matches
            </a>
        </div>

        <!-- Matches for this matchday -->
        @if($matches->count() > 0)
            @foreach($matches as $match)
                <a href="{{ route('matches.show', $match->id) }}" class="block">
                    <div class="match-card">
                        <!-- Same match card structure as index -->
                        <!-- Copy from matches/index.blade.php -->
                    </div>
                </a>
            @endforeach
        @else
            <div class="text-center py-12">
                <i class="fas fa-futbol text-4xl text-gray-400 mb-4"></i>
                <h3 class="text-xl font-semibold mb-2">No Matches for Matchday {{ $matchday }}</h3>
                <p class="text-gray-600">Check back later for scheduled matches.</p>
            </div>
        @endif
    </div>
</div>
@endsection