<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiGuru extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function get_guru($id_guru, $bulan)
    {

        $result = AbsensiGuru::join('gurus', 'absensi_gurus.id_guru', '=', 'gurus.id');
        if ($id_guru) {
            $result->where('gurus.id', $id_guru);
        }
        if ($bulan) {
            $result->whereMonth('absensi_gurus.created_at', $bulan);
        } else {
            $result->whereMonth('absensi_gurus.created_at', date('m'));
        }
        $result = $result->whereYear('absensi_gurus.created_at', date('Y'))
            ->orderByDesc('absensi_gurus.id')
            ->select('gurus.nama_guru', 'gurus.nik', 'absensi_gurus.tgl_absensi', 'absensi_gurus.created_at')
            ->paginate(10);

        return $result;
    }

    public function printPDF($id_guru, $bulan)
    {

        $result = AbsensiGuru::join('gurus', 'absensi_gurus.id_guru', '=', 'gurus.id');
        if ($id_guru) {
            $result->where('gurus.id', $id_guru);
        }
        if ($bulan != null) {
            $result->whereMonth('absensi_gurus.created_at', $bulan);
        } else {
            $result->whereMonth('absensi_gurus.created_at', date('m'));
        }
        $result = $result->whereYear('absensi_gurus.created_at', date('Y'))
            ->orderByDesc('absensi_gurus.id')
            ->select('gurus.nama_guru', 'gurus.nik', 'absensi_gurus.tgl_absensi', 'absensi_gurus.created_at')
            ->get();

        // $data = [];
        // foreach ($result as $key => $value) {
        //     $data[] = [
        //         'nama_guru' => $value->nama_guru,
        //         'nik' => $value->nik,
        //         'jam' => jam($value->created_at),
        //         'hari' => hari($value->created_at),
        //         'tgl_absensi' => $value->tgl_absensi,
        //     ];
        // }

        $formattedUsers = collect($result)->map(function ($res) {
            $data = [
                'nama_guru' => $res->nama_guru,
                'nik' => $res->nik,
                'hari' => hari($res->created_at),
                'tgl_absensi' => $res->tgl_absensi,
                'jam' => jam($res->created_at),
            ];
            return $data;
        })->toArray();

        return $formattedUsers;
    }

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
