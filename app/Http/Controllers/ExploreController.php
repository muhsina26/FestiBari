<?php

namespace App\Http\Controllers;

use App\Models\Festival;

class ExploreController extends Controller
{
    public function index()
    {
        
        $festivals = Festival::query()
            ->where('status', 'approved')
            ->orderByDesc('start_date')
            ->get(['id', 'name', 'start_date', 'district', 'area', 'religion', 'image_path']);

        return view('explore', compact('festivals'));
    }
}
