<?php

namespace App\Exports;

use App\Models\AbsensiGuru;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Fill;



class AbsensiGuruExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    private $header;
    private $bulan;

    public function __construct(array $header, $bulan)
    {
        $this->header = $header;
        $this->bulan = $bulan;
    }
    /**
     * @return \Illuminate\Support\Collection
     */


    public function collection()
    {
        $bulan = $this->bulan;
        $id_guru = userLogin()->id_guru;

        $result = AbsensiGuru::join('gurus', 'absensi_gurus.id_guru', '=', 'gurus.id');
        if ($id_guru) {
            $result->where('gurus.id', $id_guru);
        }
        if ($bulan) {
            $result->whereMonth('absensi_gurus.created_at', $bulan);
        } else {
            $result->whereMonth('absensi_gurus.created_at', date('m'));
        }
        $results = $result->whereYear('absensi_gurus.created_at', date('Y'))
            ->orderByDesc('absensi_gurus.id')
            ->select('gurus.nama_guru', 'gurus.nik', 'absensi_gurus.tgl_absensi', 'absensi_gurus.created_at')
            ->get();


        $formatted = collect($results)->map(
            function ($res) {
                $res->hari = hari($res->created_at);
                $res->jam = jam($res->created_at);
                return $res;
            }
        );

        foreach ($formatted as $value) {
            unset($value->created_at);
        }

        return $formatted;
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

                $event->sheet->getStyle('A1:E1')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => Color::COLOR_RED, // Red background color
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
            },
        ];
    }
}
