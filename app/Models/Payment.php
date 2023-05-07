<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function printPDF()
    {
        $payment = Payment::all();
        $payments = $payment->toArray();

        return $payments;
    }
}
