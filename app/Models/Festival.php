<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Festival extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'district',
        'area',
        'full_address',
        'latitude',
        'longitude',
        'religion',
        'image_path',
        'subevents',
        'status',
        'user_id'
    ];

    protected $casts = [
        'subevents' => 'array',
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
