<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;


class AlumniKamiController extends Controller
{

    public function index()
    {
        $alumnis = Alumni::orderByDesc('id')->paginate(20);
        $angkatans = Alumni::groupBy('angkatan_awal')->get();

        return view('frontend.alumniKami', compact(['angkatans', 'alumnis']));
    }
}