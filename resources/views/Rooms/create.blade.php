@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-gray-800 text-white rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold mb-6">Create New Room</h2>

        <form action="{{ route('rooms.store') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
            @csrf

            <!-- Room Name -->
            <div class="mb-4">
                <label for="name" class="form-label text-lg">Room Name</label>
                <input type="text" class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="form-label text-lg">Description</label>
                <textarea class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="form-label text-lg">Price</label>
                <input type="number" class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" id="price" name="price" value="{{ old('price') }}" required>
            </div>

            <!-- Hotel Selection -->
            <div class="mb-4">
                <label for="hotel_id" class="form-label text-lg">Hotel</label>
                <select class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" id="hotel_id" name="hotel_id" required>
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>{{ $hotel->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Quantity -->
            <div class="mb-4">
                <label for="qty" class="form-label text-lg">Quantity</label>
                <input type="number" class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" id="qty" name="qty" value="{{ old('qty') }}" required min="1">
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="form-label text-lg">Status</label>
                <select class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" id="status" name="status">
                    <option value="1" {{ old('status', true) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="image" class="form-label text-lg">Room Image</label>
                <input type="file" class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" id="image" name="image">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-full p-3 bg-blue-600 hover:bg-blue-700 rounded-md text-white font-semibold">Create Room</button>
        </form>
    </div>
@endsection
