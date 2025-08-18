<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        
        $currentDate = Carbon::now();
        
        $festivals = Festival::where('status', 'approved')
            ->orderBy('start_date', 'asc')
            ->get(['id', 'name', 'description', 'start_date', 'district', 'area', 'image_path'])
            ->map(function($festival) use ($currentDate) {
               
                $festivalDate = Carbon::parse($festival->start_date);
                $festival->days_difference = $currentDate->diffInDays($festivalDate, false);
                
                
                $districtDisplay = $festival->district === 'other' ? 'Nationwide' : ucfirst($festival->district);
                $festival->location = trim(($festival->area ? $festival->area.', ' : '').$districtDisplay);
                
               
                if (!empty($festival->image_path)) {
                    $festival->image_url = Str::startsWith($festival->image_path, ['http://', 'https://', '/'])
                        ? $festival->image_path
                        : asset('storage/'.$festival->image_path);
                } else {
                    $festival->image_url = asset('images/bg.jpg');
                }
                
                return $festival;
            })
            
            ->sort(function($a, $b) {
                if ($a->days_difference >= 0 && $b->days_difference >= 0) {
                    
                    return $a->days_difference <=> $b->days_difference;
                } elseif ($a->days_difference < 0 && $b->days_difference < 0) {
                   
                    return $b->days_difference <=> $a->days_difference;
                } else {
                    
                    return $b->days_difference <=> $a->days_difference;
                }
            })
            ->take(3)
            ->values();

        
        $nextFestival = $festivals->first();
        $countdownDate = null;
        
        if ($nextFestival && $nextFestival->days_difference >= 0) {
            $countdownDate = Carbon::parse($nextFestival->start_date)->format('Y-m-d\TH:i:s');
        }

        return view('home', compact('festivals', 'countdownDate', 'nextFestival'));
    }
}
