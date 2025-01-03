<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the rooms.
     */
    public function index()
    {
        $rooms = Room::all(); // Fetch all rooms
        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new room.
     */
    public function create()
    {
        $hotels = Hotel::all(); // Fetch all hotels for the dropdown
        return view('rooms.create', compact('hotels'));
    }

    /**
     * Store a newly created room in storage.
     */
    public function store(Request $request)
    {
        // Validate room input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'hotel_id' => 'required|exists:hotels,id',
            'qty' => 'required|integer|min:1', // Ensure qty is provided and is a valid integer
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048', // Validate image upload
        ]);

        if ($validator->fails()) {
            return redirect()->route('rooms.create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Handle image upload if provided
            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('rooms', 'public'); // Store image in the 'rooms' folder
            }

            // Create a new room with validated data
            Room::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'hotel_id' => $request->hotel_id,
                'qty' => $request->qty,
                'status' => $request->status ?? true, // If no status provided, default to true
                'image' => $imagePath, // Save the image path if uploaded
            ]);

            return redirect()->route('rooms.index')->with('success', 'Room created successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create room: ' . $e->getMessage());
            return redirect()->route('rooms.create')->with('error', 'Failed to create room. Please try again.');
        }
    }

    /**
     * Display the specified room.
     */
    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified room.
     */
    public function edit(Room $room)
    {
        $hotels = Hotel::all(); // Fetch all hotels for the dropdown
        return view('rooms.edit', compact('room', 'hotels'));
    }

    /**
     * Update the specified room in storage.
     */
    public function update(Request $request, Room $room)
    {
        // Validation rules for room input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'hotel_id' => 'required|exists:hotels,id',
            'qty' => 'required|integer|min:1', // Ensure qty is provided and is a valid integer
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048', // Validate image upload
        ]);

        try {
            // Handle image upload if provided
            $imagePath = $room->image; // Keep the existing image if none is uploaded
            if ($request->hasFile('image')) {
                // Delete the old image if exists
                if ($imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }

                // Store the new image
                $imagePath = $request->file('image')->store('rooms', 'public');
            }

            // Update room details
            $room->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'hotel_id' => $request->hotel_id,
                'qty' => $request->qty,
                'status' => $request->status ?? true, // If no status provided, default to true
                'image' => $imagePath, // Save the image path
            ]);

            return redirect()->route('rooms.index')->with('success', 'Room updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update room: ' . $e->getMessage());
            return redirect()->route('rooms.edit', $room->id)->with('error', 'Failed to update room. Please try again.');
        }
    }

    /**
     * Remove the specified room from storage.
     */
    public function destroy(Room $room)
    {
        try {
            // Delete the room's image if it exists
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }

            $room->delete();

            return redirect()->route('rooms.index')->with('success', 'Room deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to delete room: ' . $e->getMessage());
            return redirect()->route('rooms.index')->with('error', 'Failed to delete room. Please try again.');
        }
    }
}
