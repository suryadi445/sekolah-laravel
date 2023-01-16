<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\DefaultWeb;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function index($slug = null)
    {
        $jumbotron  = Banner::where('kategori', 'about')->first();
        $profile    = DefaultWeb::where('url', 'like', 'tentangKami/profile%')->first();
        $sejarah    = DefaultWeb::where('url', 'like', 'tentangKami/sejarah%')->first();

        if (empty($jumbotron)) {
            $jumbotron = [];
        }

        if ($slug) {
            if ($slug == 'profile') {
                $detail = About::where('slug', 'profile')->first();
            } elseif ($slug == 'sejarah') {
                $detail = About::where('slug', 'sejarah')->first();
            }

            return view('frontend.detailTentangKami', compact(['jumbotron', 'profile', 'sejarah', 'detail']));
        } else {
            return view('frontend.tentangKami', compact(['jumbotron', 'profile', 'sejarah']));
        }
    }
}