<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    /**
     * Display a listing of the hotels.
     */
    public function index()
    {
        try {
            // Fetch all hotels
            $hotels = Hotel::all(); // This will return a collection
    
            // Return the view with the hotels data
            return view('hotels.index', ['hotels' => $hotels]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch hotels: ' . $e->getMessage()], 500);
        }
    }
    

    public function create()
{
    // Return the view for creating a hotel (a form)
    return view('hotels.create');
}

    /**
     * Store a newly created hotel in storage.
     */
    public function store(Request $request)
    {
        // Validation rules for hotel input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            // Create a new hotel instance
            $hotel = new Hotel();
            $hotel->name = $request->name;
            $hotel->description = $request->description;
            $hotel->status = $request->status;

            // Handle image upload and store it in public storage
            if ($request->hasFile('image')) {
                // Store the image in the 'public/images' directory
                $imagePath = $request->image->store('images', 'public');
                $hotel->image = $imagePath;
            }

            // Save the hotel details
            $hotel->save();

            return redirect()->route('hotels.index')->with('success', 'Hotel created successfully!');
        } catch (\Exception $e) {
            // Improved error message with exception code
            return redirect()->route('hotels.index')->with('error', 'Failed to create hotel: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified hotel.
     */
    public function show(Hotel $hotel)
    {
        try {
            // Return the hotel details
            return response()->json($hotel, 200);
        } catch (\Exception $e) {
            // Improved error message with exception code
            return response()->json(['error' => 'Failed to fetch hotel details: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified hotel in storage.
     */
    public function edit($id)
{
    try {
        $hotel = Hotel::findOrFail($id); // Find hotel by ID

        // Return the view with hotel data for editing
        return view('hotels.edit', ['hotel' => $hotel]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to fetch hotel details: ' . $e->getMessage()], 500);
    }
}

    public function update(Request $request, Hotel $hotel)
    {
        // Validation rules for hotel input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            // Update hotel details
            $hotel->name = $request->name;
            $hotel->description = $request->description;
            $hotel->status = $request->status;

            // Handle image upload if new image is provided
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($hotel->image && Storage::disk('public')->exists($hotel->image)) {
                    Storage::disk('public')->delete($hotel->image);
                }

                // Store the new image
                $imagePath = $request->image->store('images', 'public');
                $hotel->image = $imagePath;
            }

            // Save the updated hotel details
            $hotel->save();

            return redirect()->route('hotels.index')->with('success', 'Hotel created successfully!');
        } catch (\Exception $e) {
            // Improved error message with exception code
            return redirect()->route('hotels.index')->with('error', 'Failed to create hotel: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified hotel from storage.
     */
    public function destroy(Hotel $hotel)
    {
        try {
            // Delete the hotel image if exists
            if ($hotel->image && Storage::disk('public')->exists($hotel->image)) {
                Storage::disk('public')->delete($hotel->image);
            }

            // Delete the hotel record from the database
            $hotel->delete();
            return redirect()->route('hotels.index')->with('success', 'Hotel created successfully!');
        } catch (\Exception $e) {
            // Improved error message with exception code
            return redirect()->route('hotels.index')->with('error', 'Failed to create hotel: ' . $e->getMessage());
        }
    }
}
