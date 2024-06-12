<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.index', [
            'photos' => Photo::where('user_id', auth()->id())->where('published', true)->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        return view('admin.show', [
            'photo' => $photo,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        return view('admin.edit', [
            'photo' => $photo,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        if(Auth::check()){
            //dd($photo);
            if(auth()->id() != $photo->user_id){
                abort(403 , 'You are not allowed to delete this photo');
            }
    
            if($photo->cover_image){
                Storage::delete($photo->cover_image);
            }
    
            $photo->delete();
    
            return redirect('/admin/photos')->with('message', 'Photo deleted successfully');
        }
    }
}
