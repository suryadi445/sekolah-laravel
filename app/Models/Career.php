<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function printPDF()
    {
        $career = Career::where('deadline', '>=', date('Y-m-d'))->get();
        $careers = $career->toArray();

        return $careers;
    }
}
