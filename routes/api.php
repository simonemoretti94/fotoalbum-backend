<?php

use App\Http\Controllers\Api\PhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('photos', [PhotoController::class, 'index']);
Route::get('photos/filtered', [PhotoController::class, 'indexFiltered']);
Route::get('photos/{id}', [PhotoController::class, 'show']);

//Route::post('contacts' , [LeadController::class , 'store']);

Route::get('categories', [PhotoController::class, 'allCategories']);
