<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FestivalApprovalController;
use App\Http\Controllers\FestivalDetailsController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});

Route::get('/explore', [ExploreController::class, 'index'])->name('explore');

//Contact
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


//Login na korle submit kora jabe na
Route::view('/submit','submit')->name('submit')->middleware('auth');

// Festival submission route

Route::post('/submit', [FestivalController::class, 'store'])->name('festival.store')->middleware('auth');
Route::get('/festival/{id}', [FestivalDetailsController::class, 'show'])->name('festival.details');


    
   



// Backend approval endpoints (can be protected later)
Route::post('/admin/festivals/{id}/approve', [FestivalApprovalController::class, 'approve'])->name('festivals.approve');
Route::post('/admin/festivals/{id}/reject', [FestivalApprovalController::class, 'reject'])->name('festivals.reject');

// Serve uploaded festival image at a stable path
Route::get('/images/festivals/{id}', [ImageController::class, 'festival'])->name('images.festival');


