<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\CategoryController as AdminCategories;
use App\Http\Controllers\PhotoController as AdminPhotos;
use App\Http\Controllers\DraftController as AdminDrafts;
use App\Models\Photo;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

        /* PhotoController */
        Route::resource('photos', AdminPhotos::class);

        /* CategoryController */
        Route::resource('categories', AdminCategories::class);

        /* Drafts route */
        Route::get('/drafts', function () {
            return view('admin.drafts' , [
                'photos' => Photo::where('user_id', auth()->id())->where('published', false)->paginate(),
            ]);
        });

         /* Draft publish switching */
         Route::get('drafts/{id}', [AdminDrafts::class , 'publish']);

    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
