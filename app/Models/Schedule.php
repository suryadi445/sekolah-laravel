<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function printPDF($kelas, $hari)
    {
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

        $schedules = $schedule->toArray();

        return $schedules;
    }
}
