<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;

class DashboardController extends Controller
{
    public function index()
    {
        //dd(Photo::all());

        return view('dashboard', [
            'photos' => Photo::all(),
        ]);
    }
}
