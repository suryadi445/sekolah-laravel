<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Mapel;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Penilaian Siswa';
        $siswa = Siswa::orderBy('nama_siswa')->search()->paginate(20);
        $evaluation = Evaluation::latest()->paginate(20);
        $mapel = Mapel::all();

        return view('backend.evaluation', compact(['title', 'evaluation', 'mapel', 'siswa']));
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

        $jumlah_siswa = count($request->id_siswa);

        for ($i = 0; $i < $jumlah_siswa; $i++) {
            $insert = Evaluation::create([
                'id_siswa' => $request->id_siswa[$i],
                'id_mapel' => $request->id_mapel,
                'tanggal_penilaian' => $request->tanggal_penilaian,
                'nilai_siswa' => $request->nilai[$i],
                'grade' => $request->grade[$i] ?? '',
                'user' => Auth::id(),
                'status' => $request->status[$i],
            ]);
        }

        if ($insert) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
