@extends('layouts.clubadmin')

@section('title', 'Manage Lineup')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manage Lineup</h1>
    <p class="text-gray-600">{{ $match->homeClub->name }} vs {{ $match->awayClub->name }} - {{ $match->match_date->format('M d, Y H:i') }}</p>
</div>

<form action="{{ route('clubadmin.matches.lineup.store', $match) }}" method="POST">
    @csrf

    <!-- Starting Lineup -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Starting Lineup (Select 11 players)</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="starters-container">
                @for($i = 0; $i < 11; $i++)
                <div class="starter-select">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Player {{ $i + 1 }}</label>
                    <select name="starters[]" class="starter-select-field w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                        <option value="">Select Player</option>
                        @foreach($players as $player)
                            <option value="{{ $player->id }}" 
                                {{ $startingLineup->contains('player_id', $player->id) ? 'selected' : '' }}>
                                #{{ $player->jersey_no }} - {{ $player->name }} ({{ $player->position }})
                            </option>
                        @endforeach
                    </select>
                </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Substitute Lineup -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">Substitutes (Optional, max 12)</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="substitutes-container">
                @for($i = 0; $i < 12; $i++)
                <div class="substitute-select">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Substitute {{ $i + 1 }}</label>
                    <select name="substitutes[]" class="substitute-select-field w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="">Select Player (Optional)</option>
                        @foreach($players as $player)
                            <option value="{{ $player->id }}" 
                                {{ $substituteLineup->contains('player_id', $player->id) ? 'selected' : '' }}>
                                #{{ $player->jersey_no }} - {{ $player->name }} ({{ $player->position }})
                            </option>
                        @endforeach
                    </select>
                </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end gap-4">
        <a href="{{ route('clubadmin.matches.upcoming') }}" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
            Cancel
        </a>
        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
            <i class="fas fa-save mr-2"></i>Save Lineup
        </button>
    </div>
</form>

@push('scripts')
<script>
    // Prevent duplicate player selection in starters
    document.querySelectorAll('.starter-select-field').forEach(function(select) {
        select.addEventListener('change', function() {
            const selectedValue = this.value;
            if (selectedValue) {
                document.querySelectorAll('.starter-select-field').forEach(function(otherSelect) {
                    if (otherSelect !== select && otherSelect.value === selectedValue) {
                        otherSelect.value = '';
                    }
                });
            }
        });
    });

    // Prevent duplicate player selection in substitutes
    document.querySelectorAll('.substitute-select-field').forEach(function(select) {
        select.addEventListener('change', function() {
            const selectedValue = this.value;
            if (selectedValue) {
                // Check if already selected in starters
                let isInStarters = false;
                document.querySelectorAll('.starter-select-field').forEach(function(starterSelect) {
                    if (starterSelect.value === selectedValue) {
                        isInStarters = true;
                    }
                });

                if (isInStarters) {
                    alert('This player is already in the starting lineup!');
                    this.value = '';
                    return;
                }

                // Check if already selected in other substitutes
                document.querySelectorAll('.substitute-select-field').forEach(function(otherSelect) {
                    if (otherSelect !== select && otherSelect.value === selectedValue) {
                        otherSelect.value = '';
                    }
                });
            }
        });
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const starters = Array.from(document.querySelectorAll('.starter-select-field'))
            .map(select => select.value)
            .filter(value => value !== '');

        if (starters.length !== 11) {
            e.preventDefault();
            alert('Please select exactly 11 players for the starting lineup.');
            return false;
        }

        // Check for duplicates
        const uniqueStarters = new Set(starters);
        if (uniqueStarters.size !== starters.length) {
            e.preventDefault();
            alert('Please ensure all starting players are unique.');
            return false;
        }
    });
</script>
@endpush
@endsection

