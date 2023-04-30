<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spp extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function printPDF()
    {
        $spp = Spp::rightJoin('siswas', 'spps.id_siswa', '=', 'siswas.id')
            ->join('payments', 'payments.id', '=', 'spps.merchant')
            ->select('siswas.nama_siswa', 'siswas.kelas', 'siswas.sub_kelas', 'spps.nama_bulan', 'spps.tahun', 'spps.tipe_pembayaran', 'jenis_pembayaran', 'payments.nama as merchant', 'keterangan', 'nominal', 'spps.created_at')
            ->get();;
        $spps = $spp->toArray();

        return $spps;
    }
}
