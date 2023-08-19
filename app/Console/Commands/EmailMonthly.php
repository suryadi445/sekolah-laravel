<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Siswa;
use App\Mail\EmailAbsensiBulanan;


class EmailMonthly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'command:name';
    protected $signature = 'EmailMonthly';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // return Command::SUCCESS;

        $model_siswa = new Siswa;

        $data = $model_siswa->getSiswaAbsensi();

        foreach ($data as $key => $value) {
            $email = $value->email;

            Mail::to($email)->send(new EmailAbsensiBulanan($data));
        }


        // Tuliskan logika untuk mengirim email di sini
        $this->info('Emails sent successfully.');
    }
}
