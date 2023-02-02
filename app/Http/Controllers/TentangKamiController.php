<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Career;
use App\Models\DefaultWeb;
use Illuminate\Http\Request;

class TentangKamiController extends Controller
{
    public function index($slug = null)
    {
        $jumbotron  = Banner::where('kategori', 'about')->first();
        $profile    = DefaultWeb::where('url', 'like', 'tentangKami/profile%')->first();
        $sejarah    = DefaultWeb::where('url', 'like', 'tentangKami/sejarah%')->first();
        $karir      = Career::orderBy('deadline')->paginate(9);
        $jenis_jabatan = Career::groupBy('jabatan')->get();

        // dd($jenis_jabatan);

        if (empty($jumbotron)) {
            $jumbotron = [];
        }

        if ($slug) {
            if ($slug == 'profile') {
                $detail = About::where('slug', 'profile')->first();
            } elseif ($slug == 'sejarah') {
                $detail = About::where('slug', 'sejarah')->first();
            }

            return view('frontend.detailTentangKami', compact(['jumbotron', 'profile', 'sejarah', 'detail', 'jenis_jabatan', 'karir']));
        } else {
            return view('frontend.tentangKami', compact(['jumbotron', 'profile', 'sejarah', 'jenis_jabatan', 'karir']));
        }
    }

    public function getPosisi($jabatan)
    {
        $data = Career::where('jabatan', $jabatan)->get();

        return response()->json($data);
    }
}