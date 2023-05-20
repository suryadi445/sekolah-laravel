<?php

namespace App\Exports;

use App\Models\Mapel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class MapelExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    private $header;
    protected $hidden = ['id', 'user', 'deleted_at', 'created_at', 'updated_at'];


    public function __construct(array $header)
    {
        $this->header = $header;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $hidden = $this->hidden;
        $mapel = Mapel::all()->makeHidden($hidden);

        return $mapel;
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
