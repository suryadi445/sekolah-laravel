<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Registration;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        $pendaftaran = Registration::where('tgl_penutupan', '>=', date('Y-m-d'))->first();
        $data = $this->default();

        return view('frontend.pendaftaran', compact('pendaftaran', 'data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'no_hp' => 'required|numeric',
            'alamat' => 'required',
        ]);

        $insert = Pendaftaran::create([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ]);

        if ($insert) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    public function default()
    {
        $data['judul']      = 'Pendaftaran';
        $data['text']       = 'Kami membuka kesempatan bagi calon siswa untuk bergabung dengan komunitas sekolah kami. Dengan lingkungan belajar yang inklusif dan pendekatan pendidikan yang berfokus pada perkembangan holistik, kami menyambut siswa dari berbagai latar belakang untuk meraih potensi penuh mereka. Selamat datang di rumah bagi semangat belajar, kekreatifan, dan pertumbuhan bersama-sama. Bersama para guru dan staf yang berdedikasi, kami berkomitmen untuk memberikan pengalaman pendidikan yang bermakna dan memberdayakan siswa untuk menjadi pemimpin masa depan. Temukan lebih banyak tentang sekolah kami dan selamat bergabung dalam perjalanan pendidikan yang menarik ini!';

        return $data;
    }
}
