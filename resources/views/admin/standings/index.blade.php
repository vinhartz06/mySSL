@extends('layouts.admin')

@section('title', 'Manage Standings')

@push('scripts')
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            })
        </script>
    @endif
@endpush

@push('styles')
    <style>
        .position-1 {
            background-color: #FFED4E !important;
            color: #000;
            font-weight: bold;
        }
    
        .position-2 {
            background-color: #C0C0C0 !important;
            color: #000;
            font-weight: bold;
        }
    
        .position-3 {
            background-color: #D4A574 !important;
            color: #000;
            font-weight: bold;
        }
    
        .table-header {
            background: linear-gradient(135deg, #4A148C 0%, #6A1B9A 100%);
        }
    </style>
@endpush

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">League Standings</h1>
    <p class="text-gray-600">View and manage league standings</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="table-header">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white bold uppercase tracking-wider">Position</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white bold uppercase tracking-wider">Club</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white bold uppercase tracking-wider">Played</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white bold uppercase tracking-wider">Won</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white bold uppercase tracking-wider">Drawn</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white bold uppercase tracking-wider">Lost</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white bold uppercase tracking-wider">GF</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white bold uppercase tracking-wider">GA</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white bold uppercase tracking-wider">GD</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white bold uppercase tracking-wider">Points</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-white bold uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($standings as $index => $standing)
                <tr class="
                    {{ $index + 1 == 1 ? 'position-1' : '' }}
                    {{ $index + 1 == 2 ? 'position-2' : '' }}
                    {{ $index + 1 == 3 ? 'position-3' : '' }}
                ">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <span class="text-sm font-medium text-gray-900">{{ $index + 1 }}</span>
                            @if($index == 0)
                                <i class="fas fa-trophy text-yellow-900 ml-2"></i>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                                {{-- <i class="fas fa-users text-gray-500"></i> --}}
                                ⚽
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $standing->club->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standing->played }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standing->won }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standing->draw }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standing->lost }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standing->goals_for }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standing->goals_against }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium 
                        {{ $standing->goal_diff > 0 ? 'text-green-600' : ($standing->goal_diff < 0 ? 'text-red-600' : 'text-gray-600') }}">
                        {{ $standing->goal_diff > 0 ? '+' : '' }}{{ $standing->goal_diff }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ $standing->points }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.standings.edit', $standing) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Legend and Statistics -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Legend -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Standings Legend</h3>
        <div class="space-y-3">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 sm:w-4 sm:h-4 bg-yellow-400 rounded"></div>
                    <span>Champion</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 sm:w-4 sm:h-4 bg-gray-400 rounded"></div>
                    <span>Runner-up</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 sm:w-4 sm:h-4 bg-orange-300 rounded"></div>
                    <span>Second runner-up</span>
                </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">League Statistics</h3>
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Total Matches Played</span>
                <span class="text-sm font-medium text-gray-900">{{ $standings->sum('played') / 2 }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Total Goals Scored</span>
                <span class="text-sm font-medium text-gray-900">{{ $standings->sum('goals_for') }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Average Goals per Match</span>
                <span class="text-sm font-medium text-gray-900">
                    @php
                        $totalMatches = $standings->sum('played') / 2;
                        $totalGoals = $standings->sum('goals_for');
                        $avgGoals = $totalMatches > 0 ? round($totalGoals / $totalMatches, 2) : 0;
                    @endphp
                    {{ $avgGoals }}
                </span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Best Attack</span>
                <span class="text-sm font-medium text-gray-900">
                    {{ $standings->sortByDesc('goals_for')->first()->club->name }} ({{ $standings->max('goals_for') }})
                </span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-600">Best Defense</span>
                <span class="text-sm font-medium text-gray-900">
                    {{ $standings->sortBy('goals_against')->first()->club->name }} ({{ $standings->min('goals_against') }})
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Note -->
<div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
    <div class="flex">
        <i class="fas fa-exclamation-triangle text-yellow-400 mt-1 mr-3"></i>
        <div>
            <h4 class="text-sm font-medium text-yellow-800">Note</h4>
            <p class="text-sm text-yellow-700 mt-1">
                Standings are automatically calculated based on match results. Manual edits should only be used for corrections.
            </p>
        </div>
    </div>
</div>
@endsection