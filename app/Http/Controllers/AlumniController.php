<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Alumni';
        $alumni = Alumni::orderByDesc('id')->paginate(10);

        return view('backend.alumni', compact(['title', 'alumni']));
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
        $request->validate([
            'nama_siswa' => 'required|max:255',
            'text' => 'required',
            'angkatan_awal' => 'required|numeric',
            'angkatan_akhir' => 'required|numeric',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);


        $images = $request->file('image');
        $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();
        // resize image 
        $canvas = Image::canvas(1024, 1024);
        $image  = Image::make($images->getRealPath())->resize(1024, 1024, function ($constraint) {
            $constraint->aspectRatio();
        });
        $canvas->insert($image, 'center');
        $canvas->save('images\upload' . '/' . $imageName);

        $insert = Alumni::create([
            'nama_siswa' => $request->nama_siswa,
            'text' => $request->text,
            'angkatan_awal' => $request->angkatan_awal,
            'angkatan_akhir' => $request->angkatan_akhir,
            'image' => 'images\upload' . '/' . $imageName,
            'user' => Auth::id(),
        ]);

        if ($insert) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function show(Alumni $alumni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumni $alumni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumni $alumni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alumni $alumni)
    {
        //
    }
}
