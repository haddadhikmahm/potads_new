<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

Route::get('/', function () {
    $events = \App\Models\Event::where('status', '!=', 'completed')->take(3)->get();
    $articles = \App\Models\Article::where('status', 'published')->latest()->take(3)->get();
    $latestVideo = \App\Models\Material::where('type', 'video')->latest()->first();
    return view('welcome', compact('events', 'articles', 'latestVideo'));
})->name('home');

Route::get('/about', function () {
    return view('about-us');
})->name('about');
Route::post('/about', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::get('/donations', [\App\Http\Controllers\DonationController::class, 'index'])->name('donations.index');
Route::post('/donations', [\App\Http\Controllers\DonationController::class, 'store'])->name('donations.store');

// Public Article Routes
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create')->middleware('auth');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store')->middleware('auth');
Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');

// Public Material Routes
Route::get('/materi', [\App\Http\Controllers\MaterialController::class, 'index'])->name('materials.index');
Route::get('/materi/{material}', [\App\Http\Controllers\MaterialController::class, 'show'])->name('materials.show');
Route::post('/materi/{material}/complete', [\App\Http\Controllers\MaterialController::class, 'complete'])->name('materials.complete')->middleware('auth');

// Public FAQ Routes
Route::get('/faq', [\App\Http\Controllers\FaqController::class, 'index'])->name('faqs.index');

// Public Medical/Academic Info Routes
Route::get('/akademis-medis', [\App\Http\Controllers\MedicalInfoController::class, 'index'])->name('medical_infos.index');
Route::get('/akademis-medis/{slug}', [\App\Http\Controllers\MedicalInfoController::class, 'show'])->name('medical_infos.show');

// Public Event Routes
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
    Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
    Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::resource('members', \App\Http\Controllers\Admin\MemberController::class);
    Route::resource('children', \App\Http\Controllers\Admin\ChildController::class);
    Route::resource('materials', \App\Http\Controllers\Admin\MaterialController::class);
    Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class);
    Route::resource('medical-infos', \App\Http\Controllers\Admin\MedicalInfoController::class);
    Route::resource('donations', \App\Http\Controllers\Admin\DonationController::class);
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Child Routes
    Route::resource('children', \App\Http\Controllers\ChildController::class)->except(['index', 'show']);
});

require __DIR__.'/auth.php';
