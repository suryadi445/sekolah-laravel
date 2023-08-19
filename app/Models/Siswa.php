<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Siswa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $hidden = ['id', 'provinsi', 'user', 'created_at', 'updated_at', 'deleted_at'];


    public function scopeSearch($query)
    {
        return $query->where('nama_siswa', 'like', '%' . request('cari') . '%')
            ->orWhere('jenis_kelamin', 'like', '%' . request('cari') . '%')
            ->orWhere('tgl_lahir', 'like', '%' . request('cari') . '%')
            ->orWhere('thn_ajaran', 'like', '%' . request('cari') . '%')
            ->orWhere('kelas', 'like', '%' . request('cari') . '%');
    }

    public function printPDF()
    {
        $siswa = Siswa::all();
        $siswas = $siswa->toArray();

        return $siswas;
    }

    public function getSiswaAbsensi()
    {
        return Siswa::join('absensis', 'absensis.id_siswa', '=', 'siswas.id')
            ->join('mapels', 'mapels.id', '=', 'absensis.id_mapel')
            ->where('tgl_absensi', date('Y-m-d'))
            ->where('absensis.absensi', 'no')
            ->select('siswas.email', 'siswas.nama_siswa', 'mapels.mata_pelajaran', 'absensis.tgl_absensi', 'absensis.keterangan', 'absensis.absensi', 'absensis.kelas', 'absensis.created_at')
            ->orderBy('absensis.kelas')
            ->orderBy('absensis.tgl_absensi')
            ->orderBy('siswas.nama_siswa')
            ->orderBy('mapels.mata_pelajaran')
            ->get();
    }

    public function getSiswaMonthly()
    {
        return Siswa::join('absensis', 'absensis.id_siswa', '=', 'siswas.id')
            ->join('mapels', 'mapels.id', '=', 'absensis.id_mapel')
            ->whereMonth('tgl_absensi', date('m'))
            ->select('siswas.email', 'siswas.nama_siswa', 'mapels.mata_pelajaran', 'absensis.tgl_absensi', 'absensis.keterangan', 'absensis.absensi', 'absensis.kelas', 'absensis.created_at')
            ->orderBy('absensis.kelas')
            ->orderBy('absensis.tgl_absensi')
            ->orderBy('siswas.nama_siswa')
            ->orderBy('mapels.mata_pelajaran')
            ->get();
    }
}
