<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FestivalDetailsController extends Controller
{
    public function show(int $id)
    {
        $festival = Festival::query()
            ->where('id', $id)
            ->where('status', 'approved')
            ->firstOrFail(['id','name','description','start_date','end_date','district','area','religion','image_path','subevents']);

        $name = $festival->name;
        $description = $festival->description;
        $date = $this->formatDateRange($festival->start_date, $festival->end_date);
        
        
        $districtDisplay = $festival->district === 'other' ? 'Nationwide' : ucfirst($festival->district);
        $location = trim(($festival->area ? $festival->area.', ' : '').$districtDisplay);
        
        $category = $festival->religion ?: 'Cultural';
        $duration = $this->computeDuration($festival->start_date, $festival->end_date);
       
        $rawSubevents = $festival->subevents;
        $events = is_array($rawSubevents)
            ? $rawSubevents
            : (is_string($rawSubevents) ? (json_decode($rawSubevents, true) ?: []) : []);

        
        if (!empty($festival->image_path)) {
            $image = Str::startsWith($festival->image_path, ['http://', 'https://', '/'])
                ? $festival->image_path
                : asset('storage/'.$festival->image_path);
        } else {
            $image = asset('images/'.$this->chooseHeroImage(null, $category));
        }

        return view('festival-details', compact(
            'name','description','date','location','category','duration','events','image'
        ));
    }

    private function formatDateRange($start, $end): string
    {
        if (!$start) return '';
        $startStr = Carbon::parse($start)->format('F j, Y');
        if ($end && Carbon::parse($end)->ne($start)) {
            $endStr = Carbon::parse($end)->format('F j, Y');
            return $startStr.' - '.$endStr;
        }
        return $startStr;
    }

    private function computeDuration($start, $end): string
    {
        if (!$start) return 'Full Day';
        if (!$end) return '1 Day';
        $s = Carbon::parse($start);
        $e = Carbon::parse($end);
        $days = $s->diffInDays($e) + 1;
        return $days.' '.($days > 1 ? 'Days' : 'Day');
    }

    private function chooseHeroImage(?string $imagePath, string $religion): string
    {
        $byReligion = [
            'Islam' => 'eid.jpg',
            'Hinduism' => 'DurgaPuja.jpg',
            'Buddhism' => 'Budda.jpg',
            'Christianity' => 'Christmas.jpg',
            'Cultural' => 'PohelaBoishakh.jpg',
        ];
        return $byReligion[$religion] ?? 'bg.jpg';
    }
}
