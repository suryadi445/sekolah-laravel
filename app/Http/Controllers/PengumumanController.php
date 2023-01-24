<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;


class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Notice::latest()->paginate(20);


        return view('frontend.pengumuman', compact('pengumuman'));
    }
}