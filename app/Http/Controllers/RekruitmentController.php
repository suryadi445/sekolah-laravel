<?php

namespace App\Http\Controllers;

use App\Models\Rekruitment;
use Illuminate\Http\Request;

class RekruitmentController extends Controller
{
    public function index()
    {
        $title = 'Rekruitment';
        $jabatan = Rekruitment::select('jabatan')->groupBy('jabatan')->get();
        $get_jabatan = request('jabatan');
        $get_proses = request('proses');

        $rekruitment = Rekruitment::orderBy('created_at');
        if ($get_jabatan != 'all') {
            $rekruitment->where('jabatan', $get_jabatan);
            if ($get_proses != 'all') {
                $rekruitment->where('proses', $get_proses);
            }
        } else {
            if ($get_proses != 'all') {
                $rekruitment->where('proses', $get_proses);
            }
        }
        $rekruitment = $rekruitment->paginate(20);

        // dd($rekruitment);

        return view('backend.rekruitment', compact(['title', 'rekruitment', 'jabatan']));
    }

    public function prosesCV(Request $request)
    {
        $value = $request->value;

        $update = Rekruitment::where('id', $request->id)
            ->update(['proses' => $value]);

        if ($update) {
            $request->session()->put('success', 'Success! Data saved successfully');
        } else {
            $request->session()->put('failed', 'Alert! Data failed to save');
        }
    }
}
