<?php

use App\Models\Settings;
use App\Models\User;
use App\Models\Siswa;
use Carbon\Carbon;

/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('rupiah')) {
    function rupiah($number)
    {
        return number_format($number, 0, ',', '.');
    }
}

if (!function_exists('tanggal_indo')) {
    function tanggal_indo($date)
    {
        return Carbon::parse($date)->translatedFormat('l, d F Y');
    }
}

if (!function_exists('bulan')) {
    function bulan($month)
    {
        return Carbon::parse($month)->translatedFormat('F');
    }
}

if (!function_exists('bulanToNomor')) {
    function bulanToNomor($bulan)
    {
        switch ($bulan) {
            case "Januari":
                $bulan = "01";
                break;
            case "Februari":
                $bulan = "02";
                break;
            case "Maret":
                $bulan = "03";
                break;
            case "April":
                $bulan = "04";
                break;
            case "Mei":
                $bulan = "05";
                break;
            case "Juni":
                $bulan = "06";
                break;
            case "Juli":
                $bulan = "07";
                break;
            case "Agustus":
                $bulan = "08";
                break;
            case "September":
                $bulan = "09";
                break;
            case "Oktober":
                $bulan = "10";
                break;
            case "November":
                $bulan = "11";
                break;
            case "Desember":
                $bulan = "12";
                break;
            default:
                $bulan = "";
        }

        return $bulan;
    }
}

/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('convertMdyToYmd')) {
    function convertMdyToYmd($date)
    {
        return Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
    }
}

if (!function_exists('getUser')) {
    function getUser($id_user)
    {
        return User::where('id', $id_user)->first() ?? '';
    }
}

if (!function_exists('getUmur')) {
    function getUmur($tanggal)
    {
        return Carbon::parse($tanggal)->diff(\Carbon\Carbon::now())->format('%y Tahun, %m bulan');
    }
}

if (!function_exists('getWali')) {
    function getWali($id_siswa)
    {
        $data = Siswa::where('id', $id_siswa)->first() ?? '';

        if ($data->nama_ayah) {

            $result = $data->nama_ayah;
        } else if ($data->nama_ibu) {
            $result = $data->nama_ayah;
        } else {
            $result = $data->nama_wali;
        }

        return $result;
    }
}

if (!function_exists('arrayKelas')) {
    function arrayKelas()
    {
        $tipe_sekolah = Settings::first()->tipe_sekolah;
        if ($tipe_sekolah == 'Pra Sekolah') {
            $result = [
                '0'
            ];
        } elseif ($tipe_sekolah == 'SD') {
            $result = [
                'I',
                'II',
                'III',
                'IV',
                'V',
                'VI',
            ];
        } elseif ($tipe_sekolah == 'SMP') {
            $result = [
                'VII',
                'VIII',
                'IX',
            ];
        } elseif ($tipe_sekolah == 'SMA') {
            $result = [
                'X',
                'XI',
                'XII',
            ];
        }

        return $result;
    }
}

if (!function_exists('userLogin')) {
    function userLogin()
    {
        return auth()->user();
    }
}
