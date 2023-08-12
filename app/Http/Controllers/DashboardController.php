<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Dashboard;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $user = userLogin()->id_group;
        $id_guru = userLogin()->id_guru;
        $thn_ajaran = getTahunAjaran();
        $thn_ajaran_awal = $thn_ajaran['thn_ajaran_awal'];
        $thn_ajaran_akhir = $thn_ajaran['thn_ajaran_akhir'];

        if ($user == 1 || $user == 2) {
            $data['title'] = 'Dashboard';
            $data = $this->admin($thn_ajaran_awal, $thn_ajaran_akhir);

            return view('backend.dashboard', $data);
        } else {
            $data['title'] = 'Dashboard';
            $data = $this->guru($id_guru);

            // dd($data['jumlah_absensi']);

            return view('backend.dashboard_guru', $data);
        }
    }

    public function guru($id_guru)
    {
        $dashboard = new Dashboard();
        $agama  = $dashboard->count_agama();

        for ($i = 1; $i <= 12; $i++) {
            $absensi[]    = $dashboard->count_absensi($i, $id_guru);
        }

        $data['jumlah_absensi'] = $absensi;
        $data['jumlah_kelas'] = $dashboard->count_kelas_guru($id_guru);
        $data['jumlah_siswa'] = $dashboard->count_siswa_guru($id_guru);
        $data['nama_agama'] = $dashboard->get_agama();
        $data['bulan'] = $dashboard->get_bulan();
        $data['absensiBulan'] = $dashboard->count_absensi(date('m'), $id_guru);

        $data['jml_agama'] = [$agama['islam'], $agama['kristen'], $agama['katolik'], $agama['hindu'], $agama['budha'], $agama['konghucu']];

        return $data;
    }

    public function admin($thn_ajaran_awal, $thn_ajaran_akhir)
    {
        $dashboard = new Dashboard();

        $agama  = $dashboard->count_agama();
        $siswa  = $dashboard->count_siswa($thn_ajaran_awal, $thn_ajaran_akhir);
        $guru   = $dashboard->count_guru();
        $kelas   = $dashboard->count_kelas();

        for ($i = 1; $i <= 12; $i++) {
            $spp[]    = $dashboard->count_spp($i);
        }

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

        return $data;
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

    public function getAbsensi($slug)
    {
        $dashboard = new Dashboard();

        $siswa  = $dashboard->get_absensi($slug);

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

    public function get_data_guru()
    {
        $dashboard = new Dashboard();
        $param = request('id');
        $tipe = request('tipe');

        $result = $dashboard->tabGuru($param, $tipe);

        return response()->json($result);
    }
}
