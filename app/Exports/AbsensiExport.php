<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;



class AbsensiExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    private $header;
    private $kelas;
    private $tipe;
    protected $hidden = ['id', 'id_siswa', 'id_mapel', 'user', 'created_at', 'updated_at'];

    public function __construct(array $header, $kelas, $tipe)
    {
        $this->header = $header;
        $this->kelas = $kelas;
        $this->tipe = $tipe;
    }
    /**
     * @return \Illuminate\Support\Collection
     */


    public function collection()
    {
        $hidden = $this->hidden;
        $kelas = $this->kelas;
        $tipe = $this->tipe;
        $id_userGuru = auth()->user()->id;


        if ($tipe == 'absensi') {

            $absensi = Absensi::join('siswas', 'absensis.id_siswa', '=', 'siswas.id')
                ->join('mapels', 'absensis.id_mapel', '=', 'mapels.id')
                ->select('absensis.*', 'siswas.nama_siswa', 'mapels.mata_pelajaran')
                ->where('absensis.user', $id_userGuru)
                ->whereMonth('absensis.created_at', '=', date('m'))
                ->orderBy('absensis.tgl_absensi')
                ->orderBy('siswas.nama_siswa');


            if (!empty($kelas)) {
                $absensi->where('absensis.kelas', $kelas);
            }

            $absensi = $absensi->get();

            return $absensi->makeHidden($hidden);
        } else {
            // Daftar Absensi

            $absensi = DB::table('absensis AS t1')
                ->leftJoin(DB::raw("(select * from absensis where absensi = 'yes') as t2"), 't1.id', '=', 't2.id')
                ->leftJoin(DB::raw("(select * from absensis where absensi = 'no') as t3"), 't1.id', '=', 't3.id')
                ->leftJoin(DB::raw("(select * from absensis where keterangan = 'Sakit') as t4"), 't1.id', '=', 't4.id')
                ->leftJoin(DB::raw("(select * from absensis where keterangan = 'Alpha') as t5"), 't1.id', '=', 't5.id')
                ->leftJoin(DB::raw("(select * from absensis where keterangan = 'Izin') as t6"), 't1.id', '=', 't6.id')
                ->join('siswas', 't1.id_siswa', '=', 'siswas.id')
                ->select(DB::raw('siswas.nama_siswa, count(t2.id) as jumlahMasuk, count(t3.id) as jumlahGaMasuk, count(t4.id) as jumlahSakit, count(t6.id) as jumlahIzin, count(t5.id) as jumlahAlpha'))
                ->where('t1.user', $id_userGuru)
                ->whereMonth('t1.created_at', '=', date('m'))
                ->groupByRaw("t1.id_siswa")
                ->orderBy('siswas.nama_siswa');


            if (!empty($kelas)) {
                $absensi->where('t1.kelas', $kelas);
            }

            $absensi = $absensi->get();

            return $absensi;
        }
    }

    public function headings(): array
    {

        $header = $this->header;

        return $header;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}
