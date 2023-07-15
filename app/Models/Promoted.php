<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promoted extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function printPDF($kelas, $subKelas, $param)
    {
        // $siswa = Siswa::all();
        // $siswas = $siswa->toArray();

        // return $siswas;

        $ajaran_awal = getTahunAjaran()->thn_ajaran_awal;
        $ajaran_akhir = getTahunAjaran()->thn_ajaran_akhir;

        if ($param == 'detail') {
            $Promoted = Siswa::join('promoteds', 'siswas.id', '=', 'promoteds.id_siswa')
                ->select('siswas.nama_siswa', 'siswas.jenis_kelamin', 'siswas.tempat_lahir', 'siswas.tgl_lahir', 'siswas.agama', 'siswas.nis', 'siswas.nisn', 'promoteds.status')
                ->where('kelas', $kelas)
                ->where('sub_kelas', $subKelas)
                ->orderBy('siswas.nama_siswa')
                ->orderBy('promoteds.status')
                ->get();
        } else {
            $Promoted = Siswa::rightJoin('promoteds', 'siswas.id', '=', 'promoteds.id_siswa')
                ->select('siswas.nama_siswa', 'siswas.jenis_kelamin', 'siswas.tempat_lahir', 'siswas.tgl_lahir', 'siswas.agama', 'siswas.nis', 'siswas.nisn', 'promoteds.status')
                ->where('promoteds.kelas_awal', $kelas)
                ->where('promoteds.sub_kelas_awal', $subKelas)
                ->where('promoteds.thn_ajaran_awal', $ajaran_awal)
                ->where('promoteds.thn_ajaran_akhir', $ajaran_akhir)
                ->orderBy('siswas.nama_siswa')
                ->orderBy('promoteds.status')
                ->get();
        }

        return $Promoted;
    }
}
