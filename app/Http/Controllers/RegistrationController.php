<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hakAksesController();

        $title = 'Registrasi Siswa';
        $registration = Registration::latest()->paginate(20);

        return view('backend.registration', compact(['title', 'registration']));
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
            'thn_ajaran' => 'required',
            'gelombang' => 'required',
            'tgl_pendaftaran' => 'required',
            'tgl_penutupan' => 'required',
            'info_pendaftaran' => 'required',
        ]);

        $insert = Registration::create([
            'thn_ajaran' => $request->thn_ajaran,
            'gelombang' => $request->gelombang,
            'tgl_pendaftaran' => $request->tgl_pendaftaran,
            'tgl_penutupan' => $request->tgl_penutupan,
            'info_pendaftaran' => $request->info_pendaftaran,
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
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        $data = Registration::find($registration->id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        $request->validate([
            'thn_ajaran' => 'required',
            'gelombang' => 'required',
            'tgl_pendaftaran' => 'required',
            'tgl_penutupan' => 'required',
            'info_pendaftaran' => 'required',
        ]);

        $update = Registration::where('id', $registration->id)
            ->update([
                'thn_ajaran' => $request->thn_ajaran,
                'gelombang' => $request->gelombang,
                'tgl_pendaftaran' => $request->tgl_pendaftaran,
                'tgl_penutupan' => $request->tgl_penutupan,
                'info_pendaftaran' => $request->info_pendaftaran,
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
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {
        $delete = Registration::destroy($registration->id);

        if ($delete) {
            return back()->with('success', 'Success! Data successfuly deleted');
        } else {
            return back()->with('failed', 'Alert! Data failed to deleted');
        }
    }
}
