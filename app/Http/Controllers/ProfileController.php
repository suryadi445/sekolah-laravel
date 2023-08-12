<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Introduction;
use App\Models\Profile;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Profile';
        $id_group = userLogin()->id_group ?? '';

        if ($id_group == 3) {
            $profileModel = new Profile();
            $id_guru = userLogin()->id_guru ?? '';
            $profile = Guru::join('users', 'gurus.id', '=', 'users.id_guru')
                ->where('gurus.id', $id_guru)
                ->select('gurus.*', 'users.no_hp as username')
                ->first();
            $cek_absensi = $profileModel->cek_absensi($id_guru);

            return view('backend.profileGuru', compact(['title', 'profile', 'id_guru', 'cek_absensi']));
        } elseif ($id_group == 4) {
            $id_siswa = userLogin()->id_siswa ?? '';
            $profile = Siswa::join('users', 'siswas.id', '=', 'users.id_siswa')
                ->where('siswas.id', $id_siswa)
                ->select('siswas.*', 'users.no_hp as username')
                ->first();

            return view('backend.profileSiswa', compact(['title', 'profile', 'id_siswa']));
        } else {
            $id_user = userLogin()->id ?? '';
            $profile = User::where('id', $id_user)->first();
            $kataPengantar = Introduction::first();

            return view('backend.profileAdmin', compact(['title', 'profile', 'id_user', 'kataPengantar']));
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function updateGuru(Request $request, $id)
    {

        $guru = Guru::where('id', $id)->first();
        $user = User::where('id_guru', $id)->first();
        $id_user = userLogin()->id ?? '';

        $request->validate([
            'username' => 'required|max:20|min:6|unique:users,no_hp,' . $user->id,
            'no_hp' => [
                'required',
                'max:20',
                'min:10',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'nullable|min:6',
            'alamat' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'nip' => [
                'required',
                Rule::unique('gurus')->ignore($guru->id)->whereNull('deleted_at')
            ],
            'nik' => [
                'required',
                Rule::unique('gurus')->ignore($guru->id)->whereNull('deleted_at')
            ],
        ]);

        //  Update User
        $dataUser = [
            'no_hp' => $request->username,
            'email' => $request->email,
        ];


        if (!empty($request->password)) {
            $dataUser['password'] = Hash::make($request->password);
            $dataUser['passAsli'] = $request->password;
        };

        $update = User::where('id_guru', $id)
            ->update($dataUser);

        // Update Guru
        $dataGuru = [
            'no_hp' => $request->no_hp,
            'nik' => $request->nik,
            'nip' => $request->nip,
            'alamat' => $request->alamat,
            'moto_guru' => $request->moto_guru,
            'email' => $request->email,
            'user' => $id_user,
        ];

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

            $dataGuru['image'] = $image;

            $file_path = public_path() .  $guru->image;

            if (!empty($guru->image)) {
                unlink($file_path);
            }
        }

        $update = Guru::where('id', $id)
            ->update($dataGuru);

        if ($update) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    public function updateAdmin(Request $request, $id_user)
    {
        $request->validate([
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'no_hp' => 'required|numeric|min:10',
            'password' => 'min:3',
        ]);

        $dataAdmin = [
            'email' => $request->email,
            'no_hp' => $request->username,
        ];

        if (!empty($request->password)) {
            $dataAdmin['password'] = Hash::make($request->password);
            $dataAdmin['passAsli'] = $request->password;
        }

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

            $dataAdmin['image'] = $image;

            // hapus foto lama
            $user = User::where('id', $id_user)->first();
            $file_path = public_path() .  $user->image;
            unlink($file_path);
        }

        $update = User::where('id', $id_user)
            ->update($dataAdmin);

        if ($update) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    public function updateSiswa(Request $request, $id_siswa)
    {
        $request->validate([
            'username' => 'required|numeric',
        ]);

        $dataSiswa = [
            'no_hp' => $request->username,
        ];

        if (!empty($request->password)) {
            $dataSiswa['password'] = Hash::make($request->password);
            $dataSiswa['passAsli'] = $request->password;
        }

        $update = User::where('id_siswa', $id_siswa)
            ->update($dataSiswa);

        if ($update) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }

    public function editGuru($id_guru)
    {
        $data = Guru::join('users', 'gurus.id', '=', 'users.id_guru')
            ->where('gurus.id', $id_guru)
            ->select('gurus.*', 'users.no_hp as username')
            ->first();

        return response()->json($data);
    }

    public function editAdmin($id_user)
    {
        $data = User::where('id', $id_user)->first();

        return response()->json($data);
    }

    public function editSiswa($id_siswa)
    {
        $data = User::where('id_siswa', $id_siswa)->first();

        return response()->json($data);
    }
}
