<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeSearch($query)
    {
        return $query->where('nama_siswa', 'like', '%' . request('cari') . '%')
            ->orWhere('jenis_kelamin', 'like', '%' . request('cari') . '%')
            ->orWhere('tgl_lahir', 'like', '%' . request('cari') . '%')
            ->orWhere('thn_ajaran', 'like', '%' . request('cari') . '%')
            ->orWhere('kelas', 'like', '%' . request('cari') . '%');
    }

    public function printPDF($kelas, $id_mapel, $tgl)
    {

        $evaluation = Evaluation::join('siswas', 'evaluations.id_siswa', '=', 'siswas.id')
            ->join('mapels', 'evaluations.id_mapel', '=', 'mapels.id')
            ->select('siswas.nama_siswa', 'mapels.mata_pelajaran', 'evaluations.kelas', 'evaluations.nilai_siswa', 'evaluations.status', 'evaluations.tanggal_penilaian')
            ->orderBy('tanggal_penilaian')
            ->orderBy('nama_siswa');


        if ($kelas) {
            $evaluation->where('evaluations.kelas', $kelas);
        }

        if ($id_mapel) {
            $evaluation->where('evaluations.id_mapel', $id_mapel);
        }

        if ($tgl) {
            $evaluation->where('evaluations.tanggal_penilaian', $tgl);
        }


        $evaluation = $evaluation->get();
        $evaluation = $evaluation->toArray();

        return $evaluation;
    }
}
