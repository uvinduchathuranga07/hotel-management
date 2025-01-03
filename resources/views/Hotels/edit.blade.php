@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-gray-800 text-white rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold mb-6">Edit Hotel</h2>

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger bg-red-600 text-white rounded-md p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="name" class="form-label text-lg">Hotel Name</label>
                <input type="text" class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    id="name" name="name" value="{{ old('name', $hotel->name) }}" required>
            </div>

            <div class="mb-4">
                <label for="description" class="form-label text-lg">Description</label>
                <textarea class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    id="description" name="description" rows="4" required>{{ old('description', $hotel->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="form-label text-lg">Hotel Image</label>
                <input type="file" class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    id="image" name="image" accept="image/*">

                @if($hotel->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $hotel->image) }}" alt="Hotel Image" class="w-24 h-24 object-cover rounded-md">
                    </div>
                @else
                    <p class="text-sm text-gray-400">No image available</p>
                @endif
            </div>

            <div class="mb-4">
                <label for="status" class="form-label text-lg">Status</label>
                <select class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    id="status" name="status">
                    <option value="1" {{ $hotel->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$hotel->status ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md w-full">
                Update Hotel
            </button>
        </form>
    </div>
@endsection
