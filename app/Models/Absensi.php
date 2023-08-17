<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Absensi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function printPDF($kelas = null, $tgl_absensi = null, $id_mapel = null, $ajaran_awal = null, $ajaran_akhir = null)
    {
        $id_userGuru = auth()->user()->id;

        $absensi = Absensi::join('siswas', 'absensis.id_siswa', '=', 'siswas.id')
            ->join('mapels', 'absensis.id_mapel', '=', 'mapels.id')
            ->select('absensis.*', 'siswas.nama_siswa', 'mapels.mata_pelajaran')
            ->where('absensis.user', $id_userGuru)
            ->where('absensis.tahun_ajaran_awal', $ajaran_awal)
            ->where('absensis.tahun_ajaran_akhir', $ajaran_akhir)
            ->orderBy('absensis.tgl_absensi')
            ->orderBy('siswas.nama_siswa');

        if (!empty($kelas)) {
            $absensi->where('absensis.kelas', $kelas);
        }

        if (!empty($id_mapel)) {
            $absensi->where('absensis.id_mapel', $id_mapel);
        }

        if (!empty($tgl_absensi)) {
            $absensi->where('absensis.tgl_absensi', $tgl_absensi);
        }

        $absensi = $absensi->get();
        $absensis = $absensi->toArray();

        return $absensis;
    }

    public function printListPDF($kelas = null, $daftar_tanggal = null, $id_mapel = null, $ajaran_awal = null, $ajaran_akhir = null)
    {
        $id_userGuru = auth()->user()->id;

        $absensi = DB::table('absensis AS t1')
            ->leftJoin(DB::raw("(select id from absensis where absensi = 'yes') as t2"), 't1.id', '=', 't2.id')
            ->leftJoin(DB::raw("(select id from absensis where absensi = 'no') as t3"), 't1.id', '=', 't3.id')
            ->leftJoin(DB::raw("(select id from absensis where keterangan = 'Sakit') as t4"), 't1.id', '=', 't4.id')
            ->leftJoin(DB::raw("(select id from absensis where keterangan = 'Alpha') as t5"), 't1.id', '=', 't5.id')
            ->leftJoin(DB::raw("(select id from absensis where keterangan = 'Izin') as t6"), 't1.id', '=', 't6.id')
            ->leftJoin(DB::raw("(select id from absensis where keterangan IS NULL AND absensi = 'no') as t7"), 't1.id', '=', 't7.id')
            ->join('siswas', 't1.id_siswa', '=', 'siswas.id')
            ->select(DB::raw('siswas.nama_siswa, t1.kelas, count(t2.id) as jumlahMasuk, count(t3.id) as jumlahGaMasuk, count(t4.id) as jumlahSakit, count(t6.id) as jumlahIzin, count(t5.id) as jumlahAlpha, count(t7.id) as tanpaKeterangan'))
            ->where('t1.user', $id_userGuru)
            ->where('t1.tahun_ajaran_awal', $ajaran_awal)
            ->where('t1.tahun_ajaran_akhir', $ajaran_akhir)
            ->groupByRaw("t1.id_siswa")
            ->orderBy('siswas.nama_siswa');

        if (!empty($kelas)) {
            $absensi->where('t1.kelas', $kelas);
        }

        if (!empty($id_mapel)) {
            $absensi->where('t1.id_mapel', $id_mapel);
        }

        if (!empty($daftar_tanggal)) {
            $absensi->where('t1.tgl_absensi', $daftar_tanggal);
        }

        $absensi = $absensi->get();

        $absensis = [];
        foreach ($absensi as $value) {
            $absensis[] = (array)$value;
        }

        return $absensis;
    }

    public function getKelas($id_guru)
    {
        $kelas = Kelas::select('kelas', 'sub_kelas')->where('id_guru', $id_guru)->get();

        return $kelas;
    }

    public function absensi($id_guru, $paramKelas)
    {
        $kelas = Kelas::select('kelas', 'sub_kelas')->where('id_guru', $id_guru)->get();
        // query ubtuk absensi siswa
        if ($paramKelas) {
            $string = urldecode($paramKelas);
            $array = explode(" ", $string);
            $class = $array[0];
            $subClass = $array[1];
        }
        $murid = Siswa::orderByRaw('kelas asc, sub_kelas asc, nama_siswa asc');
        if ($paramKelas) {
            $murid->where('kelas', $class);
            $murid->where('sub_kelas', $subClass);
        }
        $murid = $murid->get();

        $siswa = [];
        foreach ($murid as $value) {
            $kelasSiswa = $value->kelas;
            $subKelasSiswa = $value->sub_kelas;
            foreach ($kelas as  $val) {
                $kelasKelas = $val->kelas;
                $subKelasKelas = $val->sub_kelas;
                if ($kelasSiswa == $kelasKelas && $subKelasKelas == $subKelasSiswa) {
                    $siswa[] = $value;
                }
            }
        }

        return $siswa;
    }

    public function daftarAbsensi($tanggal, $mapel, $kls)
    {
        $absensi = Absensi::join('siswas', 'absensis.id_siswa', '=', 'siswas.id');
        // filter mata pelajaran 
        if (!empty($mapel)) {
            $absensi->where('absensis.id_mapel', $mapel);
        }
        // filter kelas 
        if (!empty($kls)) {
            $absensi->where('absensis.kelas', $kls);
        }
        // filter tanggal
        if (empty($tanggal)) {
            $absensi->where('tgl_absensi', date('Y-m-d'));
        } else {
            $absensi->where('tgl_absensi', $tanggal);
        }
        $absensi->select('absensis.*', 'siswas.nama_siswa', 'siswas.jenis_kelamin', 'siswas.nis');
        $absensi->orderByRaw('absensis.tgl_absensi, siswas.nama_siswa')->get();
        $absensis = $absensi->get();

        return $absensis;
    }

    public function cekAbsensi()
    {
        $cek_absensi = Absensi::where('tgl_absensi', date('Y-m-d'))->groupBy('id_mapel')->orderByDesc('id')->first();

        return $cek_absensi;
    }

    public function mapel()
    {
        return Mapel::orderBy('mata_pelajaran')->get();
    }

    public function absensiToday($id_mapel, $kelas)
    {
        return  Absensi::where('tgl_absensi', date('Y-m-d'))->where('id_mapel', $id_mapel)->where('kelas', $kelas)->orderByDesc('id')->first();
    }
}
