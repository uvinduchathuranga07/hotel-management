@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-gray-800 text-white rounded-lg shadow-lg">
        <h2 class="text-3xl font-semibold mb-6">Edit Room</h2>

        <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Room Name -->
            <div class="mb-4">
                <label for="name" class="form-label text-lg">Room Name</label>
                <input type="text" class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    id="name" name="name" value="{{ old('name', $room->name) }}" required>
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label for="description" class="form-label text-lg">Description</label>
                <textarea class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    id="description" name="description" rows="4" required>{{ old('description', $room->description) }}</textarea>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label for="price" class="form-label text-lg">Price</label>
                <input type="number" class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    id="price" name="price" value="{{ old('price', $room->price) }}" required>
            </div>

            <!-- Quantity -->
            <div class="mb-4">
                <label for="qty" class="form-label text-lg">Quantity</label>
                <input type="number" class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    id="qty" name="qty" value="{{ old('qty', $room->qty) }}" required>
            </div>

            <!-- Hotel -->
            <div class="mb-4">
                <label for="hotel_id" class="form-label text-lg">Hotel</label>
                <select class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    id="hotel_id" name="hotel_id" required>
                    @foreach ($hotels as $hotel)
                        <option value="{{ $hotel->id }}" {{ $hotel->id == $room->hotel_id ? 'selected' : '' }}>{{ $hotel->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="image" class="form-label text-lg">Room Image</label>
                <input type="file" class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    id="image" name="image" accept="image/*">
                @if ($room->image)
                    <div class="mt-2">
                        <img src="{{ Storage::url($room->image) }}" alt="Room Image" class="w-32 h-32 object-cover rounded-md">
                    </div>
                @endif
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="form-label text-lg">Status</label>
                <select class="form-control w-full p-3 mt-2 text-black rounded-md bg-gray-200 dark:bg-gray-700 dark:text-white border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    id="status" name="status">
                    <option value="1" {{ old('status', $room->status) ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $room->status) ? '' : 'selected' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md w-full">
                Update Room
            </button>
        </form>
    </div>
@endsection
