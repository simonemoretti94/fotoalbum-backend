<?php

namespace App\Http\Controllers;
use App\Models\Photo;

use Illuminate\Http\Request;

class DraftController extends Controller
{
    public function publish ($id){
        $item = Photo::find($id);
        $item->published = true;
        $item->save();
    
        return view('admin.drafts' , [
            'photos' => Photo::where('user_id', auth()->id())->where('published', false)->paginate(),
        ]);
        //return back();
    }
}
