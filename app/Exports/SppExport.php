<?php

namespace App\Exports;

use App\Models\Spp;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;



class SppExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    private $header;
    protected $table = 'spps';

    public function __construct(array $header)
    {
        $this->header = $header;
    }


    public function collection()
    {

        $data = Spp::rightJoin('siswas', 'spps.id_siswa', '=', 'siswas.id')
            ->join('payments', 'payments.id', '=', 'spps.merchant')
            ->select('siswas.nama_siswa', 'siswas.kelas', 'siswas.sub_kelas', 'spps.nama_bulan', 'spps.tahun', 'spps.tipe_pembayaran', 'jenis_pembayaran', 'payments.nama as merchant', 'keterangan', 'nominal', 'spps.created_at')
            ->get();

        return $data;
    }

    public function columnFormats(): array
    {
        return [
            'A' => 0,
            'B' => 0,
            'C' => 0,
            'D' => 0,
            'E' => 0,
            'F' => 0,
            'G' => 0,
            'H' => 0,
            'I' => 0,
            'J' => 0,
            'K' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }


    public function map($client): array
    {
        return [
            $client->nama_siswa,
            $client->kelas,
            $client->sub_kelas,
            $client->nama_bulan,
            $client->tahun,
            $client->tipe_pembayaran,
            $client->jenis_pembayaran,
            $client->merchant,
            $client->keterangan,
            $client->nominal,
            Date::dateTimeToExcel($client->created_at)
        ];
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
