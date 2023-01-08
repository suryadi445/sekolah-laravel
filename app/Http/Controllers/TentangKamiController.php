<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function index($slug = null)
    {
        if ($slug) {
            return view('frontend.detailTentangKami');
        } else {
            return view('frontend.tentangKami');
        }
    }
}