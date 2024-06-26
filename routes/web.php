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
        Route::get('/drafts/all', function () {
            return view('admin.drafts' , [
                'photos' => Photo::where('user_id', auth()->id())->where('published', false)->paginate(),
            ]);
        })->name('drafts.index');

         /* Draft publish */
         Route::get('/drafts/publish/{id}', [AdminDrafts::class , 'publish'])->name('drafts.publish');

         /* Draft publish */
         Route::get('/drafts/unpublish/{id}', [AdminDrafts::class , 'unpublish'])->name('drafts.unpublish');

    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
