<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekruitment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


    public function printPDF()
    {
        $rekruitment = Rekruitment::where('proses', '=', '0')->get();
        $rekruitments = $rekruitment->toArray();

        return $rekruitments;
    }
}