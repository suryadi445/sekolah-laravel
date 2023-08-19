<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Siswa;
use App\Mail\EmailAbsensi;
use Illuminate\Support\Facades\Mail;


class EmailAbsensiHarian implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $kelas;
    public function __construct($kelas)
    {
        $this->kelas = $kelas;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $model_siswa = new Siswa;
        // $kelas = 1;
        $kelas = $this->kelas;


        $data = $model_siswa->getSiswaAbsensi($kelas);

        foreach ($data as $key => $value) {
            $email = $value->email;

            Mail::to($email)->send(new EmailAbsensi($data));
        }
    }
}
