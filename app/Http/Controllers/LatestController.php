<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LatestNews;


class LatestController extends Controller
{
    public function index()
    {
        $data['latestNews'] = LatestNews::orderByDesc('updated_at')->get();

        return view('frontend.latest', $data);
    }
}