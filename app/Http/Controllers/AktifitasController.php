<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;


class AktifitasController extends Controller
{
    public function index()
    {
        $aktifitas = Activity::orderByDesc('id')->paginate(20);

        return view('frontend.aktifitas', compact('aktifitas'));
    }
}