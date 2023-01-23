<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;


class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Guru';
        $guru = Guru::latest()->search()->paginate(20);

        return view('backend/guru', compact(['guru', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Guru';

        return view('backend.guru_add', compact(['title']));
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
            'nik' => 'required|numeric|unique:gurus',
            'nama_guru' => 'required',
            'pendidikan_terakhir' => 'required',
            'jabatan' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required|unique:gurus',
            'agama' => 'required',
            'alamat' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $images = $request->file('image');

            $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();

            $images->move(public_path('images/upload/'), $imageName);

            $image = '\images/upload/' . $imageName;
        }

        $insert = Guru::create([
            'nik'   => $request->nik,
            'nama_guru'   => $request->nama_guru,
            'gelar'   => $request->gelar,
            'pendidikan_terakhir'   => $request->pendidikan_terakhir,
            'program_studi'   => $request->program_studi,
            'alumni_dari'   => $request->alumni_dari,
            'jabatan'   => $request->jabatan,
            'tempat_lahir'   => $request->tempat_lahir,
            'tgl_lahir'   => $request->tgl_lahir,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'no_hp'   => $request->no_hp,
            'email'   => $request->email,
            'agama'   => $request->agama,
            'nip'   => $request->nip,
            'nuptk'   => $request->nuptk,
            'mulai_tugas'   => $request->mulai_tugas,
            'no_rekening'   => $request->no_rekening,
            'nama_bank'   => $request->nama_bank,
            'alamat'   => $request->alamat,
            'image'   => $image ?? '',
        ]);

        if ($insert) {
            return redirect('/guru')->with('success', 'Success! Data saved successfully');
        } else {
            return redirect('/guru')->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        $guru = Guru::where('id', $guru->id)->first();

        return view('backend.guru_edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guru $guru)
    {
        $request->validate([
            'nik' => [
                'required',
                'numeric',
                Rule::unique('gurus')->ignore($guru->id)
            ],
            'nama_guru' => 'required',
            'pendidikan_terakhir' => 'required',
            'jabatan' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => [
                'required',
                Rule::unique('gurus')->ignore($guru->id)
            ],
            'agama' => 'required',
            'alamat' => 'required',
        ]);

        if ($request->hasFile('image')) {

            if ($guru->image) {
                $file_path = public_path() .  $guru->image;
                unlink($file_path);
            }

            $images = $request->file('image');

            $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();

            $images->move(public_path('images/upload/'), $imageName);

            $image = '\images/upload/' . $imageName;
        } else {
            $image = $guru->image;
        }

        $update = Guru::where('id', $guru->id)
            ->update([
                'nik'   => $request->nik,
                'nama_guru'   => $request->nama_guru,
                'gelar'   => $request->gelar,
                'pendidikan_terakhir'   => $request->pendidikan_terakhir,
                'program_studi'   => $request->program_studi,
                'alumni_dari'   => $request->alumni_dari,
                'jabatan'   => $request->jabatan,
                'tempat_lahir'   => $request->tempat_lahir,
                'tgl_lahir'   => $request->tgl_lahir,
                'jenis_kelamin'   => $request->jenis_kelamin,
                'no_hp'   => $request->no_hp,
                'email'   => $request->email,
                'agama'   => $request->agama,
                'nip'   => $request->nip,
                'nuptk'   => $request->nuptk,
                'mulai_tugas'   => $request->mulai_tugas,
                'no_rekening'   => $request->no_rekening,
                'nama_bank'   => $request->nama_bank,
                'alamat'   => trim($request->alamat),
                'image'   => $image,
            ]);

        if ($update) {
            return redirect('/guru')->flash('success', 'Success! Data saved successfully');
        } else {
            return redirect('/guru')->flash('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {

        $delete = guru::destroy($guru->id);

        if ($delete) {
            return back()->with('success', 'Success! file deleted');
        } else {
            return back()->with('failed', 'Alert! file not deleted');
        }
    }
}