<?php

namespace App\Http\Controllers;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DraftController extends Controller
{
    public function publish ($id){
        if(Auth::check()){
            $item = Photo::find($id);
            //dd($item);
            $item->published = true;
            //dd($item);
            $item->save();

            return view('admin.drafts' , [
                'photos' => Photo::where('user_id', auth()->id())->where('published', false)->paginate(),
            ]);
        }
        else {
            abort(403, 'You are not checked');
        }
    }
    public function unpublish ($id){
        if(Auth::check()){
            $item = Photo::find($id);
            //dd($item);
            $item->published = 0;
            //dd($item);
            $item->save();

            return view('admin.index', [
                'photos' => Photo::where('user_id', auth()->id())->where('published', true)->paginate(),
            ]);
        }
        else {
            abort(403, 'You are not checked');
        }
    }
}
