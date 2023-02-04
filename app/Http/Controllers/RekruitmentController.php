<?php

namespace App\Http\Controllers;

use App\Models\Rekruitment;
use Illuminate\Http\Request;

class RekruitmentController extends Controller
{
    public function index()
    {
        $title = 'Rekruitment';
        $rekruitment = Rekruitment::orderBy('created_at')->paginate(20);

        return view('backend.rekruitment', compact(['title', 'rekruitment']));
    }

    public function prosesCV(Request $request)
    {
        $value = $request->value;

        $update = Rekruitment::where('id', $request->id)
            ->update(['proses' => $value]);

        return response()->json($value);
    }
}