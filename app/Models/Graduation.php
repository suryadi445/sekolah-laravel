<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function printPDF()
    {
        $results = Siswa::join('graduations', 'siswas.id', '=', 'graduations.id_siswa')
            ->select('siswas.nama_siswa', 'siswas.jenis_kelamin', 'siswas.tgl_lahir', 'siswas.thn_ajaran_berjalan_awal', 'siswas.thn_ajaran_berjalan_akhir')
            ->onlyTrashed()
            ->get();

        $siswa = collect($results)->map(
            function ($res) {
                $res->angkatan = $res->thn_ajaran_berjalan_awal . '-' .  $res->thn_ajaran_berjalan_akhir;

                unset($res->thn_ajaran_berjalan_awal);
                unset($res->thn_ajaran_berjalan_akhir);
                return $res;
            }
        );

        $siswas = $siswa->toArray();

        return $siswas;
    }
}
