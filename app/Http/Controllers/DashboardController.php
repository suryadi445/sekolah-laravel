<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        // - jumlah murid
        // - jumlah murid baru
        // - biaya pembayaran spp
        // - jumlah agama
        // - jumlah guru
        // - jumlah kelas



        $dashboard = new Dashboard();
        $thn_ajaran = getTahunAjaran();
        $thn_ajaran_awal = $thn_ajaran['thn_ajaran_awal'];
        $thn_ajaran_akhir = $thn_ajaran['thn_ajaran_akhir'];

        $agama  = $dashboard->count_agama();
        $siswa  = $dashboard->count_siswa($thn_ajaran_awal, $thn_ajaran_akhir);
        $guru   = $dashboard->count_guru();
        $kelas   = $dashboard->count_kelas();

        for ($i = 1; $i <= 12; $i++) {
            $spp[]    = $dashboard->count_spp($i);
        }

        $data['title'] = 'Dashboard';
        // agama
        $data['nama_agama'] = $dashboard->get_agama();
        $data['jml_agama'] = [$agama['islam'], $agama['kristen'], $agama['katolik'], $agama['hindu'], $agama['budha'], $agama['konghucu']];
        // siswa
        $data['jenis_siswa'] = ['Siswa Lama', 'Siswa Baru', 'Semua Siswa'];
        $data['jml_siswa'] = [$siswa['lama'], $siswa['baru'], $siswa['all']];
        // spp
        $data['bulan'] = $dashboard->get_bulan();
        $data['jml_spp'] = $spp;
        // guru
        $data['jml_guru'] = $guru;
        $data['jml_kelas'] = $kelas;
        // total siswa
        $data['total_siswa'] = $siswa['all'];



        return view('backend.dashboard', $data);
    }

    public function getSiswa($slug)
    {

        $dashboard = new Dashboard();

        $siswa  = $dashboard->get_siswa($slug);

        return datatables()->of($siswa)->toJson();
    }

    public function getSpp($slug)
    {
        $dashboard = new Dashboard();

        $siswa  = $dashboard->get_spp($slug);

        return datatables()->of($siswa)->toJson();
    }

    public function getAgama($slug)
    {
        $agama = Siswa::latest()->where('agama', $slug)->get();

        return datatables()->of($agama)->toJson();
    }

    public function get_data()
    {
        $dashboard = new Dashboard();
        $param = request('id');
        $tipe = request('tipe');

        $result = $dashboard->tab($param, $tipe);

        return response()->json($result);
    }
}
