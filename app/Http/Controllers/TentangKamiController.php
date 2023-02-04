<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Career;
use App\Models\DefaultWeb;
use App\Models\Rekruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class TentangKamiController extends Controller
{
    public function index($slug = null)
    {
        $jumbotron  = Banner::where('kategori', 'about')->first();
        $profile    = DefaultWeb::where('url', 'like', 'tentangKami/profile%')->first();
        $sejarah    = DefaultWeb::where('url', 'like', 'tentangKami/sejarah%')->first();
        $karir      = Career::orderBy('deadline')->paginate(9);
        $jenis_jabatan = Career::groupBy('jabatan')->get();


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

    public function getPosisi_row($id)
    {
        $data = Career::where('id', $id)->first();

        return response()->json($data);
    }

    public function getPosisi($jabatan)
    {
        $data = Career::where('jabatan', $jabatan)->get();

        return response()->json($data);
    }

    public function karir(Request $request)
    {
        $request->validate([
            "cv" => "required|mimetypes:application/pdf|max:2500",
            "nama" => "required",
            "no_hp" => "required",
            "email" => "required|email",
            "tgl_lahir" => "required",
        ]);

        $file = $request->file('cv');
        $fileName = time() . $file->getClientOriginalName() . '.' . $file->extension();

        $file->move(public_path('file/cv/'), $fileName);

        $insert = Rekruitment::create([
            "cv" =>  '\file/cv/' . $fileName,
            "jabatan" => $request->jabatan,
            "nama" => $request->nama,
            "no_hp" => $request->no_hp,
            "email" => $request->email,
            "tgl_lahir" => $request->tgl_lahir,
        ]);

        if ($insert) {
            Session::flash('success', 'Success! Data saved successfully');
        } else {
            Session::flash('failed', 'Alert! file not uploaded');
        }

        return redirect('tentangKami');
    }
}