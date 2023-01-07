<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Alumni;


class AktifitasController extends Controller
{
    public function index(Request $request)
    {
        $angkatans = Alumni::groupBy('angkatan_awal')->get();
        $diff      = Activity::distinct()->select('created_at')->get();
        $years     = $diff->unique();

        $tahun     = $request->tahun;
        $bulan     = $request->bulan;

        if ($tahun && $tahun != 'all') {
            if ($bulan != 'all') {
                $aktifitas = Activity::whereYear('created_at', $tahun)
                    ->whereMonth('created_at', $bulan)
                    ->paginate(12)
                    ->appends(request()->query());
            } else {
                $aktifitas = Activity::whereYear('created_at', $tahun)
                    ->paginate(12)
                    ->appends(request()->query());
            }
        } else if ($bulan && $bulan != 'all') {
            if ($tahun != 'all') {
                $aktifitas = Activity::whereYear('updated_at', $tahun)
                    ->whereMonth('updated_at', $bulan)
                    ->paginate(12)
                    ->appends(request()->query());
            } else {
                $aktifitas = Activity::whereMonth('updated_at', $bulan)
                    ->paginate(12)
                    ->appends(request()->query());
            }
        } else {
            $aktifitas = Activity::orderByDesc('id')->paginate(12);
        }


        return view('frontend.aktifitas', compact(['aktifitas', 'angkatans', 'years', 'tahun', 'bulan']));
    }
}