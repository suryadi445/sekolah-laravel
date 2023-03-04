<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jabatan;
use aPP\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



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
        $jabatan = Jabatan::orderBy('nama_jabatan')->get();

        return view('backend.guru_add', compact(['title', 'jabatan']));
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
            'nik' => 'required|numeric|unique:gurus,deleted_at,NULL',
            'nama_guru' => 'required',
            'pendidikan_terakhir' => 'required',
            'jabatan' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required|unique:gurus',
            'agama' => 'required',
            'alamat' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:2048'
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
            'user' => Auth::id(),
            'image'   => $image ?? '',
        ]);
        $id_guru = $insert->id;

        // PROSES INSERT USER GURU
        $this->insert_user($request, $id_guru);

        if ($insert) {
            return redirect('/guru')->with('success', 'Success! Data saved successfully');
        } else {
            return redirect('/guru')->with('failed', 'Alert! Data failed to save');
        }
    }

    public function insert_user($request, $id_guru)
    {
        $passwordGuru = date("dmY", strtotime($request->tgl_lahir));
        // create user
        User::create([
            'name' => $request->nama_guru,
            'no_hp' => $request->no_hp,
            'id_guru' => $id_guru,
            'id_group' => 3, // id_group (super admin, kepsek, guru, ortu)
            'password' => Hash::make($passwordGuru),
        ]);
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
        $jabatan = Jabatan::orderBy('nama_jabatan')->get();

        return view('backend.guru_edit', compact(['guru', 'jabatan']));
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
                Rule::unique('gurus')->ignore($guru->id)->whereNull('deleted_at')
            ],
            'nama_guru' => 'required',
            'pendidikan_terakhir' => 'required',
            'jabatan' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => [
                'required',
                Rule::unique('gurus')->ignore($guru->id)->whereNull('deleted_at')
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
                'alamat'   => $request->alamat,
                'image'   => $image,
                'user' => Auth::id(),
            ]);

        // PROSES UPDATE USER GURU
        $this->update_user($request, $guru);

        if ($update) {
            return redirect('/guru')->with('success', 'Success! Data saved successfully');
        } else {
            return redirect('/guru')->with('failed', 'Alert! Data failed to save');
        }
    }

    public function update_user($request, $guru)
    {
        // update user
        $updateUser = [
            'name' => $request->nama_guru,
            'no_hp' => $request->no_hp,
        ];

        if ($request->tgl_lahir != $guru->tgl_lahir) {
            $passwordGuru = date("dmY", strtotime($request->tgl_lahir));
            $updateUser['password'] = Hash::make($passwordGuru);
        }

        User::where('id_guru', $guru->id)
            ->update($updateUser);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {

        $delete = Guru::destroy($guru->id);

        if ($delete) {
            return back()->with('success', 'Success! file deleted');
        } else {
            return back()->with('failed', 'Alert! file not deleted');
        }
    }
}