<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $title = 'Absensi Siswa';
        $siswa = Siswa::orderBy('nama_siswa')->where('kelas', 0)->search()->get();

        return view('backend.absensi', compact(['title', 'siswa']));
    }
}
