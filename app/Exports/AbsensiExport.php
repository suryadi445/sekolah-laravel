<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Fill;






class AbsensiExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    private $header;
    private $kelas;
    private $tipe;
    private $daftar_tanggal;
    private $daftar_mapel;
    private $ajaran_awal;
    private $ajaran_akhir;
    protected $hidden = ['id', 'id_siswa', 'id_mapel', 'user', 'created_at', 'updated_at'];

    public function __construct(array $header, $kelas, $tipe, $daftar_tanggal, $daftar_mapel, $ajaran_awal, $ajaran_akhir)
    {
        $this->header = $header;
        $this->kelas = $kelas;
        $this->tipe = $tipe;
        $this->daftar_tanggal = $daftar_tanggal;
        $this->daftar_mapel = $daftar_mapel;
        $this->ajaran_awal = $ajaran_awal;
        $this->ajaran_akhir = $ajaran_akhir;
    }
    /**
     * @return \Illuminate\Support\Collection
     */


    public function collection()
    {
        $hidden = $this->hidden;
        $kelas = $this->kelas;
        $tipe = $this->tipe;
        $daftar_tanggal = $this->daftar_tanggal;
        $daftar_mapel = $this->daftar_mapel;
        $ajaran_awal = $this->ajaran_awal;
        $ajaran_akhir = $this->ajaran_akhir;
        $id_userGuru = auth()->user()->id;

        if ($tipe == 'absensi') {

            $absensi = Absensi::join('siswas', 'absensis.id_siswa', '=', 'siswas.id')
                ->join('mapels', 'absensis.id_mapel', '=', 'mapels.id')
                ->select('absensis.kelas', 'siswas.nama_siswa', 'absensis.absensi', 'absensis.keterangan', 'absensis.tgl_absensi', 'mapels.mata_pelajaran', 'absensis.tahun_ajaran_awal', 'absensis.tahun_ajaran_akhir')
                ->where('absensis.user', $id_userGuru)
                ->where('absensis.tahun_ajaran_awal', $ajaran_awal)
                ->where('absensis.tahun_ajaran_akhir', $ajaran_akhir)
                ->orderBy('absensis.tgl_absensi')
                ->orderBy('siswas.nama_siswa');

            if (!empty($kelas)) {
                $absensi->where('absensis.kelas', $kelas);
            }

            if (!empty($daftar_mapel)) {
                $absensi->where('absensis.id_mapel', $daftar_mapel);
            }

            if (!empty($daftar_tanggal)) {
                $absensi->where('absensis.tgl_absensi', $daftar_tanggal);
            }

            $absensi = $absensi->get();

            return $absensi->makeHidden($hidden);
        } else {
            // Daftar Absensi

            $absensi = DB::table('absensis AS t1')
                ->leftJoin(DB::raw("(select id from absensis where absensi = 'yes') as t2"), 't1.id', '=', 't2.id')
                ->leftJoin(DB::raw("(select id from absensis where absensi = 'no') as t3"), 't1.id', '=', 't3.id')
                ->leftJoin(DB::raw("(select id from absensis where keterangan = 'Sakit') as t4"), 't1.id', '=', 't4.id')
                ->leftJoin(DB::raw("(select id from absensis where keterangan = 'Alpha') as t5"), 't1.id', '=', 't5.id')
                ->leftJoin(DB::raw("(select id from absensis where keterangan = 'Izin') as t6"), 't1.id', '=', 't6.id')
                ->leftJoin(DB::raw("(select id from absensis where keterangan IS NULL AND absensi = 'no') as t7"), 't1.id', '=', 't7.id')
                ->join('siswas', 't1.id_siswa', '=', 'siswas.id')
                ->select(DB::raw('siswas.nama_siswa, t1.kelas, count(t2.id) as jumlahMasuk, count(t3.id) as jumlahGaMasuk, count(t4.id) as jumlahSakit, count(t6.id) as jumlahIzin, count(t5.id) as jumlahAlpha, count(t7.id) as tanpaKeterangan'))
                ->where('t1.user', $id_userGuru)
                ->where('t1.tahun_ajaran_awal', $ajaran_awal)
                ->where('t1.tahun_ajaran_akhir', $ajaran_akhir)
                ->groupByRaw("t1.id_siswa")
                ->orderBy('siswas.nama_siswa');

            if (!empty($kelas)) {
                $absensi->where('t1.kelas', $kelas);
            }

            if (!empty($daftar_mapel)) {
                $absensi->where('t1.id_mapel', $daftar_mapel);
            }

            if (!empty($daftar_tanggal)) {
                $absensi->where('t1.tgl_absensi', $daftar_tanggal);
            }

            $absensi = $absensi->get();

            // Ubah nilai 0 menjadi "0" pada kolom yang diinginkan
            $absensis = collect($absensi)->map(function ($item) {
                $item->nama_siswa = ucwords(strtolower($item->nama_siswa));
                $item->jumlahMasuk = $item->jumlahMasuk === 0 ? "0" : $item->jumlahMasuk;
                $item->jumlahGaMasuk = $item->jumlahGaMasuk === 0 ? "0" : $item->jumlahGaMasuk;
                $item->jumlahSakit = $item->jumlahSakit === 0 ? "0" : $item->jumlahSakit;
                $item->jumlahIzin = $item->jumlahIzin === 0 ? "0" : $item->jumlahIzin;
                $item->jumlahAlpha = $item->jumlahAlpha === 0 ? "0" : $item->jumlahAlpha;
                $item->tanpaKeterangan = $item->tanpaKeterangan === 0 ? "0" : $item->tanpaKeterangan;

                return $item;
            });

            return $absensis;
        }
    }

    public function headings(): array
    {

        $header = $this->header;

        return $header;
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $event->sheet->getStyle('A1:H1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => Color::COLOR_RED, // Red background color
                        ],
                    ],
                ]);

                $lastRow = $event->sheet->getHighestRow();
                $event->sheet->getStyle('A2:B' . $lastRow)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => 'd7d7d7',
                        ],
                    ],
                ]);


                $columnTidakMasuk = 'C';
                $event->sheet->getStyle($columnTidakMasuk)->applyFromArray([
                    'font' => [
                        'color' => [
                            'rgb' => Color::COLOR_RED, // Warna merah
                        ],
                    ],
                ]);

                $event->sheet->getStyle('1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => [
                            'rgb' => Color::COLOR_BLACK, // Warna merah
                        ],
                    ],
                ]);

                $event->sheet->getStyle('A:B')->applyFromArray([
                    'font' => [
                        'bold' => true,
                    ],
                ]);

                $event->sheet->getStyle('A1:H' . $lastRow)->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);
            },
        ];
    }
}