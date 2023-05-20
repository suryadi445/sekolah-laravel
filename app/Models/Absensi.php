<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function printPDF($kelas = null)
    {
        $id_userGuru = auth()->user()->id;

        $absensi = Absensi::join('siswas', 'absensis.id_siswa', '=', 'siswas.id')
            ->join('mapels', 'absensis.id_mapel', '=', 'mapels.id')
            ->select('absensis.*', 'siswas.nama_siswa', 'mapels.mata_pelajaran')
            ->where('absensis.user', $id_userGuru)
            ->whereMonth('absensis.created_at', '=', date('m'))
            ->orderBy('absensis.tgl_absensi')
            ->orderBy('siswas.nama_siswa');


        if (!empty($kelas)) {
            $absensi->where('absensis.kelas', $kelas);
        }

        $absensi = $absensi->get();
        $absensis = $absensi->toArray();

        return $absensis;
    }
}
