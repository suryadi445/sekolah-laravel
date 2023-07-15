<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Promoted;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Exception;
use App\Exports\promotedExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;


class customException extends Exception
{
    public function error_message()
    {
        //defining the error message
        $error_msg = 'Error caught on line ' . $this->getLine() . ' in ' . $this->getFile()
            . ': <b>' . $this->getMessage() . '</b> is no valid E-Mail address';
        return $error_msg;
    }
}




class PromotedController extends Controller
{
    public function index(Request $request)
    {

        $title = 'Naik Kelas Siswa';
        $ajaran_awal = getTahunAjaran()->thn_ajaran_awal;
        $ajaran_akhir = getTahunAjaran()->thn_ajaran_akhir;
        $paramKelas = request('kelas');
        $paramSubKelas = request('subKelas');


        $subKelas = Kelas::select('sub_kelas')->groupBy('sub_kelas')->get();
        $kelas = Kelas::join('gurus', 'kelas.id_guru', '=', 'gurus.id')
            ->select('kelas.*', 'gurus.nama_guru');
        if ($paramKelas) {
            $kelas->where('kelas', $paramKelas);
        }
        if ($paramKelas) {
            $kelas->where('sub_kelas', $paramSubKelas);
        }
        $kelas = $kelas->get();

        $cekNaikKelas = [];
        foreach ($kelas as $key => $value) {
            $cekNaikKelas = Promoted::where('thn_ajaran_awal', $ajaran_awal)
                ->where('thn_ajaran_akhir', $ajaran_akhir)
                ->where('kelas_awal', $value->kelas)
                ->where('sub_kelas_awal', $value->sub_kelas)
                ->first();
        }

        return view('backend.promoted', compact(['title', 'kelas', 'cekNaikKelas', 'subKelas']));
    }

    public function show($kelas, $sub_kelas)
    {
        $title = "Kelas $kelas $sub_kelas";
        $ajaran_awal = getTahunAjaran()->thn_ajaran_awal;
        $ajaran_akhir = getTahunAjaran()->thn_ajaran_akhir;

        // $siswas = Siswa::where('kelas', $kelas)->where('sub_kelas', $sub_kelas)->orderBy('nama_siswa')->get();

        $siswas = Siswa::leftJoin('promoteds', 'siswas.id', '=', 'promoteds.id_siswa')
            ->select('siswas.*', 'promoteds.status', 'promoteds.id as id_promoted')
            ->where('siswas.kelas', $kelas)
            ->where('siswas.sub_kelas', $sub_kelas)
            ->orderBy('siswas.nama_siswa')->get();

        $cekNaikKelas = [];
        foreach ($siswas as $key => $value) {
            $cekNaikKelas = Promoted::where('thn_ajaran_awal', $ajaran_awal)
                ->where('thn_ajaran_akhir', $ajaran_akhir)
                ->where('kelas_awal', $value->kelas)
                ->where('sub_kelas_awal', $value->sub_kelas)
                ->first();
        }

        return view('backend.promotedDetail', compact(['title', 'siswas', 'cekNaikKelas']));
    }

    public function store(Request $request)
    {
        $id_siswa = $_POST['id_siswa'];
        $status_siswa = $_POST['status'];
        $kelas = $_POST['kelas'];
        $sub_kelas = $_POST['sub_kelas'];
        $ajaran_awal = getTahunAjaran()->thn_ajaran_awal;
        $ajaran_akhir = getTahunAjaran()->thn_ajaran_akhir;

        $row = '';
        foreach (arrayKelas() as $key => $value) {

            if ($kelas == $value) {
                $row = $key + 1;
            }
        }

        try {
            DB::beginTransaction();

            $key = 1;
            foreach ($status_siswa as $key => $data) {
                $idSiswa = $id_siswa[$key];

                $kelasAwal = arrayKelas()[$row - 1];
                $naikKelas = arrayKelas()[$row];

                if ($data == 'yes') {

                    $dataUpdate = [
                        'kelas' => $naikKelas
                    ];
                } else {

                    $dataUpdate = [
                        'kelas' => $kelasAwal
                    ];

                    $naikKelas = $kelasAwal;
                }

                DB::table('siswas')->where('id', $idSiswa)->update($dataUpdate);

                Promoted::create([
                    'id_siswa' => $idSiswa,
                    'status' => $data,
                    'kelas_awal' => $kelasAwal,
                    'sub_kelas_awal' => $sub_kelas,
                    'naik_kelas' => $naikKelas,
                    'thn_ajaran_awal' => $ajaran_awal,
                    'thn_ajaran_akhir' => $ajaran_akhir,
                    'user' => Auth::id(),
                ]);
            }


            DB::commit();

            return Redirect::to('/promoted')->with('success', 'Success! Data saved successfully');
        } catch (customException $e) {
            DB::rollBack();
            $pesanKesalahan = $e->getMessage();

            // echo $pesanKesalahan;
            return Redirect::to('/promoted')->with('success', "$pesanKesalahan");
        }
    }

    public function edit($kelas, $sub_kelas)
    {
        $title = "Kelas $kelas $sub_kelas";
        $ajaran_awal = getTahunAjaran()->thn_ajaran_awal;
        $ajaran_akhir = getTahunAjaran()->thn_ajaran_akhir;

        $siswas = Promoted::join('siswas', 'promoteds.id_siswa', '=', 'siswas.id')
            ->select('siswas.*', 'promoteds.status', 'promoteds.id as id_promoted')
            ->where('promoteds.kelas_awal', $kelas)
            ->where('promoteds.sub_kelas_awal', $sub_kelas)
            ->where('promoteds.thn_ajaran_awal', $ajaran_awal)
            ->where('promoteds.thn_ajaran_akhir', $ajaran_akhir)
            ->orderBy('siswas.nama_siswa')->get();

        return view('backend.promotedEdit', compact(['title', 'siswas']));
    }

    public function update(Request $request)
    {
        $id_promoted = $_POST['id_promoted'];
        $id_siswa = $_POST['id_siswa'];
        $status_siswa = $_POST['status'];
        $kelas = $_POST['kelas'];
        $sub_kelas = $_POST['sub_kelas'];
        $ajaran_awal = getTahunAjaran()->thn_ajaran_awal;
        $ajaran_akhir = getTahunAjaran()->thn_ajaran_akhir;

        // dd($_POST['status']);

        $row = '';
        foreach (arrayKelas() as $key => $value) {

            if ($kelas == $value) {
                $row = $key + 1;
            }
        }


        try {
            DB::beginTransaction();

            $key = 1;
            foreach ($status_siswa as $key => $data) {
                $idSiswa = $id_siswa[$key];

                $kelasAwal = arrayKelas()[$row - 1];
                $naikKelas = arrayKelas()[$row];

                if ($data == 'yes') {
                    // jika naik kelas
                    $dataUpdate = [
                        'kelas' => $naikKelas
                    ];
                } else {
                    // jika tidak naik kelas
                    $dataUpdate = [
                        'kelas' => $kelasAwal
                    ];
                    // naik kelasnya pake kelas awal karena tidak naik kelas
                    $naikKelas = $kelasAwal;
                }

                DB::table('siswas')->where('id', $idSiswa)->update($dataUpdate);

                Promoted::where('id', $id_promoted[$key])
                    ->update([
                        'id_siswa' => $idSiswa,
                        'status' => $data,
                        'kelas_awal' => $kelasAwal,
                        'sub_kelas_awal' => $sub_kelas,
                        'naik_kelas' => $naikKelas,
                        'thn_ajaran_awal' => $ajaran_awal,
                        'thn_ajaran_akhir' => $ajaran_akhir,
                        'user' => Auth::id(),
                    ]);
            }

            DB::commit();

            return Redirect::to('/promoted')->with('success', 'Success! Data saved successfully');
        } catch (customException $e) {
            DB::rollBack();
            $pesanKesalahan = $e->getMessage();

            // echo $pesanKesalahan;
            return Redirect::to('/promoted')->with('success', "$pesanKesalahan");
        }
    }

    public function exportExcel($kelas = null, $subKelas = null, $param = null)
    {
        $header = ['Nama Siswa', 'Jenis Kelamin', 'Tempat Lahir', 'Tanggal Lahir', 'Agama', 'NIS', 'NISN', 'Status'];

        return Excel::download(new PromotedExport($header, $kelas, $subKelas, $param), 'naik-kelas-' . $param . '.xlsx');
    }

    public function exportPdf($kelas = null, $subKelas = null, $param = null)
    {
        $object = new Promoted();
        $data = $object->printPDF($kelas, $subKelas, $param);
        $title = ucwords($param) . ' Naik Kelas';


        $pdf = PDF::loadview('pdf.promotedPdf', ['data' => $data, 'title' => $title]);
        return $pdf->stream('promoted.pdf');
        // return $pdf->download('Siswa.pdf');
    }
}
