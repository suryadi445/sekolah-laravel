<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;
use App\Models\Banner;

class AlumniKamiController extends Controller
{

    public function index(Request $request)
    {
        $angkatan = $request->angkatan;
        $angkatans = Alumni::groupBy('angkatan_awal')->get();
        $banner = Banner::where('kategori', 'Alumni')->get();

        if ($angkatan != null) {

            $alumnis = Alumni::where('angkatan_awal', $angkatan)
                ->orderByDesc('id')->paginate(18)
                ->appends(request()->query());
        } else {

            $alumnis = Alumni::orderByDesc('id')->paginate(18);
        }

        return view('frontend.alumniKami', compact(['angkatans', 'alumnis', 'angkatan', 'banner']));
    }
}