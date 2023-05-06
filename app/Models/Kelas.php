<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function printPDF()
    {
        $kelas = Kelas::leftJoin('gurus', 'kelas.id_guru', '=', 'gurus.id')
            ->select('kelas.*', 'gurus.nama_guru')
            ->get();
        $kelass = $kelas->toArray();

        return $kelass;
    }
}
