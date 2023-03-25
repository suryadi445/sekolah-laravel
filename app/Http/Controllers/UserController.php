<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hakAksesController();

        $title = 'Users';
        $aktivasi_guru = request('aktivasi_guru');
        $aktivasi_siswa = request('aktivasi_siswa');

        // query for sdm internal
        $internal = User::join('gurus', 'users.id_guru', '=', 'gurus.id');
        if ($aktivasi_guru != null) {
            $internal->where('users.is_active', $aktivasi_guru);
        }
        $internal->where('users.id_siswa', 0);
        $internal->groupBy('users.id_guru');
        $internal->select('gurus.*', 'users.is_active');
        $internal = $internal->paginate(20);

        // query for sdm eksternal
        $eksternal = User::join('siswas', 'users.id_siswa', '=', 'siswas.id');
        $eksternal->where('users.id_guru', 0);
        if ($aktivasi_siswa != null) {
            $eksternal->where('users.is_active', $aktivasi_siswa);
        }
        $eksternal->select('siswas.*', 'users.is_active', 'users.no_hp');
        $eksternal = $eksternal->paginate(20);


        return view('backend.user', compact(['title', 'internal', 'eksternal']));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = request('id');
        $value = request('value');
        $user = request('user');

        if ($user == 'siswa') {
            $update = User::where('id_siswa', $id)
                ->update([
                    'is_active' => $value,
                ]);
        } else {
            $update = User::where('id_guru', $id)
                ->update([
                    'is_active' => $value,
                ]);
        }

        if ($update) {
            return response()->json(['success' => 'Success! Data saved successfully']);
        } else {
            return response()->json(['failed' => 'Alert! Data failed to save']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
