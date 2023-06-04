<?php

namespace App\Exports;

use App\Models\Activity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ActivityExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    private $header;
    protected $hidden = ['id', 'image', 'user', 'created_at', 'updated_at'];


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
        $Activity = Activity::all()->makeHidden($hidden);

        return $Activity;
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
