<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectGalleryController;
use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;

// Halaman publik
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/education', 'education')->name('education');

// Dashboard bawaan Laravel Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route khusus pengguna yang sudah login
Route::middleware('auth')->group(function () {

    // Dashboard pengelolaan project
    Route::get('/projects/dashboard', [DashboardController::class, 'index'])
        ->name('projects.dashboard');

    // Profile saya
    Route::get('/profile-saya', function () {
        return view('profile-saya', [
            'user' => auth()->user()
        ]);
    })->name('profile.saya');
    // Kelola Skill
    Route::get('/skills/{id}/edit', [SkillController::class, 'edit'])
        ->name('skills.edit');

    Route::put('/skills/{id}', [SkillController::class, 'update'])
        ->name('skills.update');

    // Gallery project
    Route::post('/projects/{project}/gallery', [ProjectGalleryController::class, 'store'])
        ->name('projects.gallery.store');
        
    Route::put('/projects/{project}/gallery/{image}', [ProjectGalleryController::class, 'update'])
    ->name('projects.gallery.update');

    Route::delete('/projects/{project}/gallery/{image}', [ProjectGalleryController::class, 'destroy'])
        ->name('projects.gallery.destroy');

    // Trash project
    Route::get('/projects/trash', [ProjectController::class, 'trash'])
        ->name('projects.trash');

    // Restore project
    Route::patch('/projects/{id}/restore', [ProjectController::class, 'restore'])
        ->name('projects.restore');

    // Hapus project secara permanen
    Route::delete('/projects/{id}/force-delete', [ProjectController::class, 'forceDelete'])
        ->name('projects.forceDelete');

    // CRUD project
    Route::resource('projects', ProjectController::class);
});

// Profile bawaan Laravel Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Dashboard admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard', [
            'totalProjects' => \App\Models\Project::count(),
            'adminName' => auth()->user()->name
        ]);
    })->name('admin.dashboard');
});

require __DIR__.'/auth.php';
