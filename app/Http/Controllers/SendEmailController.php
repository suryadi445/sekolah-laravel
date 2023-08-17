<?php

namespace App\Http\Controllers;

use App\Mail\EmailAbsensi;
use App\Models\Siswa;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{

    public function kirim()
    {
        $model_siswa = new Siswa;

        $data = $model_siswa->getSiswaAbsensi();

        Mail::to('suryadi.hhb@gmail.com')->send(new EmailAbsensi($data));

        return "Email telah dikirim!";
    }
}
