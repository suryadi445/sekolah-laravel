<?php

namespace App\Exports;

use App\Models\Absensi;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class AbsensiExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    private $header;
    private $kelas;
    protected $hidden = ['id', 'id_siswa', 'id_mapel', 'user', 'created_at', 'updated_at'];


    public function __construct(array $header, $kelas)
    {
        $this->header = $header;
        $this->kelas = $kelas;
    }
    /**
     * @return \Illuminate\Support\Collection
     */


    public function collection()
    {
        $hidden = $this->hidden;
        $kelas = $this->kelas;
        $id_userGuru = auth()->user()->id;

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
