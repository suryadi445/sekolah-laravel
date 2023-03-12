<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;



class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hakAksesController();

        $banners = Banner::orderByDesc('id')->paginate(10);
        $title = 'Banner';

        return view('backend.banner', compact(['banners', 'title']));
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
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'kategori' => 'required|unique:banners',
            'text' => 'required',
            'judul' => 'required',
        ]);

        if ($request->hasfile('image')) {
            $images = $request->file('image');
            $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();

            $images->move(public_path('images/upload/'), $imageName);

            $insert = Banner::create([
                'image' => '\images/upload/' . $imageName,
                'kategori' => $request->kategori,
                'judul' => $request->judul,
                'text' => $request->text,
                'user' => Auth::id(),
            ]);
        }

        if ($insert) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $data = Banner::where('id', $banner->id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'kategori' => ['required', Rule::unique('banners')->ignore($banner->id)], 'text' => 'required',
            'judul' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $images = $request->file('image');
            $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();

            $images->move(public_path('images/upload/'), $imageName);

            $file_path = public_path() .  $banner->image;
            unlink($file_path);

            $imageName = '\images/upload/' . $imageName;
        } else {
            $imageName = $banner->image;
        };

        $update = Banner::where('id', $banner->id)
            ->update([
                'image' =>  $imageName,
                'kategori' => $request->kategori,
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
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $file_path = public_path() .  $banner->image;
        unlink($file_path);

        $delete = Banner::destroy($banner->id);

        if ($delete) {
            return back()->with('success', 'Success! Data deleted successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed deleted');
        }
    }
}
