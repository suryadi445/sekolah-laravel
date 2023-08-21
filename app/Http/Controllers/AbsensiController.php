<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;
use App\Jobs\EmailAbsensiHarian;
use Barryvdh\DomPDF\Facade\Pdf;


class AbsensiController extends Controller
{
    protected $model;

    public function __construct(Absensi $modelAbsensi)
    {
        $this->model = $modelAbsensi;
    }

    public function index()
    {
        $id_guru = userLogin()->id_guru;
        $paramKelas = request('kelas');
        $tanggal = request('daftar_tanggal');
        $mapel = request('daftar_mapel');
        $kls = request('daftar_kelas');

        $kelas = $this->model->getKelas($id_guru);
        $siswa = $this->model->absensi($id_guru, $paramKelas);
        $absensis = $this->model->daftarAbsensi($tanggal, $mapel, $kls);
        $cek_absensi = $this->model->cekAbsensi();
        $getMapel = $this->model->mapel();

        // meghitung jumlah siswa yg absen
        $masuk = 0;
        $izin = 0;
        $sakit = 0;
        $alpha = 0;
        foreach ($absensis as $value) {
            if ($value->absensi == 'yes') {
                $masuk += 1;
            }
            if ($value->keterangan == 'Izin') {
                $izin += 1;
            }
            if ($value->keterangan == 'Sakit') {
                $sakit += 1;
            }
            if ($value->keterangan == 'Alpha') {
                $alpha += 1;
            }
        }

        $data['title'] = 'Absensi Siswa';
        $data['cek_absensi'] = $cek_absensi;
        $data['siswa'] = $siswa;
        $data['kelas'] = $kelas;
        $data['absensi'] = $absensis;
        $data['jumlah_all'] = count($data['absensi']);
        $data['jumlah_siswa'] = ['masuk' => $masuk, 'izin' => $izin, 'sakit' => $sakit, 'alpha' => $alpha];
        $data['mapel'] = $getMapel;
        $data['ajaran_awal'] = getTahunAjaran()->thn_ajaran_awal;
        $data['ajaran_akhir'] = getTahunAjaran()->thn_ajaran_akhir;


        return view('backend.absensi', $data);
    }

    public function store(Request $request)
    {
        $id_mapel = $request->id_mapel;
        $kelas = $request->kelas;
        $ajaran_awal = getTahunAjaran()->thn_ajaran_awal;
        $ajaran_akhir = getTahunAjaran()->thn_ajaran_akhir;

        $cek_absensi = $this->model->absensiToday($id_mapel, $kelas);
        for ($i = 0; $i < count($request->id_siswa); $i++) {

            if ($cek_absensi) {

                // jika sudah absen akan terupdate
                $insert = Absensi::where('id_siswa', $request->id_siswa[$i])
                    ->where('id_mapel', $request->id_mapel)
                    ->where('tgl_absensi', $request->tgl_absensi)
                    ->where('kelas', $request->kelas)
                    ->update([
                        'id_siswa' => $request->id_siswa[$i],
                        'kelas' => $request->kelas,
                        'id_mapel' => $request->id_mapel,
                        'tgl_absensi' => $request->tgl_absensi,
                        'absensi' => $request->absensi[$i],
                        'keterangan' => $request->keterangan[$i],
                        'tahun_ajaran_awal' => $ajaran_awal,
                        'tahun_ajaran_akhir' => $ajaran_akhir,
                        'user' => Auth::id(),
                    ]);
            } else {
                // jika belum absen akan insert data baru
                $insert = Absensi::create([
                    'id_siswa' => $request->id_siswa[$i],
                    'kelas' => $request->kelas,
                    'id_mapel' => $request->id_mapel,
                    'tgl_absensi' => $request->tgl_absensi,
                    'absensi' => $request->absensi[$i],
                    'keterangan' => $request->keterangan[$i],
                    'tahun_ajaran_awal' => $ajaran_awal,
                    'tahun_ajaran_akhir' => $ajaran_akhir,
                    'user' => Auth::id(),
                ]);
            }
        }

        // kirim email melalui sistem queue
        EmailAbsensiHarian::dispatch($kelas, $id_mapel);


        if ($insert) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    public function update(Request $request, Absensi $absensi)
    {
        for ($i = 0; $i < count($request->id_siswa); $i++) {
            $update = Absensi::where('id', $request->id_absensi[$i])
                ->update([
                    'id_siswa' => $request->id_siswa[$i],
                    'kelas' => $request->kelas,
                    'id_mapel' => $request->id_mapel,
                    'tgl_absensi' => $request->tgl_absensi,
                    'absensi' => $request->absensi[$i],
                    'keterangan' => $request->keterangan[$i],
                    'user' => Auth::id(),
                ]);
        }

        if ($update) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    public function exportExcel()
    {
        $kelas = request('kelas');
        $tipe = request('tipe');

        $paramThnAjaranAwal = explode('-', request('thn_ajaran'))[0] ?? '';
        $paramThnAjaranAkhir = explode('-', request('thn_ajaran'))[1] ?? '';
        $thnAwalDefault = getTahunAjaran()->thn_ajaran_awal;
        $thnAkhirDefault = getTahunAjaran()->thn_ajaran_akhir;

        // menentukan parameter default
        $ajaran_awal = empty(request('thn_ajaran')) ? $thnAwalDefault : $paramThnAjaranAwal;
        $ajaran_akhir = empty(request('thn_ajaran')) ? $thnAkhirDefault : $paramThnAjaranAkhir;


        if ($tipe == 'absensi') {

            $daftar_mapel = request('id_mapel');
            $daftar_tanggal = request('tgl_absensi');

            $header = ['Kelas', 'Nama Siswa', 'Absensi', 'Keterangan', 'Tanggal Absensi',  'Mata Pelajaran', 'Tahun Ajaran Awal', 'Tahun Ajaran Akhir'];
        } else {

            $daftar_mapel = request('daftar_mapel');
            $daftar_tanggal = request('daftar_tanggal');

            $header = ['Nama Siswa', 'Kelas', 'Jumlah Masuk', 'Jumlah Tidak Masuk', 'Jumlah Sakit', 'Jumlah Izin', 'Jumlah Alpha', 'Tanpa Keterangan'];
        }

        return Excel::download(new AbsensiExport($header, $kelas, $tipe, $daftar_tanggal, $daftar_mapel, $ajaran_awal, $ajaran_akhir), 'absensi.xlsx');
    }

    public function exportPdf()
    {
        $kelas = request('kelas');
        $tipe = request('tipe');

        $paramThnAjaranAwal = explode('-', request('thn_ajaran'))[0] ?? '';
        $paramThnAjaranAkhir = explode('-', request('thn_ajaran'))[1] ?? '';
        $thnAwalDefault = getTahunAjaran()->thn_ajaran_awal;
        $thnAkhirDefault = getTahunAjaran()->thn_ajaran_akhir;

        // menentukan parameter default
        $ajaran_awal = empty(request('thn_ajaran')) ? $thnAwalDefault : $paramThnAjaranAwal;
        $ajaran_akhir = empty(request('thn_ajaran')) ? $thnAkhirDefault : $paramThnAjaranAkhir;
        $title = 'Daftar Absensi';

        if ($tipe == 'absensi') {
            $id_mapel = request('id_mapel');
            $tgl_absensi = request('tgl_absensi');

            $data = $this->model->printPDF($kelas, $tgl_absensi, $id_mapel, $ajaran_awal, $ajaran_akhir);

            $pdf = PDF::loadview('pdf.absensiPdf', ['data' => $data, 'title' => $title]);
        } else {
            $daftar_mapel = request('daftar_mapel');
            $daftar_tanggal = request('daftar_tanggal');

            $data = $this->model->printListPDF($kelas, $daftar_tanggal, $daftar_mapel, $ajaran_awal, $ajaran_akhir);

            $pdf = PDF::loadview('pdf.absensiListPdf', ['data' => $data, 'title' => $title]);
        }


        return $pdf->stream('absensi.pdf');
        // return $pdf->download('Siswa.pdf');
    }
}
