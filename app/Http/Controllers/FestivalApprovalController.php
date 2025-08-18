<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use Illuminate\Http\RedirectResponse;

class FestivalApprovalController extends Controller
{
    public function approve(int $id): RedirectResponse
    {
        $festival = Festival::findOrFail($id);
        $festival->update(['status' => 'approved']);

        return back()->with('success', 'Festival approved successfully.');
    }

    public function reject(int $id): RedirectResponse
    {
        $festival = Festival::findOrFail($id);
        $festival->update(['status' => 'rejected']);

        return back()->with('success', 'Festival rejected successfully.');
    }
}

