<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index()
    {
        return view('frontend.pendaftaran');
    }
}
