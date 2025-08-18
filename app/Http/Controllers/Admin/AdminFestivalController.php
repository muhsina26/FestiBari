<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminFestivalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->email !== 'adminn@festibari.com') {
                abort(403, 'Access denied. Admin only.');
            }
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $query = Festival::with('user')->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('district', 'LIKE', "%{$search}%")
                  ->orWhere('religion', 'LIKE', "%{$search}%");
            });
        }

        $festivals = $query->paginate(10);

        return view('admin.festivals.index', compact('festivals'));
    }

    public function show(Festival $festival)
    {
        $festival->load('user');
        return view('admin.festivals.show', compact('festival'));
    }

    public function updateStatus(Request $request, Festival $festival)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $festival->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Festival status updated successfully!');
    }

    public function destroy(Festival $festival)
    {
        
        if ($festival->image_path) {
            $imagePath = public_path('storage/' . $festival->image_path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $festival->delete();

        return redirect()->route('admin.festivals.index')
            ->with('success', 'Festival deleted successfully!');
    }
}
