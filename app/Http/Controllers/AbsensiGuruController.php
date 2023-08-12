<?php

namespace App\Http\Controllers;

use App\Models\AbsensiGuru;
use Illuminate\Http\Request;

class AbsensiGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $absensiGuru = new AbsensiGuru();
        $insert = $absensiGuru->insert($request);

        if ($insert) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AbsensiGuru  $absensiGuru
     * @return \Illuminate\Http\Response
     */
    public function show(AbsensiGuru $absensiGuru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AbsensiGuru  $absensiGuru
     * @return \Illuminate\Http\Response
     */
    public function edit(AbsensiGuru $absensiGuru)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AbsensiGuru  $absensiGuru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AbsensiGuru $absensiGuru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AbsensiGuru  $absensiGuru
     * @return \Illuminate\Http\Response
     */
    public function destroy(AbsensiGuru $absensiGuru)
    {
        //
    }
}
