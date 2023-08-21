<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Spp;
use App\Mail\EmailSpp;
use Illuminate\Support\Facades\Mail;

class EmailSppBulanan implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $insert_id;
    public function __construct($insert_id)
    {
        $this->insert_id = $insert_id;
    }

    public function handle()
    {
        $model_spp = new Spp;
        $insert_id = $this->insert_id;

        $data = $model_spp->get_spp($insert_id);

        // foreach ($data as $key => $value) {
        $email = $data->email;

        Mail::to($email)->send(new EmailSpp($data));
        // }
    }
}
