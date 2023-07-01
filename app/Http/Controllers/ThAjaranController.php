<?php

namespace App\Http\Controllers;

use App\Models\Th_ajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ThAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Tahun Ajaran';
        $th_ajaran = Th_ajaran::first();

        return view('backend.thAjaran', compact(['th_ajaran', 'title']));
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
            'thn_ajaran_awal' => 'required',
            'thn_ajaran_akhir' => 'required',
        ]);

        $insert = Th_ajaran::create([
            'thn_ajaran_awal' => $request->thn_ajaran_awal,
            'thn_ajaran_akhir' => $request->thn_ajaran_akhir,
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
     * @param  \App\Models\Th_ajaran  $th_ajaran
     * @return \Illuminate\Http\Response
     */
    public function show(Th_ajaran $th_ajaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Th_ajaran  $th_ajaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Th_ajaran $th_ajaran)
    {
        $data = Th_ajaran::first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Th_ajaran  $th_ajaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Th_ajaran $th_ajaran)
    {
        $request->validate([
            'thn_ajaran_awal' => 'required',
            'thn_ajaran_akhir' => 'required',
        ]);

        $update = Th_ajaran::where('id', $request->id)
            ->update([
                'thn_ajaran_awal' => $request->thn_ajaran_awal,
                'thn_ajaran_akhir' => $request->thn_ajaran_akhir,
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
     * @param  \App\Models\Th_ajaran  $th_ajaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Th_ajaran $th_ajaran)
    {
        //
    }
}
