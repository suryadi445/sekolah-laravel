<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CareerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Karir';
        $career = Career::latest()->paginate(20);

        return view('backend.career', compact(['title', 'career']));
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
            'judul' => 'required',
            'jabatan' => 'required',
            'persyaratan' => 'required',
            'deadline' => 'required',
        ]);



        $insert = Career::create([
            'judul' => $request->judul,
            'jabatan' => $request->jabatan,
            'persyaratan' => $request->persyaratan,
            'deadline' => $request->deadline,
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
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function show(Career $career)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function edit(Career $career)
    {
        $data = Career::find($career->id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Career $career)
    {
        $request->validate([
            'judul' => 'required',
            'jabatan' => 'required',
            'persyaratan' => 'required',
            'deadline' => 'required',
        ]);

        $update = Career::where('id', $request->id)
            ->update([
                'judul' => $request->judul,
                'jabatan' => $request->jabatan,
                'persyaratan' => $request->persyaratan,
                'deadline' => $request->deadline,
            ]);

        if ($update) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Career  $career
     * @return \Illuminate\Http\Response
     */
    public function destroy(Career $career)
    {
        $delete = Career::destroy($career->id);

        if ($delete) {
            return back()->with('success', 'Success! Data deleted successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed deleted');
        }
    }
}