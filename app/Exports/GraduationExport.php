<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class GraduationExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    private $header;


    public function __construct(array $header)
    {
        $this->header = $header;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $results = Siswa::join('graduations', 'siswas.id', '=', 'graduations.id_siswa')
            ->select('siswas.nama_siswa', 'siswas.jenis_kelamin', 'siswas.tgl_lahir', 'siswas.thn_ajaran_berjalan_awal', 'siswas.thn_ajaran_berjalan_akhir')
            ->onlyTrashed()
            ->get();


        $graduation = collect($results)->map(
            function ($res) {
                $res->angkatan = $res->thn_ajaran_berjalan_awal . '-' .  $res->thn_ajaran_berjalan_akhir;

                unset($res->thn_ajaran_berjalan_awal);
                unset($res->thn_ajaran_berjalan_akhir);
                return $res;
            }
        );

        foreach ($graduation as $value) {
            unset($value->thn_ajaran_berjalan_awal);
            unset($value->thn_ajaran_berjalan_akhir);
        }

        return $graduation;
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