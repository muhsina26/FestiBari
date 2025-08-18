<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExploreController extends Controller
{
    public function index(Request $request)
    {
        // Start with approved festivals query
        $query = Festival::query()
            ->where('status', 'approved')
            ->select(['id', 'name', 'description', 'start_date', 'district', 'area', 'religion', 'image_path']);

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where('name', 'LIKE', '%' . $search . '%');
        }

        // Apply religion filter
        if ($request->filled('religion')) {
            $query->where('religion', $request->get('religion'));
        }

        // Apply location filter
        if ($request->filled('location')) {
            $location = $request->get('location');
            // Handle "Nationwide" filter by converting back to "other"
            $searchLocation = $location === 'Nationwide' ? 'other' : $location;
            $query->where(function($q) use ($searchLocation) {
                $q->where('district', 'LIKE', '%' . $searchLocation . '%')
                  ->orWhere('area', 'LIKE', '%' . $searchLocation . '%');
            });
        }

        // Apply time filter
        if ($request->filled('time')) {
            $timeFilter = $request->get('time');
            $today = Carbon::today();
            
            if ($timeFilter === 'Upcoming') {
                $query->where('start_date', '>=', $today);
            } elseif ($timeFilter === 'Past') {
                $query->where('start_date', '<', $today);
            }
        }

        // Get filtered results
        $festivals = $query->orderByDesc('start_date')->get();

        // Get unique religions and locations for filter dropdowns
        $religions = Festival::where('status', 'approved')
            ->distinct()
            ->pluck('religion')
            ->filter()
            ->sort()
            ->values();

        $locations = Festival::where('status', 'approved')
            ->distinct()
            ->pluck('district')
            ->filter()
            ->map(function($district) {
                return $district === 'other' ? 'Nationwide' : ucfirst($district);
            })
            ->sort()
            ->values();

        return view('explore', compact('festivals', 'religions', 'locations'));
    }
}
