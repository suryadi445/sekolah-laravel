<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    public function index()
    {
        $gallery = Gallery::latest()->paginate(24);
        return view('frontend.gallery', compact(['gallery']));
    }

    public function get_image($id)
    {
        $data = Gallery::find($id);

        return response()->json($data);
    }
}