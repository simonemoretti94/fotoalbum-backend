<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {
        $all = Photo::with('category')->where('published', true)->whereNotNull('category_id')->orderBy('title', 'asc')->paginate();
        if ($all) {
            return response()->json([
                'success' => true,
                'results' => $all,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'response' => '404 index API, results not found',
            ], 404);
        }
    }

    public function indexFiltered(Request $request)
    {

        if ($request->has('search')) {
            $filtered = Photo::with('category')->where('published', true)->whereNotNull('category_id')->orderBy('title', 'asc')->where('title', 'LIKE', '%'.$request->search)->paginate();
            if ($filtered) {

                return response()->json([
                    'success' => true,
                    'results' => $filtered,
                ]);

            } else {
                return response()->json([
                    'success' => false,
                    'results' => '404 indexFiltered API, results not found',
                ], 404);
            }
        } else {
            $all = Photo::with('category')->where('published', true)->whereNotNull('category_id')->orderBy('title', 'asc')->paginate();

            if ($all) {
                return response()->json([
                    'success' => true,
                    'response' => $all,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'response' => '404 indexFiltered API, results not found',
                ], 404);
            }
        }
    }
}