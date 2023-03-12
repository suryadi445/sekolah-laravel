<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hakAksesController();

        $title = 'Kelas';
        $kelas = Kelas::leftJoin('gurus', 'kelas.id_guru', '=', 'gurus.id')
            ->orderBy('kelas.kelas')
            ->select('kelas.*', 'gurus.nama_guru')
            ->paginate(20);
        $guru = Guru::orderBy('nama_guru')->get();

        return view('backend.kelas', compact(['title', 'kelas', 'guru']));
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
            'sub_kelas' => 'required',
            'id_guru' => 'required',
            'biaya_spp' => 'numeric',
        ]);

        $insert = Kelas::create([
            'kelas' => $request->kelas,
            'sub_kelas' => $request->sub_kelas,
            'id_guru' => $request->id_guru,
            'keterangan' => $request->keterangan,
            'biaya_spp' => $request->biaya_spp,
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
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Kelas::find($id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'kelas' => 'required',
            'sub_kelas' => 'required',
            'id_guru' => 'required',
            'biaya_spp' => 'numeric',
        ]);

        $update = Kelas::where('id', $request->id)
            ->update([
                'kelas' => $request->kelas,
                'sub_kelas' => $request->sub_kelas,
                'id_guru' => $request->id_guru,
                'keterangan' => $request->keterangan,
                'biaya_spp' => $request->biaya_spp,
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
     * @param  \App\Models\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Kelas::destroy($id);

        if ($delete) {
            return back()->with('success', 'Success! Data successfuly deleted');
        } else {
            return back()->with('failed', 'Alert! Data failed to deleted');
        }
    }
}
