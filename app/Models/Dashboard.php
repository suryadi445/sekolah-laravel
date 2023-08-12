<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Dashboard extends Model
{
    use HasFactory;

    public function count_agama()
    {
        $result['islam'] = Siswa::where('agama', 'islam')->count();
        $result['kristen'] = Siswa::where('agama', 'kristen')->count();
        $result['katolik'] = Siswa::where('agama', 'katolik')->count();
        $result['hindu'] = Siswa::where('agama', 'hindu')->count();
        $result['budha'] = Siswa::where('agama', 'budha')->count();
        $result['konghucu'] = Siswa::where('agama', 'konghucu')->count();

        return $result;
    }

    public function count_agama_guru($id_guru)
    {
        $result['islam'] = Siswa::join('kelas', 'siswas.kelas', '=', 'kelas.kelas')
            ->where('kelas.id_guru', $id_guru)
            ->where('siswas.agama', 'islam')->count();
        $result['kristen'] = Siswa::join('kelas', 'siswas.kelas', '=', 'kelas.kelas')
            ->where('kelas.id_guru', $id_guru)
            ->where('siswas.agama', 'kristen')->count();
        $result['katolik'] = Siswa::join('kelas', 'siswas.kelas', '=', 'kelas.kelas')
            ->where('kelas.id_guru', $id_guru)
            ->where('siswas.agama', 'katolik')->count();
        $result['hindu'] = Siswa::join('kelas', 'siswas.kelas', '=', 'kelas.kelas')
            ->where('kelas.id_guru', $id_guru)
            ->where('siswas.agama', 'hindu')->count();
        $result['budha'] = Siswa::join('kelas', 'siswas.kelas', '=', 'kelas.kelas')
            ->where('kelas.id_guru', $id_guru)
            ->where('siswas.agama', 'budha')->count();
        $result['konghucu'] = Siswa::join('kelas', 'siswas.kelas', '=', 'kelas.kelas')
            ->where('kelas.id_guru', $id_guru)
            ->where('siswas.agama', 'konghucu')->count();

        return $result;
    }

    public function get_agama()
    {
        $result = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'];

        return $result;
    }


    public function count_siswa($thn_ajaran_awal = null, $thn_ajaran_akhir = null)
    {
        $thn_ajaran = $thn_ajaran_awal . '-' . $thn_ajaran_akhir;

        $result['baru'] = Siswa::where('thn_ajaran', $thn_ajaran)->count();
        $result['lama'] = Siswa::where('thn_ajaran', '!=', $thn_ajaran)->count();
        $result['all'] = Siswa::count();

        return $result;
    }

    public function get_siswa($param = null)
    {
        $thn_ajaran = getTahunAjaran();
        $thn_ajaran_awal = $thn_ajaran['thn_ajaran_awal'];
        $thn_ajaran_akhir = $thn_ajaran['thn_ajaran_akhir'];
        $thn_ajaran = $thn_ajaran_awal . '-' . $thn_ajaran_akhir;

        if ($param == 'siswa baru') {

            $result = Siswa::where('thn_ajaran', $thn_ajaran)->get();
        } else if ($param == 'siswa lama') {

            $result['lama'] = Siswa::where('thn_ajaran', '!=', $thn_ajaran)->count();
        } else {

            $result = Siswa::all();
        }


        return $result;
    }

    public function count_spp($bulan)
    {
        $tahun = date('Y');
        $result = Spp::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->sum('nominal');

        return $result;
    }

    public function count_absensi($bulan, $id_guru)
    {
        $tahun = date('Y');
        $result = AbsensiGuru::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->where('id_guru', $id_guru)
            ->count();

        return $result;
    }

    public function count_kelas()
    {

        $result = Kelas::groupBy('kelas', 'sub_kelas')->count();

        return $result;
    }

    public function count_kelas_guru($id_guru)
    {
        $result = Kelas::where('id_guru', $id_guru)->count();

        return $result;
    }

    public function count_siswa_guru($id_guru)
    {
        $result = Kelas::join('siswas', 'siswas.kelas', '=', 'kelas.kelas')
            ->where('kelas.id_guru', $id_guru)->count();

        return $result;
    }

    public function get_spp($slug)
    {
        $bulan = bulanToNomor($slug);

        $result = DB::table('siswas')
            ->join('spps', 'siswas.id', '=', 'spps.id_siswa')
            ->whereMonth('spps.created_at', $bulan)
            ->select('siswas.*')
            ->get();

        return $result;
    }

    public function get_absensi($slug)
    {
        $bulan = bulanToNomor($slug);

        $result = DB::table('absensi_gurus')
            ->join('gurus', 'absensi_gurus.id_guru', '=', 'gurus.id')
            ->whereMonth('absensi_gurus.created_at', $bulan)
            ->where('absensi_gurus.id_guru', userLogin()->id_guru)
            ->select('gurus.nama_guru', 'absensi_gurus.created_at', 'absensi_gurus.tgl_absensi')
            ->get();

        return $result;
    }

    public function count_guru()
    {
        $result['all'] = Guru::count();
        $pendidikan = DB::table('gurus')
            ->selectRaw('pendidikan_terakhir, COUNT(*) as total')
            ->groupBy('pendidikan_terakhir')
            ->get();

        $result['pendidikan_terakhir'] = [];
        $result['jml'] = [];
        foreach ($pendidikan as $r) {
            $result['pendidikan_terakhir'][] = $r->pendidikan_terakhir;
            $result['jml'][] = $r->total;
        }

        return $result;
    }

    public function get_bulan()
    {
        $result = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        return $result;
    }

    public function tab($param, $tipe)
    {
        $param = ucfirst($param);
        $tipe = ucfirst($tipe);

        if ($param == 'Guru') {
            $tab = $this->tab_guru($param, $tipe);
        } else if ($param == 'Siswa') {
            $tab = $this->tab_siswa($param, $tipe);
        } else if ($param == 'Kelas') {
            $tab = $this->tab_kelas($param, $tipe);
        }

        return $tab;
    }

    public function tabGuru($param, $tipe)
    {
        $param = ucfirst($param);
        $tipe = ucfirst($tipe);

        if ($param == 'Guru') {
            $tab = $this->tabGuru_guru();
        } else if ($param == 'Siswa') {
            $tab = $this->tabGuru_siswa($param, $tipe);
        } else if ($param == 'Kelas') {
            $tab = $this->tabGuru_kelas($param, $tipe);
        }

        return $tab;
    }

    public function tab_guru($param, $tipe)
    {
        if ($tipe == 'Perempuan') {
            $data = Guru::where('jenis_kelamin', 'perempuan')->get();
        } else {
            $data = Guru::where('jenis_kelamin', 'laki-laki')->get();
        }

        $result = '';
        foreach ($data as $key => $value) {
            $result .= '
                <tr>
                    <td>' . $key + 1 . '</td>
                    <td>' . $value->nama_guru . '</td>
                    <td>' . $value->no_hp . '</td>
                    <td>' . $value->pendidikan_terakhir . '</td>
                </tr>';
        }

        if ($result == '') {
            $result = '
            <tr>
                <td colspan="100%" class="text-danger">
                    Data Tidak Tersedia
                </td>
            </tr>
            ';
        }

        $active = '';
        $activeP = '';
        if ($tipe == 'Perempuan') {
            $activeP = 'active';
        } else {
            $active = 'active';
        }

        $text = '
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link ' . $active . ' tab_detail" data-id="laki-laki" id="first-tab" data-bs-toggle="tab" data-bs-target="#first-tab-pane"
                        type="button" role="tab" aria-controls="first-tab-pane" aria-selected="true">
                        Guru Laki-Laki</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link ' . $activeP . ' tab_detail" data-id="perempuan" id="second-tab" data-bs-toggle="tab" data-bs-target="#second-tab-pane"
                        type="button" role="tab" aria-controls="second-tab-pane" aria-selected="false"> Guru
                        Perempuan</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="first-tab-pane" role="tabpanel" aria-labelledby="first-tab" tabindex="0">
                    <div class="table-responsive">
                        <input type="hidden" id="id_tipe" value="' . $param . '">  
                        <table class="table text-center table-striped mt-3">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <td>#</td>
                                    <td>Nama Guru</td>
                                    <td>No Hp</td>
                                    <td>Pendidikan Terakhir</td>
                                </tr>
                            </thead>
                            <tbody>
                                    

                                ' . ucfirst($result) . '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        ';

        return $text;
    }

    public function tabGuru_guru()
    {

        $data = AbsensiGuru::join('gurus', 'absensi_gurus.id_guru', '=', 'gurus.id')
            ->whereMonth('absensi_gurus.tgl_absensi', date('m'))
            ->where('absensi_gurus.id_guru', userLogin()->id_guru)
            ->select('absensi_gurus.tgl_absensi', 'gurus.nama_guru')
            ->get();

        $result = '';
        foreach ($data as $key => $value) {
            $result .= '
                <tr>
                    <td>' . $key + 1 . '</td>
                    <td>' . $value->nama_guru . '</td>
                    <td>' . $value->tgl_absensi . '</td>
                </tr>';
        }

        if ($result == '') {
            $result = '
            <tr>
                <td colspan="100%" class="text-danger">
                    Data Tidak Tersedia
                </td>
            </tr>
            ';
        }


        $text = '
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-id="laki-laki" id="first-tab" data-bs-toggle="tab" data-bs-target="#first-tab-pane"
                        type="button" role="tab" aria-controls="first-tab-pane" aria-selected="true">
                        Data Absensi
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="first-tab-pane" role="tabpanel" aria-labelledby="first-tab" tabindex="0">
                    <div class="table-responsive">
                        <table class="table text-center table-striped mt-3">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <td>#</td>
                                    <td>Nama Guru</td>
                                    <td>Tanggal Absensi</td>
                                </tr>
                            </thead>
                            <tbody>
                                    

                                ' . ucfirst($result) . '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        ';

        return $text;
    }

    public function tab_siswa($param, $tipe)
    {

        if ($tipe == 'Perempuan') {
            $data = Siswa::where('jenis_kelamin', 'perempuan')->get();
        } else {
            $data = Siswa::where('jenis_kelamin', 'laki-laki')->get();
        }

        $result = '';
        foreach ($data as $key => $value) {
            $result .= '
                <tr>
                    <td>' . $key + 1 . '</td>
                    <td>' . $value->nama_siswa . '</td>
                    <td>' . $value->kelas  . ' ' . $value->sub_kelas . '</td>
                    <td>' . $value->nis . '</td>
                </tr>';
        }

        if ($result == '') {
            $result = '
            <tr>
                <td colspan="100%" class="text-danger">
                    Data Tidak Tersedia
                </td>
            </tr>
            ';
        }

        $active = '';
        $activeP = '';
        if ($tipe == 'Perempuan') {
            $activeP = 'active';
        } else {
            $active = 'active';
        }


        $text = '
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link ' . $active . ' tab_detail" data-id="laki-laki" id="first-tab" data-bs-toggle="tab" data-bs-target="#first-tab-pane"
                        type="button" role="tab" aria-controls="first-tab-pane" aria-selected="true">
                        Siswa Laki-Laki</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link ' . $activeP . ' tab_detail" data-id="perempuan" id="second-tab" data-bs-toggle="tab" data-bs-target="#second-tab-pane"
                        type="button" role="tab" aria-controls="second-tab-pane" aria-selected="false"> Siswa
                        Perempuan</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="first-tab-pane" role="tabpanel" aria-labelledby="first-tab" tabindex="0">
                    <div class="table-responsive">
                        <input type="hidden" id="id_tipe" value="' . $param . '">  
                        <table class="table text-center table-striped mt-3 ">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <td>#</td>
                                    <td>Nama Siswa</td>
                                    <td>Kelas</td>
                                    <td>Nis</td>
                                </tr>
                            </thead>
                            <tbody class="text-capitalize">
                                ' . ucwords($result) . '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        ';

        return $text;
    }

    public function tabGuru_siswa($param, $tipe)
    {
        $id_guru = userLogin()->id_guru;

        if ($tipe == 'Perempuan') {
            $data = Siswa::join('kelas', 'siswas.kelas', '=', 'kelas.kelas')
                ->where('kelas.id_guru', $id_guru)
                ->where('siswas.jenis_kelamin', 'perempuan')
                ->select('siswas.*')
                ->get();
        } else {
            $data = Siswa::join('kelas', 'siswas.kelas', '=', 'kelas.kelas')
                ->where('kelas.id_guru', $id_guru)
                ->where('siswas.jenis_kelamin', 'laki-laki')
                ->select('siswas.*')
                ->get();
        }

        $result = '';
        foreach ($data as $key => $value) {
            $result .= '
                <tr>
                    <td>' . $key + 1 . '</td>
                    <td>' . $value->nama_siswa . '</td>
                    <td>' . $value->kelas  . ' ' . $value->sub_kelas . '</td>
                    <td>' . $value->nis . '</td>
                </tr>';
        }

        if ($result == '') {
            $result = '
            <tr>
                <td colspan="100%" class="text-danger">
                    Data Tidak Tersedia
                </td>
            </tr>
            ';
        }

        $active = '';
        $activeP = '';
        if ($tipe == 'Perempuan') {
            $activeP = 'active';
        } else {
            $active = 'active';
        }

        $text = '
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link ' . $active . ' tab_detail" data-id="laki-laki" id="first-tab" data-bs-toggle="tab" data-bs-target="#first-tab-pane"
                        type="button" role="tab" aria-controls="first-tab-pane" aria-selected="true">
                        Siswa Laki-Laki</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link ' . $activeP . ' tab_detail" data-id="perempuan" id="second-tab" data-bs-toggle="tab" data-bs-target="#second-tab-pane"
                        type="button" role="tab" aria-controls="second-tab-pane" aria-selected="false"> Siswa
                        Perempuan</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="first-tab-pane" role="tabpanel" aria-labelledby="first-tab" tabindex="0">
                    <div class="table-responsive">
                        <input type="hidden" id="id_tipe" value="' . $param . '">  
                        <table class="table text-center table-striped mt-3 ">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <td>#</td>
                                    <td>Nama Siswa</td>
                                    <td>Kelas</td>
                                    <td>Nis</td>
                                </tr>
                            </thead>
                            <tbody class="text-capitalize">
                                ' . ucwords($result) . '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        ';

        return $text;
    }

    public function tab_kelas($param, $tipe)
    {
        $data = DB::table('kelas')
            ->join('gurus', 'kelas.id_guru', '=', 'gurus.id')
            ->groupBy('kelas.kelas', 'kelas.sub_kelas')
            ->select('kelas.kelas', 'kelas.sub_kelas', 'kelas.biaya_spp', 'gurus.nama_guru')
            ->get();

        $result = '';
        foreach ($data as $key => $value) {
            $result .= '
                <tr>
                    <td>' . $key + 1 . '</td>
                    <td>' . $value->kelas  . ' ' . $value->sub_kelas . '</td>
                    <td>' . $value->nama_guru . '</td>
                    <td>' . 'Rp. ' . rupiah($value->biaya_spp) . '</td>
                </tr>';
        }

        if ($result == '') {
            $result = '
            <tr>
                <td colspan="100%" class="text-danger">
                    Data Tidak Tersedia
                </td>
            </tr>';
        }


        $text = '
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-id="laki-laki" id="first-tab" data-bs-toggle="tab" data-bs-target="#first-tab-pane"
                        type="button" role="tab" aria-controls="first-tab-pane" aria-selected="true">List Kelas</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="first-tab-pane" role="tabpanel" aria-labelledby="first-tab" tabindex="0">
                    <div class="table-responsive">
                        <table class="table text-center table-striped mt-3">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <td>#</td>
                                    <td>Kelas</td>
                                    <td>Wali Kelas</td>
                                    <td>Biaya Spp</td>
                                </tr>
                            </thead>
                            <tbody class="text-capitalize">
                                ' . ucwords($result) . '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        ';

        return $text;
    }

    public function tabGuru_kelas($param, $tipe)
    {
        $id_guru = userLogin()->id_guru;

        $data = Kelas::join('gurus', 'kelas.id_guru', '=', 'gurus.id')
            ->groupBy('kelas.kelas', 'kelas.sub_kelas')
            ->where('kelas.id_guru', $id_guru)
            ->select('kelas.kelas', 'kelas.sub_kelas', 'kelas.biaya_spp', 'gurus.nama_guru')->get();

        $result = '';
        foreach ($data as $key => $value) {
            $result .= '
                <tr>
                    <td>' . $key + 1 . '</td>
                    <td>' . $value->kelas  . ' ' . $value->sub_kelas . '</td>
                    <td>' . $value->nama_guru . '</td>
                    <td>' . 'Rp. ' . rupiah($value->biaya_spp) . '</td>
                </tr>';
        }

        if ($result == '') {
            $result = '
            <tr>
                <td colspan="100%" class="text-danger">
                    Data Tidak Tersedia
                </td>
            </tr>';
        }


        $text = '
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" data-id="laki-laki" id="first-tab" data-bs-toggle="tab" data-bs-target="#first-tab-pane"
                        type="button" role="tab" aria-controls="first-tab-pane" aria-selected="true">List Kelas</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="first-tab-pane" role="tabpanel" aria-labelledby="first-tab" tabindex="0">
                    <div class="table-responsive">
                        <table class="table text-center table-striped mt-3">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <td>#</td>
                                    <td>Kelas</td>
                                    <td>Wali Kelas</td>
                                    <td>Biaya Spp</td>
                                </tr>
                            </thead>
                            <tbody class="text-capitalize">
                                ' . ucwords($result) . '
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        ';

        return $text;
    }
}
