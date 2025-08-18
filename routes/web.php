<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\FestivalDetailsController;

use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('home');
});

Route::get('/explore', function () {
    return view('explore');
});

//Contact
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

//Authentication

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);





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

Route::view('/contact', 'contact')->name('contact');





