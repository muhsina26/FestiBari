<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Festival;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
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

    public function index()
    {
        $stats = [
            'total_festivals' => Festival::count(),
            'approved_festivals' => Festival::where('status', 'approved')->count(),
            'pending_festivals' => Festival::where('status', 'pending')->count(),
            'rejected_festivals' => Festival::where('status', 'rejected')->count(),
            'total_users' => User::count(),
        ];

        $recent_festivals = Festival::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recent_users = User::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_festivals', 'recent_users'));
    }
}
