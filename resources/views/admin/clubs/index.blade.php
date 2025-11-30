@extends('layouts.admin')

@section('title', 'Manage Clubs')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manage Clubs</h1>
    <p class="text-gray-600">View and manage all clubs in the league</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Club</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Coach</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Players</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($clubs as $club)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-users text-gray-500"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">{{ $club->name }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $club->coach ?? 'Not specified' }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $club->players_count }} players
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('admin.clubs.edit', $club) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                    <a href="{{ route('clubs.show', $club) }}" class="text-green-600 hover:text-green-900" target="_blank">View Public</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $clubs->links() }}
    </div>
</div>

<!-- Statistics -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-600">
                <i class="fas fa-users"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Clubs</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $clubs->total() }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-user"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Players</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $clubs->sum('players_count') }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Avg Players/Club</p>
                <p class="text-2xl font-semibold text-gray-900">{{ round($clubs->avg('players_count'), 1) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection