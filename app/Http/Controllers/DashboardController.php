<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // agama
        $islam = Siswa::where('agama', 'islam')->count();
        $kristen = Siswa::where('agama', 'kristen')->count();
        $katolik = Siswa::where('agama', 'katolik')->count();
        $hindu = Siswa::where('agama', 'hindu')->count();
        $budha = Siswa::where('agama', 'budha')->count();
        $konghucu = Siswa::where('agama', 'konghucu')->count();

        // kelas
        $kelas0 = Siswa::where('kelas', '0')->count();
        $kelas1 = Siswa::where('kelas', '1')->count();
        $kelas2 = Siswa::where('kelas', '2')->count();
        $kelas3 = Siswa::where('kelas', '3')->count();
        $kelas4 = Siswa::where('kelas', '4')->count();
        $kelas5 = Siswa::where('kelas', '5')->count();
        $kelas6 = Siswa::where('kelas', '6')->count();

        // siswa
        $tahun = date('Y');
        for ($i = 1; $i <= 12; $i++) {
            //gender
            $pria[] = Siswa::where('jenis_kelamin', 'laki-laki')->whereMonth('created_at', $i)->whereYear('created_at', $tahun)->count();
            $perempuan[] = Siswa::where('jenis_kelamin', 'perempuan')->whereMonth('created_at', $i)->whereYear('created_at', $tahun)->count();

            // kelas
            // $kelas0[] = Siswa::where('kelas', '0')->whereMonth('created_at', $i)->whereYear('created_at', $tahun)->count();
            // $kelas1[] = Siswa::where('kelas', '1')->whereMonth('created_at', $i)->whereYear('created_at', $tahun)->count();
            // $kelas2[] = Siswa::where('kelas', '2')->whereMonth('created_at', $i)->whereYear('created_at', $tahun)->count();
            // $kelas3[] = Siswa::where('kelas', '3')->whereMonth('created_at', $i)->whereYear('created_at', $tahun)->count();
            // $kelas4[] = Siswa::where('kelas', '4')->whereMonth('created_at', $i)->whereYear('created_at', $tahun)->count();
            // $kelas5[] = Siswa::where('kelas', '5')->whereMonth('created_at', $i)->whereYear('created_at', $tahun)->count();
            // $kelas6[] = Siswa::where('kelas', '6')->whereMonth('created_at', $i)->whereYear('created_at', $tahun)->count();
        }

        $data['title'] = 'Dashboard';
        $data['pria'] = $pria;
        $data['perempuan'] = $perempuan;
        $data['bulan'] = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $data['nama_agama'] = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu',];
        $data['jml_agama'] = [$islam, $kristen, $katolik, $hindu, $budha, $konghucu,];
        $data['nama_kelas'] = ['Kelas 0', 'Kelas 1', 'Kelas 2', 'Kelas 3', 'Kelas 4', 'Kelas 5', 'Kelas 6'];
        $data['kelas'] = [$kelas0, $kelas1, $kelas2, $kelas3, $kelas4, $kelas5, $kelas6];



        return view('backend.dashboard', $data);
    }

    public function getSiswa()
    {

        $jenis_kelamin = request('jenis_kelamin');
        $bulan = request('bulan');
        $agama = Siswa::latest()
            ->where('jenis_kelamin', $jenis_kelamin)
            ->whereMonth('created_at', bulanToNomor($bulan))
            ->get();

        return response()->json($agama);
    }

    public function getAgama($slug)
    {
        $agama = Siswa::latest()->where('agama', $slug)->get();

        return response()->json($agama);
    }

    public function getKelas($slug)
    {
        $kelas = substr($slug, 6);
        $agama = Siswa::latest()->where('kelas', $kelas)->get();

        return response()->json($agama);
    }
}