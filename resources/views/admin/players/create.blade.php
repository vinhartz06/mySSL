@extends('layouts.admin')

@section('title', 'Add Player')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Add New Player</h1>
    <p class="text-gray-600">Create a new player profile</p>
</div>

<div class="bg-white rounded-lg shadow p-6">
    <form action="{{ route('admin.players.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Player Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="club_id" class="block text-sm font-medium text-gray-700">Club</label>
                <select name="club_id" id="club_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                    <option value="">Select Club</option>
                    @foreach($clubs as $club)
                        <option value="{{ $club->id }}" {{ old('club_id') == $club->id ? 'selected' : '' }}>{{ $club->name }}</option>
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
                    <option value="GK" {{ old('position') == 'GK' ? 'selected' : '' }}>GK</option>
                    <option value="DF" {{ old('position') == 'DF' ? 'selected' : '' }}>DF</option>
                    <option value="MF" {{ old('position') == 'MF' ? 'selected' : '' }}>MF</option>
                    <option value="FW" {{ old('position') == 'FW' ? 'selected' : '' }}>FW</option>
                </select>
                @error('position')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="jersey_no" class="block text-sm font-medium text-gray-700">Jersey Number</label>
                <input type="number" name="jersey_no" id="jersey_no" value="{{ old('jersey_no') }}" min="1" max="99" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                @error('jersey_no')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Optional: Additional player information -->
        {{-- <div class="border-t pt-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Additional Information (Optional)</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality</label>
                    <input type="text" name="nationality" id="nationality" value="{{ old('nationality') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                </div>

                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                </div>
            </div>

            <div class="mb-6">
                <label for="bio" class="block text-sm font-medium text-gray-700">Bio/Description</label>
                <textarea name="bio" id="bio" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">{{ old('bio') }}</textarea>
            </div>
        </div> --}}

        <div class="flex justify-end space-x-3 pt-6 border-t">
            <a href="{{ route('admin.players.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">Cancel</a>
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Create Player</button>
        </div>
    </form>
</div>

<script>
    // simple validation to ensure jersey number is between 1-99
    document.getElementById('jersey_no').addEventListener('change', function() {
        const value = parseInt(this.value);

        if (value < 1 || value > 99) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Number',
                text: 'Jersey number must be between 1 and 99',
            });

            this.value = '';
        }
    });
</script>
@endsection