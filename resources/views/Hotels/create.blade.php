@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6 bg-gray-800 text-white rounded-lg shadow-lg">
        <h1 class="text-3xl font-semibold mb-6">Create New Hotel</h1>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="bg-red-600 text-white p-4 rounded-lg mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="mb-4">
            <a href="{{ route('hotels.create') }}" class="px-6 py-3 bg-green-600 text-white rounded-md hover:bg-green-700">
                Create Hotel
            </a>
        </div>

        <form action="{{ route('hotels.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Hotel Name -->
            <div class="mb-4">
                <label for="name" class="block text-lg">Hotel Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full p-3 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="block text-lg">Description</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full p-3 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-lg">Status</label>
                <select name="status" id="status" class="mt-1 block w-full p-3 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Hotel Image -->
            <div class="mb-4">
                <label for="image" class="block text-lg">Hotel Image (optional)</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full p-3 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('image')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-md w-full">
                Create Hotel
            </button>
        </form>
    </div>
@endsection
