<?php

namespace App\Exports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;



class SiswaExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    private $header;
    protected $table = 'siswas';
    protected $hidden = ['id', 'image', 'provinsi', 'user', 'created_at', 'updated_at', 'deleted_at'];

    public function __construct(array $header)
    {
        $this->header = $header;
    }

    public function collection()
    {
        $hidden = $this->hidden;
        $siswa = Siswa::all()->makeHidden($hidden);
        return $siswa;
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
