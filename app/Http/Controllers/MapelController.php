<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MapelExport;
use Barryvdh\DomPDF\Facade\Pdf;


class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hakAksesController();

        $title = 'Mata Pelajaran';
        $mapel = Mapel::orderBy('mata_pelajaran')->paginate(20);

        return view('backend.mapel', compact(['title', 'mapel']));
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
            'mata_pelajaran' => 'required|unique:mapels',
            'keterangan' => 'required',
        ]);

        $insert = Mapel::create([
            'mata_pelajaran' => $request->mata_pelajaran,
            'keterangan' => $request->keterangan,
            'user' => Auth::id(),
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
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function show(Mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        $data = Mapel::where('id', $mapel->id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapel $mapel)
    {
        $request->validate([
            'mata_pelajaran' => [
                'required',
                Rule::unique('mapels')->ignore($mapel->id)->whereNull('deleted_at')
            ],
            'keterangan' => 'required',
        ]);

        $update = Mapel::where('id', $mapel->id)
            ->update([
                'mata_pelajaran' => $request->mata_pelajaran,
                'keterangan' => $request->keterangan,
                'user' => Auth::id(),
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
     * @param  \App\Models\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        $delete = Mapel::destroy($mapel->id);

        if ($delete) {
            return back()->with('success', 'Success! file deleted');
        } else {
            return back()->with('failed', 'Alert! file not deleted');
        }
    }

    public function exportExcel()
    {
        $header = ['Mata Pelajaran', 'Keterangan'];

        return Excel::download(new MapelExport($header), 'mapel.xlsx');
    }

    public function exportPdf()
    {
        $object = new Mapel();
        $data = $object->printPDF();
        $title = 'Daftar Mapel';

        $pdf = PDF::loadview('pdf.mapelPdf', ['data' => $data, 'title' => $title]);
        return $pdf->stream('mapel.pdf');
        // return $pdf->download('Siswa.pdf');
    }
}
