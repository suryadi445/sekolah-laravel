<?php

namespace App\Exports;

use App\Models\Schedule;
use App\Models\Mapel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ScheduleExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    private $header;
    private $kelas;
    private $hari;
    protected $hidden = ['id', 'id_mapel', 'user', 'created_at', 'updated_at'];


    public function __construct(array $header, $kelas, $hari)
    {
        $this->header = $header;
        $this->kelas = $kelas;
        $this->hari = $hari;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $hidden = $this->hidden;
        $kelas = $this->kelas;
        $hari = $this->hari;

        $schedule = Schedule::all();

        if (!empty($kelas)) {
            $schedule = $schedule->where('kelas', '=', $kelas);
        }

        if (!empty($hari)) {
            $schedule = $schedule->where('hari', '=', $hari);
        }

        if (count($schedule) > 0) {
            foreach ($schedule as $key => $value) {
                $mapel[] = explode(',', $value->id_mapel);
            }

            $mataPelajaran = array();
            for ($i = 0; $i < count($mapel); $i++) {
                $coba = Mapel::select('mata_pelajaran')
                    ->where('id', '=', $mapel[$i])
                    ->first()->mata_pelajaran;
                array_push($mataPelajaran, $coba);
            }

            foreach ($schedule as $key => $value) {
                $value['mapel'] = $mataPelajaran[$key];
            }
        }

        return $schedule->makeHidden($hidden);
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
