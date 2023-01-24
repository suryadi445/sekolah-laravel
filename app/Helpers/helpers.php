<?php

use App\Models\User;
use Carbon\Carbon;

/**
 * Write code on Method
 *
 * @return response()
 */
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