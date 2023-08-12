<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;


    public function cek_absensi($id_guru)
    {
        $result = AbsensiGuru::where('id_guru', $id_guru)
            ->where('tgl_absensi', date('Y-m-d'))
            ->first();

        return $result;
    }
}
