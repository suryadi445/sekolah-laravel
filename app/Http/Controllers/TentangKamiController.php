<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function index($slug = null)
    {
        $jumbotron = Banner::where('kategori', 'about')->first();

        if (empty($jumbotron)) {
            $jumbotron = [];
        }

        if ($slug) {
            return view('frontend.detailTentangKami', compact('jumbotron'));
        } else {
            return view('frontend.tentangKami', compact('jumbotron'));
        }
    }
}