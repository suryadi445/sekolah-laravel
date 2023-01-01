<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LatestNews;


class LatestController extends Controller
{
    public function index()
    {
        $latestNews = LatestNews::orderByDesc('updated_at')->paginate(12);

        return view('frontend.latest', compact(['latestNews']));
    }
}