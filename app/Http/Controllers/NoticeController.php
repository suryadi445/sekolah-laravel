<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Pengumuman';
        $notice = Notice::latest()->paginate(20);

        return view('backend.notice', compact(['title', 'notice']));
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
            'tanggal' => 'required',
            'judul'  => 'required|max:100',
            'text'  => 'required',
        ]);

        $insert = Notice::create([
            'tanggal' => $request->tanggal,
            'judul' => $request->judul,
            'text' => $request->text,
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
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        $data = Notice::find($notice->id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
        $request->validate([
            'tanggal' => 'required',
            'judul'  => 'required|max:100',
            'text'  => 'required',
        ]);

        $update = Notice::where('id', $notice->id)
            ->update([
                'tanggal' => $request->tanggal,
                'judul' => $request->judul,
                'text' => $request->text,
                'user' => Auth::id(),
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
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        $delete = Notice::destroy($notice->id);

        if ($delete) {
            return back()->with('success', 'Success! Data successfuly deleted');
        } else {
            return back()->with('failed', 'Alert! Data failed to deleted');
        }
    }
}
