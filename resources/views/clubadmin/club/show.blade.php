@extends('layouts.clubadmin')

@section('title', 'Club Details')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Club Details</h1>
    <p class="text-gray-600">View and manage your club information</p>
</div>

<!-- Club Information -->
<div class="bg-white rounded-lg shadow mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">{{ $club->name }}</h2>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-600 mb-1">Coach</p>
                <p class="text-lg font-semibold text-gray-900">{{ $club->coach ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 mb-1">Total Players</p>
                <p class="text-lg font-semibold text-gray-900">{{ $players->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Club Stats -->
@if($standing)
<div class="bg-white rounded-lg shadow mb-8">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-800">Club Stats</h2>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center p-4 bg-green-50 rounded-lg">
                <p class="text-sm text-gray-600">Points</p>
                <p class="text-3xl font-bold text-green-600">{{ $standing->points }}</p>
            </div>
            <div class="text-center p-4 bg-blue-50 rounded-lg">
                <p class="text-sm text-gray-600">Played</p>
                <p class="text-3xl font-bold text-blue-600">{{ $standing->played }}</p>
            </div>
            <div class="text-center p-4 bg-green-50 rounded-lg">
                <p class="text-sm text-gray-600">Won</p>
                <p class="text-3xl font-bold text-green-600">{{ $standing->won }}</p>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600">Drawn</p>
                <p class="text-3xl font-bold text-gray-600">{{ $standing->draw }}</p>
            </div>
            <div class="text-center p-4 bg-red-50 rounded-lg">
                <p class="text-sm text-gray-600">Lost</p>
                <p class="text-3xl font-bold text-red-600">{{ $standing->lost }}</p>
            </div>
            <div class="text-center p-4 bg-blue-50 rounded-lg">
                <p class="text-sm text-gray-600">Goals For</p>
                <p class="text-3xl font-bold text-blue-600">{{ $standing->goals_for }}</p>
            </div>
            <div class="text-center p-4 bg-red-50 rounded-lg">
                <p class="text-sm text-gray-600">Goals Against</p>
                <p class="text-3xl font-bold text-red-600">{{ $standing->goals_against }}</p>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <p class="text-sm text-gray-600">Goal Difference</p>
                <p class="text-3xl font-bold text-gray-600">{{ $standing->goal_diff > 0 ? '+' : '' }}{{ $standing->goal_diff }}</p>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

