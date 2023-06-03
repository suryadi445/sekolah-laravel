<?php

namespace App\Exports;

use App\Models\Evaluation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class EvaluationExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    private $header;
    protected $hidden = ['id', 'user', 'created_at', 'updated_at'];
    protected $kelas;
    protected $id_mapel;
    protected $tgl;


    public function __construct(array $header, $kelas, $id_mapel, $tgl)
    {
        $this->header = $header;
        $this->kelas = $kelas;
        $this->id_mapel = $id_mapel;
        $this->tgl = $tgl;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $hidden = $this->hidden;
        $kelas = $this->kelas;
        $id_mapel = $this->id_mapel;
        $tgl = $this->tgl;

        $evaluation = Evaluation::join('siswas', 'evaluations.id_siswa', '=', 'siswas.id')
            ->join('mapels', 'evaluations.id_mapel', '=', 'mapels.id')
            ->select('siswas.nama_siswa', 'mapels.mata_pelajaran', 'evaluations.kelas', 'evaluations.nilai_siswa', 'evaluations.status', 'evaluations.tanggal_penilaian')
            ->orderBy('tanggal_penilaian')
            ->orderBy('nama_siswa');

        if ($kelas) {
            $evaluation->where('evaluations.kelas', $kelas);
        }

        if ($id_mapel) {
            $evaluation->where('evaluations.id_mapel', $id_mapel);
        }

        if ($tgl) {
            $evaluation->where('evaluations.tanggal_penilaian', $tgl);
        }


        $evaluation = $evaluation->get();

        return $evaluation;
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