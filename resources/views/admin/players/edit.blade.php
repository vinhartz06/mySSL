@extends('layouts.admin')

@section('title', 'Edit Player')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Player: {{ $player->name }}</h1>
    <p class="text-gray-600">Update player information and statistics</p>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.players.update', $player) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Player Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $player->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="club_id" class="block text-sm font-medium text-gray-700">Club</label>
                <select name="club_id" id="club_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                    <option value="">Select Club</option>
                    @foreach($clubs as $club)
                        <option value="{{ $club->id }}" {{ $player->club_id == $club->id ? 'selected' : '' }}>{{ $club->name }}</option>
                    @endforeach
                </select>
                @error('club_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                <select name="position" id="position" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                    <option value="">Select Position</option>
                    <option value="Goalkeeper" {{ $player->position == 'Goalkeeper' ? 'selected' : '' }}>Goalkeeper</option>
                    <option value="Defender" {{ $player->position == 'Defender' ? 'selected' : '' }}>Defender</option>
                    <option value="Midfielder" {{ $player->position == 'Midfielder' ? 'selected' : '' }}>Midfielder</option>
                    <option value="Forward" {{ $player->position == 'Forward' ? 'selected' : '' }}>Forward</option>
                    <option value="Striker" {{ $player->position == 'Striker' ? 'selected' : '' }}>Striker</option>
                    <option value="Winger" {{ $player->position == 'Winger' ? 'selected' : '' }}>Winger</option>
                </select>
                @error('position')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jersey_no" class="block text-sm font-medium text-gray-700">Jersey Number</label>
                <input type="number" name="jersey_no" id="jersey_no" value="{{ old('jersey_no', $player->jersey_no) }}" min="1" max="99" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('jersey_no')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Player Statistics -->
        <div class="border-t pt-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Player Statistics</h3>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-2xl font-bold text-gray-900">{{ $player->matches_played }}</div>
                    <div class="text-sm text-gray-600">Matches Played</div>
                </div>
                
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-600">{{ $player->total_goals }}</div>
                    <div class="text-sm text-gray-600">Goals</div>
                </div>
                
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600">{{ $player->total_assists }}</div>
                    <div class="text-sm text-gray-600">Assists</div>
                </div>
                
                <div class="text-center p-4 bg-yellow-50 rounded-lg">
                    <div class="text-2xl font-bold text-yellow-600">
                        {{ $player->total_yellow_cards + $player->total_red_cards }}
                    </div>
                    <div class="text-sm text-gray-600">Cards</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <h4 class="font-medium text-gray-700">Performance Averages</h4>
                    <div class="text-sm space-y-1">
                        <div class="flex justify-between">
                            <span>Successful Passes:</span>
                            <span class="font-medium">{{ $player->avg_succ_passes }}%</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Ground Duels:</span>
                            <span class="font-medium">{{ $player->avg_succ_ground_duels }}%</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Aerial Duels:</span>
                            <span class="font-medium">{{ $player->avg_succ_aerial_duels }}%</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Dribbles:</span>
                            <span class="font-medium">{{ $player->avg_succ_dribbles }}%</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-2">
                    <h4 class="font-medium text-gray-700">Defensive Stats</h4>
                    <div class="text-sm space-y-1">
                        <div class="flex justify-between">
                            <span>Tackles:</span>
                            <span class="font-medium">{{ $player->total_tackles }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Interceptions:</span>
                            <span class="font-medium">{{ $player->total_interceptions }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Clearances:</span>
                            <span class="font-medium">{{ $player->total_clearances }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Saves (GK):</span>
                            <span class="font-medium">{{ $player->total_saves }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3 pt-6 border-t">
            <a href="{{ route('admin.players.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Cancel</a>
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Update Player</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('jersey_no').addEventListener('change', function() {
        const value = parseInt(this.value);
        if (value < 1 || value > 99) {
            alert('Jersey number must be between 1 and 99');
            this.value = '{{ $player->jersey_no }}';
        }
    });
</script>
@endsection