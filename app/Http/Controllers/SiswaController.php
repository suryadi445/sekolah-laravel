<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SiswaExport;
use Barryvdh\DomPDF\Facade\Pdf;




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

        return view('backend.siswa', compact(['siswa', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Siswa';
        $kelas = Kelas::groupBy('sub_kelas')
            ->groupBy('kelas')
            ->orderBy('kelas')->get();

        return view('backend.siswa_add', compact(['title', 'kelas']));
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
            'nama_siswa' => 'required|max:100',
            'tempat_lahir' => 'required|max:20',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'nis' => 'required|max:30|unique:siswas,nis,NULL,id,deleted_at,NULL|unique:users,no_hp,NULL,id',
            'agama' => 'required|max:20',
            'kelas' => 'required',
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

        $ajaran_awal = getTahunAjaran()->thn_ajaran_awal;
        $ajaran_akhir = getTahunAjaran()->thn_ajaran_akhir;


        if ($request->hasFile('image')) {
            $images = $request->file('image');

            $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();
            $imageResize = Image::make($images);
            $imageResize->orientate()
                ->fit(360, 360, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })
                ->save('images\upload' . '/' . $imageName);

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
            'kelas' => explode('.', $request->kelas)[0],
            'sub_kelas' => explode('.', $request->kelas)[1],
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
            'user' => Auth::id(),
            'thn_ajaran_berjalan_awal' => $ajaran_awal,
            'thn_ajaran_berjalan_akhir' => $ajaran_akhir,
        ]);
        $id_siswa = $insert->id;

        $this->insert_user($request, $id_siswa);

        if ($insert) {
            return Redirect::to('/siswa')->with('success', 'Success! Data saved successfully');
        } else {
            return Redirect::to('/siswa')->with('failed', 'Alert! Data failed to save');
        }
    }

    public function insert_user($request, $id_siswa)
    {
        $nis = $request->nis;

        // create user
        User::create([
            'name' => $request->nama_siswa,
            'no_hp' => $nis,
            'id_siswa' => $id_siswa, // insert id
            'id_group' => 4, // id_group (super admin, kepsek, guru, ortu)
            'passAsli' => $nis,
            'password' => Hash::make($nis),
        ]);
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
        $kelas = Kelas::groupBy('sub_kelas')
            ->groupBy('kelas')
            ->orderBy('kelas')->get();


        return view('backend.siswa_edit', compact(['title', 'siswa', 'tahun_ajaran', 'kelas']));
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
        $request->validate([
            'nama_siswa' => 'required|max:100',
            'tempat_lahir' => 'required|max:20',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'nis' => [
                'required',
                'max:30',
                Rule::unique('siswas')->ignore($siswa->id)->whereNull('deleted_at'),
                Rule::unique('users', 'no_hp')->ignore($siswa->id, 'id_siswa')
            ],
            'agama' => 'required|max:20',
            'kelas' => 'required',
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
            $imageResize = Image::make($images);
            $imageResize->orientate()
                ->fit(360, 360, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })
                ->save('images\upload' . '/' . $imageName);

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
                'kelas' => explode('.', $request->kelas)[0],
                'sub_kelas' => explode('.', $request->kelas)[1],
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
                'user' => Auth::id(),

            ]);

        // PROSES UPDATE KE TABLE USER
        $this->update_user($request, $siswa);


        if ($update) {
            return Redirect::to('/siswa')->with('success', 'Success! Data saved successfully');
        } else {
            return Redirect::to('/siswa')->with('failed', 'Alert! Data failed to save');
        }
    }

    public function update_user($request, $siswa)
    {
        //  update user siswa / wali murid
        $nis = $request->nis;

        $updateUser = [
            'name' => $request->nama_siswa,
            'no_hp' => $nis,
        ];

        if ($request->nis != $siswa->nis) {
            $updateUser['password'] = Hash::make($nis);
            $updateUser['passAsli'] = $nis;
        }

        // update user
        User::where('id_siswa', $siswa->id)
            ->update($updateUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        $delete = Siswa::destroy($siswa->id);
        if ($delete) {
            User::where('id_siswa', $siswa->id)
                ->update(['is_active' => '0']);
        }

        if ($delete) {
            return back()->with('success', 'Success! Data successfuly deleted');
        } else {
            return back()->with('failed', 'Alert! Data failed to deleted');
        }
    }

    public function exportExcel()
    {
        $header = ['Nama Siswa', 'Tempat Lahir', 'Tanggal Lahir', 'Kelas', 'Sub Kelas', 'Jenis Kelamin', 'Alamat', 'Agama', 'NIS', 'NISN', 'Tahun Ajaran', 'Nama Ayah', 'Nama Ibu', 'No Hp Ayah', 'No Hp Ibu', 'Pekerjaan Ayah', 'Pekerjaan Ibu', 'Alamat Orang Tua', 'Nama Wali', 'No Hp Wali', 'Pekerjaan Wali', 'Alamat Wali'];

        return Excel::download(new SiswaExport($header), 'siswa.xlsx');
    }

    public function exportPdf()
    {
        $object = new Siswa;
        $data = $object->printPDF();
        $title = 'Daftar Siswa';

        $pdf = PDF::loadview('pdf.siswaPdf', ['data' => $data, 'title' => $title]);
        return $pdf->stream('siswa.pdf');
        // return $pdf->download('Siswa.pdf');
    }
}
