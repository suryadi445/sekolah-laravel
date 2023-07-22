<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    public function index()
    {
        $gallery = Gallery::latest()->paginate(24);
        $data = $this->default();

        return view('frontend.gallery', compact(['gallery', 'data']));
    }

    public function get_image($id)
    {
        $data = Gallery::find($id);

        return response()->json($data);
    }

    public function default()
    {
        $data['judul']      = 'Gallery';
        $data['text']       = 'Selamat datang di galeri siswa kami! Di sini, kami dengan bangga memamerkan prestasi, kreativitas, dan keberagaman para siswa kami. Melalui berbagai foto dan karya seni, Anda dapat melihat momen-momen tak terlupakan, pencapaian akademis, dan kegiatan ekstrakurikuler yang menginspirasi dari para siswa kami. Galeri ini merupakan cerminan dari semangat belajar dan semangat berprestasi di sekolah kami. Selamat menikmati melihat potret inspiratif dari para siswa kami yang luar biasa!';

        return $data;
    }
}
