<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Schedule;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\ScheduleExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;



class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Jadwal Pelajaran';
        $paramKelas = request('kelas');
        $paramHari = request('hari');
        $kelas = Kelas::orderBy('kelas')->orderBy('sub_kelas')->get();
        $mapels = Mapel::orderBy('mata_pelajaran')->get();

        $schedule = Schedule::orderBy('id');
        if ($paramKelas) {
            $schedule->where('kelas', $paramKelas);
        }
        if ($paramHari) {
            $schedule->where('hari', $paramHari);
        }
        $schedule = $schedule->paginate(20);

        return view('backend.schedule', compact(['title', 'schedule', 'mapels', 'kelas']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required',
            'hari' => 'required',
            'mapel' => 'required',
        ]);

        $insert = Schedule::create([
            'kelas' => $request->kelas,
            'hari' => $request->hari,
            'id_mapel' => implode(',', $request->mapel),
            'user' => Auth::id()
        ]);

        if ($insert) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $data = Schedule::where('id', $schedule->id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'kelas' => 'required',
            'hari' => 'required',
            'mapel' => 'required',
        ]);

        $update = Schedule::where('id', $schedule->id)
            ->update([
                'kelas' => $request->kelas,
                'hari' => $request->hari,
                'id_mapel' => implode(',', $request->mapel),
                'user' => Auth::id()
            ]);

        if ($update) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        $delete = Schedule::destroy('id', $schedule->id);

        if ($delete) {
            return back()->with('success', 'Success! Data successfuly deleted');
        } else {
            return back()->with('failed', 'Alert! Data failed to deleted');
        }
    }

    public function exportExcel($kelas = null, $hari = null)
    {
        $header = ['Hari', 'Kelas', 'Jadwal Pelajaran'];

        return Excel::download(new ScheduleExport($header, $kelas, $hari), 'schedule.xlsx');
    }

    public function exportPdf($kelas = null, $hari = null)
    {
        $object = new Schedule();
        $data = $object->printPDF($kelas, $hari);
        $title = 'Daftar Jadwal Pelajaran';


        $pdf = PDF::loadview('pdf.schedulePdf', ['data' => $data, 'title' => $title]);
        return $pdf->stream('schedule.pdf');
        // return $pdf->download('Siswa.pdf');
    }
}
