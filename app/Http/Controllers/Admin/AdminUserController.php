<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
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
        $query = User::withCount('festivals')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load(['festivals' => function($query) {
            $query->orderBy('created_at', 'desc');
        }]);

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        if ($user->email === 'admin@festibari.com') {
            return redirect()->back()->with('error', 'Cannot delete admin user!');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully!');
    }
}
