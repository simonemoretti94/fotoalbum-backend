<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photo;

class DashboardController extends Controller
{
    public function index()
    {
        //dd(Photo::all());
        $photos = Photo::where('user_id', auth()->id())
            ->where('published', true)
            ->whereNotNull('category_id')
            ->get()
            ->groupBy('category_id');

        return view('dashboard', [
            'photos' => $photos,
            'categories' => Category::all(),
        ]);
    }
}
