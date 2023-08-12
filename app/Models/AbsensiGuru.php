<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiGuru extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function insert($request)
    {
        $insert = AbsensiGuru::create([
            'keterangan' => $request->keterangan,
            'tgl_absensi' => $request->tgl_absensi,
            'id_guru' =>  userLogin()->id_guru,
        ]);

        return $insert;
    }
}
