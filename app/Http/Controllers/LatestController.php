<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LatestNews;


class LatestController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        if ($tahun != 'all') {
            if ($bulan != 'all') {
                $latestNews = LatestNews::whereYear('updated_at', $tahun)
                    ->whereMonth('updated_at', $bulan)
                    ->paginate(12)
                    ->appends(request()->query());
            } else {
                $latestNews = LatestNews::whereYear('updated_at', $tahun)
                    ->paginate(12)
                    ->appends(request()->query());
            }
        } else if ($bulan != 'all') {
            if ($tahun != 'all') {
                $latestNews = LatestNews::whereYear('updated_at', $tahun)
                    ->whereMonth('updated_at', $bulan)
                    ->paginate(12)
                    ->appends(request()->query());
            } else {
                $latestNews = LatestNews::whereMonth('updated_at', $bulan)
                    ->paginate(12)
                    ->appends(request()->query());
            }
        } else {
            $latestNews = LatestNews::orderByDesc('updated_at')->paginate(12)
                ->appends(request()->query());
        }


        return view('frontend.latest', compact(['latestNews', 'tahun', 'bulan']));
    }
}