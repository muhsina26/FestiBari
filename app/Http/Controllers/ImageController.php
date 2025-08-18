<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function festival(int $id)
    {
        $festival = Festival::findOrFail($id);

        if (!$festival->image_path) {
            
            return redirect(asset('images/bg.jpg'));
        }

        $disk = Storage::disk('public');
        if (!$disk->exists($festival->image_path)) {
            return redirect(asset('images/bg.jpg'));
        }

        $path = $disk->path($festival->image_path);
        $mime = $disk->mimeType($festival->image_path) ?? 'image/jpeg';

        return response()->file($path, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=86400'
        ]);
    }
}
