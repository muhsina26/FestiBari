<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Festival;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FestivalController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'festival_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'district' => 'required|string|max:255',
            'area' => 'nullable|string|max:255',
            'full_address' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'religion' => 'required|string|max:255',
            // Allow images up to 5MB; include common formats
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('festival_images', 'public');
        }

        // Handle subevents (if any)
        $subevents = [];
        if ($request->has('subevent_time') && $request->has('subevent_title')) {
            $times = $request->input('subevent_time', []);
            $titles = $request->input('subevent_title', []);
            $descriptions = $request->input('subevent_description', []);

            for ($i = 0; $i < count($times); $i++) {
                if (!empty($times[$i]) && !empty($titles[$i])) {
                    $subevents[] = [
                        'time' => $times[$i],
                        'title' => $titles[$i],
                        'description' => $descriptions[$i] ?? ''
                    ];
                }
            }
        }

        // Create the festival
        $festival = Festival::create([
            'name' => $validated['festival_name'],
            'description' => $validated['description'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null,
            'district' => $validated['district'],
            'area' => $validated['area'] ?? null,
            'full_address' => $validated['full_address'] ?? null,
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'religion' => $validated['religion'],
            'image_path' => $imagePath,
            'subevents' => $subevents,
            'user_id' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Festival submitted successfully! It will be reviewed before being published.');
    }
}
