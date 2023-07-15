<?php

namespace App\Exports;

use App\Models\Promoted;
use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class PromotedExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    private $header;
    private $kelas;
    private $subKelas;
    private $param;
    // protected $hidden = ['id', 'id_siswa', 'thn_ajaran_awal', 'thn_ajaran_akhir' , 'user', 'created_at', 'updated_at'];


    public function __construct(array $header, $kelas, $subKelas, $param)
    {
        $this->header = $header;
        $this->kelas = $kelas;
        $this->subKelas = $subKelas;
        $this->param = $param;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // $hidden = $this->hidden;
        $kelas = $this->kelas;
        $subKelas = $this->subKelas;
        $param = $this->param;
        $ajaran_awal = getTahunAjaran()->thn_ajaran_awal;
        $ajaran_akhir = getTahunAjaran()->thn_ajaran_akhir;

        if ($param == 'detail') {
            $Promoted = Siswa::join('promoteds', 'siswas.id', '=', 'promoteds.id_siswa')
                ->select('siswas.nama_siswa', 'siswas.jenis_kelamin', 'siswas.tempat_lahir', 'siswas.tgl_lahir', 'siswas.agama', 'siswas.nis', 'siswas.nisn', 'promoteds.status')
                ->where('kelas', $kelas)
                ->where('sub_kelas', $subKelas)
                ->orderBy('siswas.nama_siswa')
                ->orderBy('promoteds.status')
                ->get();
        } else {
            $Promoted = Siswa::rightJoin('promoteds', 'siswas.id', '=', 'promoteds.id_siswa')
                ->select('siswas.nama_siswa', 'siswas.jenis_kelamin', 'siswas.tempat_lahir', 'siswas.tgl_lahir', 'siswas.agama', 'siswas.nis', 'siswas.nisn', 'promoteds.status')
                ->where('promoteds.kelas_awal', $kelas)
                ->where('promoteds.sub_kelas_awal', $subKelas)
                ->where('promoteds.thn_ajaran_awal', $ajaran_awal)
                ->where('promoteds.thn_ajaran_akhir', $ajaran_akhir)
                ->orderBy('siswas.nama_siswa')
                ->orderBy('promoteds.status')
                ->get();
        }

        return $Promoted;
    }

    public function headings(): array
    {
        return $this->header;
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
