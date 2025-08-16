<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FestivalController;
use App\Http\Controllers\FestivalDetailsController;


Route::get('/', function () {
    return view('home');
});

Route::get('/explore', function () {
    return view('explore');
});



Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


/// Festival submission route
Route::post('/submit', [FestivalController::class, 'store'])->name('festival.store')->middleware('auth');

Route::get('/festival/{id}', [FestivalDetailsController::class, 'show'])->name('festival.details');
Route::view('/contact', 'contact')->name('contact');


// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);


Route::view('/submit','submit')->name('submit')->middleware('auth');
//Dummy add kore dekhi kaj kore ki na
Route::get('/festival/{id}', function($id) {
    $festivals = [
        1 => [
            'name' => 'Pohela Boishakh', 
            'date' => 'April 14, 2025', 
            'location' => 'Dhaka', 
            'description' => 'Bengali New Year celebration with traditional music, dance, and local cuisine.',
            'image' => 'PohelaBoishakh.jpg',
            'category' => 'Cultural',
            'duration' => '1 Day',
            'events' => [
                ['time' => '6:00 AM', 'title' => 'Mangal Shobhajatra', 'description' => 'Traditional procession starts from Faculty of Fine Arts'],
                ['time' => '9:00 AM', 'title' => 'Cultural Programs', 'description' => 'Traditional songs and dance performances'],
                ['time' => '12:00 PM', 'title' => 'Traditional Food Fair', 'description' => 'Panta Ilish and traditional Bengali cuisine'],
                ['time' => '3:00 PM', 'title' => 'Handicraft Exhibition', 'description' => 'Display of traditional Bengali crafts'],
                ['time' => '6:00 PM', 'title' => 'Evening Cultural Show', 'description' => 'Musical performances and folk dances']
            ]
        ],
        2 => [
            'name' => 'Durga Puja', 
            'date' => 'October 10-14, 2025', 
            'location' => 'Dhaka', 
            'description' => 'Hindu festival celebrating Goddess Durga with elaborate decorations and community prayers.',
            'image' => 'DurgaPuja.jpg',
            'category' => 'Religious',
            'duration' => '5 Days',
            'events' => [
                ['time' => 'Day 1', 'title' => 'Mahalaya', 'description' => 'Invocation of Goddess Durga'],
                ['time' => 'Day 2', 'title' => 'Shashti', 'description' => 'Beginning of main festivities'],
                ['time' => 'Day 3', 'title' => 'Saptami', 'description' => 'Community prayers and cultural programs'],
                ['time' => 'Day 4', 'title' => 'Ashtami', 'description' => 'Main puja day with special offerings'],
                ['time' => 'Day 5', 'title' => 'Dashami', 'description' => 'Immersion ceremony and farewell']
            ]
        ],
        3 => [
            'name' => 'Eid ul-Fitr', 
            'date' => 'March 30, 2025', 
            'location' => 'Chittagong', 
            'description' => 'Islamic festival marking the end of Ramadan with prayers, feasts, and gift-giving.',
            'image' => 'eid.jpg',
            'category' => 'Religious',
            'duration' => '3 Days',
            'events' => [
                ['time' => '6:00 AM', 'title' => 'Eid Prayer', 'description' => 'Special Eid prayers at mosques and eidgahs'],
                ['time' => '9:00 AM', 'title' => 'Family Visits', 'description' => 'Visiting relatives and exchanging greetings'],
                ['time' => '12:00 PM', 'title' => 'Community Feast', 'description' => 'Traditional Eid feast with special dishes'],
                ['time' => '3:00 PM', 'title' => 'Gift Exchange', 'description' => 'Exchanging gifts and Eidi (money gifts)'],
                ['time' => '6:00 PM', 'title' => 'Evening Celebrations', 'description' => 'Community gatherings and cultural programs']
            ]
        ],
        4 => [
            'name' => 'Victory Day', 
            'date' => 'December 16, 2025', 
            'location' => 'Sylhet', 
            'description' => 'Commemorating Bangladesh Independence with parades, cultural programs, and patriotic displays.',
            'image' => 'victory day.jpg',
            'category' => 'National',
            'duration' => '1 Day',
            'events' => [
                ['time' => '8:00 AM', 'title' => 'Flag Hoisting', 'description' => 'National flag ceremony at government buildings'],
                ['time' => '10:00 AM', 'title' => 'Victory Parade', 'description' => 'Military and civilian parade'],
                ['time' => '2:00 PM', 'title' => 'Cultural Programs', 'description' => 'Patriotic songs and dance performances'],
                ['time' => '4:00 PM', 'title' => 'Speech & Discussions', 'description' => 'Talks on liberation war history'],
                ['time' => '7:00 PM', 'title' => 'Victory Rally', 'description' => 'Community rally with torch procession']
            ]
        ]
    ];

    $festival = $festivals[$id] ?? null;
    
    if (!$festival) {
        abort(404);
    }

    return view('festival-details', $festival);
});