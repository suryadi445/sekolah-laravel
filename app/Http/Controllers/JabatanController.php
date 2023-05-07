<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JabatanExport;
use Barryvdh\DomPDF\Facade\Pdf;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hakAksesController();

        $jabatan = Jabatan::latest()->paginate(20);

        return view('backend.jabatan', compact(['jabatan']));
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
            'kode_jabatan' => 'string',
            'nama_jabatan' => 'required',
        ]);

        $insert = Jabatan::create([
            'kode_jabatan' => $request->kode_jabatan,
            'nama_jabatan' => $request->nama_jabatan,
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
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Jabatan $jabatan)
    {
        $data = Jabatan::find($jabatan->id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        $request->validate([
            'kode_jabatan' => 'string',
            'nama_jabatan' => 'required',
        ]);

        $update = Jabatan::where('id', $request->id)
            ->update([
                'kode_jabatan' => $request->kode_jabatan,
                'nama_jabatan' => $request->nama_jabatan,
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
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jabatan $jabatan)
    {
        $delete = Jabatan::destroy($jabatan->id);

        if ($delete) {
            return back()->with('success', 'Success! Data successfuly deleted');
        } else {
            return back()->with('failed', 'Alert! Data failed to deleted');
        }
    }

    public function exportExcel()
    {
        $header = ['Jabatan', 'Kode Jabatan'];

        return Excel::download(new JabatanExport($header), 'jabatan.xlsx');
    }

    public function exportPdf()
    {
        $object = new Jabatan();
        $data = $object->printPDF();
        $title = 'Daftar Jabatan';

        $pdf = PDF::loadview('pdf.jabatanPdf', ['data' => $data, 'title' => $title]);
        return $pdf->stream('jabatan.pdf');
        // return $pdf->download('Siswa.pdf');
    }
}