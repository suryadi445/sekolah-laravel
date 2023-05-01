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

    public function printPDF($kelas, $sub_kelas)
    {

        $spp = Spp::rightJoin('siswas', 'spps.id_siswa', '=', 'siswas.id');
        $spp->join('payments', 'payments.id', '=', 'spps.merchant');
        $spp->select('siswas.nama_siswa', 'siswas.kelas', 'siswas.sub_kelas', 'spps.nama_bulan', 'spps.tahun', 'spps.tipe_pembayaran', 'jenis_pembayaran', 'payments.nama as merchant', 'keterangan', 'nominal', 'spps.created_at');
        if (!empty($kelas)) {
            $spp->where('kelas', '=', $kelas);
        }
        if (!empty($sub_kelas)) {
            $spp->where('sub_kelas', '=', $sub_kelas);
        }
        $spp->orderBy('kelas', 'asc');
        $spp->orderBy('sub_kelas', 'asc');
        $spp->orderBy('nama_siswa', 'asc');
        $spp = $spp->get();
        $spps = $spp->toArray();

        return $spps;
    }
}