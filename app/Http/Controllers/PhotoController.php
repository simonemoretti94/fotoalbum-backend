<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        if(Auth::check()){
            return view('admin.create' , [
                'categories' => Category::all(),
            ]);
        }
        else {
            abort(403, 'You are not checked');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        if(Auth::check()){
           //dd($request->all());

           $validated = $request->validated();

            //dd($validated);

            if ($request->has('cover_image')) {
                if (! Str::startsWith($request['cover_image'], 'https://')) {
                    $img_path = Storage::put('uploads', $request->cover_image); //in case of img uploaded
                    $validated['cover_image'] = $img_path;

                }

                /* getting img size in Kb */
                $size = $request->file('cover_image')->getSize(); // getting file size in byte
                $sizeInKb = $size / 1024; // converting into Kb
                $validated['file_size'] = round($sizeInKb , 2); //assigning it
                /* getting img extension */
                $extension = $request->file('cover_image')->extension(); // getting file extension
                $validated['format'] = $extension; //assigning it
                //dd($validated);

            }
            $validated['slug'] = Str::slug($request->title, '-');
            $validated['user_id'] = Auth::id();
            $validated['published'] = true;

            //dd($validated);
            Photo::create($validated);
            return redirect('/admin/photos')->with('status', 'Photo creation succeeded');

        }
        else {
            abort(403, 'You are not checked');
        }
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
        if(Auth::check()){
            //dd($photo);
            if(auth()->id() != $photo->user_id){
                abort(403 , 'You are not allowed to delete this photo');
            }
            
            return view('admin.edit', [
                'photo' => $photo,
                'categories' => Category::all(),
            ]);
            
        }
        else{
        
            abort(403 , 'You are not checked');
            
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        if(Auth::check()){
            if(auth()->id() != $photo->user_id){
                abort(403 , 'You are not allowed to edit this photo');
            }

            //dd($request->all());
            $validated = $request->validated();
            $slug = Str::slug($request->title, '-');
            $validated['slug'] = $slug;

            //dd($validated);

            if ($request->has('cover_image')) {


                if ($photo->cover_image) {
                    Storage::delete($photo->cover_image);
                }
                if (! Str::startsWith($request['cover_image'], 'https://')) {
                    $img_path = Storage::put('uploads', $request->cover_image); //in case of img uploaded
                    $validated['cover_image'] = $img_path;

                }

                /* getting img size in Kb */
                $size = $request->file('cover_image')->getSize(); // getting file size in byte
                $sizeInKb = $size / 1024; // converting into Kb
                $validated['file_size'] = round($sizeInKb , 2); //assigning it

                /* getting img extension */
                $extension = $request->file('cover_image')->extension(); // getting file extension
                $validated['format'] = $extension; //assigning it

            }

            $photo->update($validated);
            return redirect('/admin/photos')->with('status', 'Photo edit succeeded');
        }
        else {
            abort(403 , 'You are not checked');
        }
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
        else{
        
            abort(403 , 'You are not checked');
            
        }
    }
    
}
/*
Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsa eum nulla amet tempora ad magnam eos odit dolore expedita vel perspiciatis similique accusantium impedit quam facere, exercitationem explicabo eligendi dignissimos rerum quisquam mollitia iure quibusdam? Aspernatur, quibusdam. Libero eum accusamus eius, modi perspiciatis, sint unde ipsum ab quam alias labore!
*/