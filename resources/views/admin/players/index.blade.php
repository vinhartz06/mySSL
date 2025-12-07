@extends('layouts.admin')

@section('title', 'Manage Players')

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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.show_confirm').forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    let form = this.closest('form');

                    Swal.fire({
                        title: "Are you sure?",
                        text: "This player will be permanently deleted!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Yes, delete it",
                        cancelButtonText: "Cancel"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manage Players</h1>
        <p class="text-gray-600">View and manage all players in the league</p>
    </div>
    <a href="{{ route('admin.players.create') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
        <i class="fas fa-plus mr-2"></i>Add Player
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Player</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Club</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statistics</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach($players as $player)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-gray-500"></i>
                        </div>
                        <div class="ml-4">
                            <div class="text-sm font-medium text-gray-900">{{ $player->name }}</div>
                            <div class="text-sm text-gray-500">#{{ $player->jersey_no }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ $player->club->name }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $player->position }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 space-y-1">
                        <div class="flex space-x-4 text-xs">
                            <span class="flex items-center">
                                <i class="fas fa-futbol text-green-500 mr-1"></i>
                                {{ $player->total_goals }} goals
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-hand-holding text-blue-500 mr-1"></i>
                                {{ $player->total_assists }} assists
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-calendar text-gray-500 mr-1"></i>
                                {{ $player->matches_played }} matches
                            </span>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('admin.players.edit', $player) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                    <form action="{{ route('admin.players.destroy', $player) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900 show_confirm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $players->links() }}
    </div>
</div>

<!-- Statistics -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-600">
                <i class="fas fa-user"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Players</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $players->total() }}</p>
                {{-- total = all from db
                count = total in page --}}
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i class="fas fa-futbol"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Goals</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $allPlayers->sum('total_goals') }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-assist"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Assists</p>
                <p class="text-2xl font-semibold text-gray-900">{{ $allPlayers->sum('total_assists') }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-star"></i>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Avg Goals/Player</p>
                <p class="text-2xl font-semibold text-gray-900">{{ round($allPlayers->avg('total_goals'), 1) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection