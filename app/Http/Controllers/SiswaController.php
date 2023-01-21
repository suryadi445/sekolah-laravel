<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;



class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Siswa';
        $siswa = Siswa::latest()->search()->paginate(20);

        return view('backend/siswa', compact(['siswa', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Siswa';

        return view('backend/siswa_add', compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama_siswa' => 'required|max:100',
            'tempat_lahir' => 'required|max:20',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'nis' => 'required|max:30|unique:siswas',
            'agama' => 'required|max:20',
            'alamat' => 'required',
            'nama_ayah' => 'max:100',
            'no_hp_ayah' => 'max:20',
            'pekerjaan_ayah' => 'max:100',
            'nama_ibu' => 'max:100',
            'no_hp_ibu' => 'max:20',
            'pekerjaan_ibu' => 'max:100',
            'alamat_ortu' => 'max:1000',
            'nama_wali' => 'max:100',
            'no_hp_wali' => 'max:20',
            'pekerjaan_wali' => 'max:100',
            'alamat_wali' => 'max:1000',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $images = $request->file('image');

            $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();

            $images->move(public_path('images/upload/'), $imageName);

            $image = '\images/upload/' . $imageName;
        }

        $insert = Siswa::create([
            'thn_ajaran' => $request->tahun_ajaran_awal . '-' . $request->tahun_ajaran_akhir,
            'nama_siswa' => $request->nama_siswa,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nis' => $request->nis,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'nama_ayah' => $request->nama_ayah,
            'no_hp_ayah' => $request->no_hp_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nama_ibu' => $request->nama_ibu,
            'no_hp_ibu' => $request->no_hp_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'alamat_ortu' => $request->alamat_ortu,
            'nama_wali' => $request->nama_wali,
            'no_hp_wali' => $request->no_hp_wali,
            'pekerjaan_wali' => $request->pekerjaan_wali,
            'alamat_wali' => $request->alamat_wali,
            'image' => $image ?? '',
        ]);

        if ($insert) {
            return Redirect::to('/siswa')->with('success', 'Success! Data saved successfully');
        } else {
            return Redirect::to('/siswa')->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        $title = 'Edit Siswa';
        $siswa = Siswa::where('id', $siswa->id)->first();
        $tahun_ajaran = explode('-', $siswa->thn_ajaran);


        return view('backend.siswa_edit', compact(['title', 'siswa', 'tahun_ajaran']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validate = $request->validate([
            'nama_siswa' => 'required|max:100',
            'tempat_lahir' => 'required|max:20',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'nis' => [
                'required',
                'max:30',
                Rule::unique('siswas')->ignore($siswa->id)
            ],
            'agama' => 'required|max:20',
            'alamat' => 'required',
            'nama_ayah' => 'max:100',
            'no_hp_ayah' => 'max:20',
            'pekerjaan_ayah' => 'max:100',
            'nama_ibu' => 'max:100',
            'no_hp_ibu' => 'max:20',
            'pekerjaan_ibu' => 'max:100',
            'alamat_ortu' => 'max:1000',
            'nama_wali' => 'max:100',
            'no_hp_wali' => 'max:20',
            'pekerjaan_wali' => 'max:100',
            'alamat_wali' => 'max:1000',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->hasFile('image')) {

            if ($siswa->image) {
                $file_path = public_path() .  $siswa->image;
                unlink($file_path);
            }

            $images = $request->file('image');

            $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();

            $images->move(public_path('images/upload/'), $imageName);

            $image = '\images/upload/' . $imageName;
        } else {
            $image = $siswa->image;
        }


        $update = Siswa::where('id', $siswa->id)
            ->update([
                'thn_ajaran' => $request->tahun_ajaran_awal . '-' . $request->tahun_ajaran_akhir,
                'nama_siswa' => $request->nama_siswa,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nis' => $request->nis,
                'agama' => $request->agama,
                'alamat' => $request->alamat,
                'nama_ayah' => $request->nama_ayah,
                'no_hp_ayah' => $request->no_hp_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'nama_ibu' => $request->nama_ibu,
                'no_hp_ibu' => $request->no_hp_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'alamat_ortu' => $request->alamat_ortu,
                'nama_wali' => $request->nama_wali,
                'no_hp_wali' => $request->no_hp_wali,
                'pekerjaan_wali' => $request->pekerjaan_wali,
                'alamat_wali' => $request->alamat_wali,
                'image' => $image ?? '',
            ]);

        if ($update) {
            return Redirect::to('/siswa')->with('success', 'Success! Data saved successfully');
        } else {
            return Redirect::to('/siswa')->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        if ($siswa->image) {
            $file_path = public_path() .  $siswa->image;
            unlink($file_path);
        }

        $delete = Siswa::destroy($siswa->id);

        if ($delete) {
            return back()->with('success', 'Success! file deleted');
        } else {
            return back()->with('failed', 'Alert! file not deleted');
        }
    }
}