@extends('layouts.admin')

@section('title', 'Edit Standing')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Edit Standing: {{ $standing->club->name }}</h1>
    <p class="text-gray-600">Update club standing information</p>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.standings.update', $standing) }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Club Information -->
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0 h-12 w-12 bg-gray-200 rounded-full flex items-center justify-center">
                    <i class="fas fa-users text-gray-500"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-gray-900">{{ $standing->club->name }}</h3>
                    <p class="text-sm text-gray-500">Current position in standings</p>
                </div>
            </div>
        </div>

        <!-- Match Results -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div>
                <label for="played" class="block text-sm font-medium text-gray-700">Matches Played</label>
                <input type="number" name="played" id="played" value="{{ old('played', $standing->played) }}" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('played')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="won" class="block text-sm font-medium text-gray-700">Won</label>
                <input type="number" name="won" id="won" value="{{ old('won', $standing->won) }}" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('won')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="draw" class="block text-sm font-medium text-gray-700">Drawn</label>
                <input type="number" name="draw" id="draw" value="{{ old('draw', $standing->draw) }}" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('draw')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="lost" class="block text-sm font-medium text-gray-700">Lost</label>
                <input type="number" name="lost" id="lost" value="{{ old('lost', $standing->lost) }}" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('lost')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Goals -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div>
                <label for="goals_for" class="block text-sm font-medium text-gray-700">Goals For</label>
                <input type="number" name="goals_for" id="goals_for" value="{{ old('goals_for', $standing->goals_for) }}" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('goals_for')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="goals_against" class="block text-sm font-medium text-gray-700">Goals Against</label>
                <input type="number" name="goals_against" id="goals_against" value="{{ old('goals_against', $standing->goals_against) }}" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('goals_against')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="goal_diff" class="block text-sm font-medium text-gray-700">Goal Difference</label>
                <input type="number" name="goal_diff" id="goal_diff" value="{{ old('goal_diff', $standing->goal_diff) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('goal_diff')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mb-6">
            <label for="points" class="block text-sm font-medium text-gray-700">Points</label>
            <input type="number" name="points" id="points" value="{{ old('points', $standing->points) }}" min="0" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
            @error('points')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Validation and Auto-calculation -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex">
                <i class="fas fa-info-circle text-blue-400 mt-1 mr-3"></i>
                <div>
                    <h4 class="text-sm font-medium text-blue-800">Validation Rules</h4>
                    <ul class="text-sm text-blue-700 mt-1 list-disc list-inside space-y-1">
                        <li>Matches Played = Won + Drawn + Lost</li>
                        <li>Goal Difference = Goals For - Goals Against</li>
                        <li>Points = (Won × 3) + Drawn</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Current Summary -->
        <div class="border-t pt-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Current Summary</h3>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="text-2xl font-bold text-gray-900">{{ $standing->played }}</div>
                    <div class="text-sm text-gray-600">Played</div>
                </div>
                
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-600">{{ $standing->won * 3 + $standing->draw }}</div>
                    <div class="text-sm text-gray-600">Points</div>
                </div>
                
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600">{{ $standing->goals_for }}</div>
                    <div class="text-sm text-gray-600">Goals For</div>
                </div>
                
                <div class="text-center p-4 bg-red-50 rounded-lg">
                    <div class="text-2xl font-bold text-red-600">{{ $standing->goals_against }}</div>
                    <div class="text-sm text-gray-600">Goals Against</div>
                </div>
            </div>
        </div>

        <div class="flex justify-end space-x-3 pt-6 border-t">
            <a href="{{ route('admin.standings.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Cancel</a>
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Update Standing</button>
        </div>
    </form>
</div>

<script>
    // Auto-calculate goal difference
    document.getElementById('goals_for').addEventListener('input', updateGoalDiff);
    document.getElementById('goals_against').addEventListener('input', updateGoalDiff);
    
    function updateGoalDiff() {
        const goalsFor = parseInt(document.getElementById('goals_for').value) || 0;
        const goalsAgainst = parseInt(document.getElementById('goals_against').value) || 0;
        document.getElementById('goal_diff').value = goalsFor - goalsAgainst;
    }

    // Auto-calculate points
    document.getElementById('won').addEventListener('input', updatePoints);
    document.getElementById('draw').addEventListener('input', updatePoints);
    
    function updatePoints() {
        const won = parseInt(document.getElementById('won').value) || 0;
        const draw = parseInt(document.getElementById('draw').value) || 0;
        document.getElementById('points').value = (won * 3) + draw;
    }

    // Validate matches played equals won + draw + lost
    function validateMatches() {
        const played = parseInt(document.getElementById('played').value) || 0;
        const won = parseInt(document.getElementById('won').value) || 0;
        const draw = parseInt(document.getElementById('draw').value) || 0;
        const lost = parseInt(document.getElementById('lost').value) || 0;
        
        if (played !== (won + draw + lost)) {
            alert('Matches Played must equal Won + Drawn + Lost');
            return false;
        }
        return true;
    }

    // Add validation on form submit
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!validateMatches()) {
            e.preventDefault();
        }
    });
</script>
@endsection