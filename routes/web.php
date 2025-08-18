<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FestivalApprovalController;
use App\Http\Controllers\FestivalDetailsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

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

// Admin Dashboard Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Festival Management
    Route::get('/festivals', [App\Http\Controllers\Admin\AdminFestivalController::class, 'index'])->name('festivals.index');
    Route::get('/festivals/{festival}', [App\Http\Controllers\Admin\AdminFestivalController::class, 'show'])->name('festivals.show');
    Route::patch('/festivals/{festival}/status', [App\Http\Controllers\Admin\AdminFestivalController::class, 'updateStatus'])->name('festivals.updateStatus');
    Route::delete('/festivals/{festival}', [App\Http\Controllers\Admin\AdminFestivalController::class, 'destroy'])->name('festivals.destroy');
    
    // User Management
    Route::get('/users', [App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [App\Http\Controllers\Admin\AdminUserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\AdminUserController::class, 'destroy'])->name('users.destroy');
});

// Serve uploaded festival image at a stable path
Route::get('/images/festivals/{id}', [ImageController::class, 'festival'])->name('images.festival');


