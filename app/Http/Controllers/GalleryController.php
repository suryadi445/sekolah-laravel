<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;



class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title = 'Gallery';
        $gallery = Gallery::latest()->paginate(20);

        return view('backend.gallery', compact(['title', 'gallery']));
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
            'image' => 'required',
            'image.*' => 'mimes:jpg,png,jpeg|max:2048'
        ]);

        $files = [];
        $insert = [];

        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $file) {
                $imageName = time() . $file->getClientOriginalName() . '.' . $file->extension();


                $imageResize = Image::make($file);
                $imageResize->orientate()
                    ->fit(600, 600, function ($constraint) {
                        $constraint->upsize();
                        $constraint->aspectRatio();
                    })
                    ->save('images\upload' . '/' . $imageName);


                if ($imageResize) {
                    $files[] = $imageName;
                    $insert = Gallery::create([
                        "image" => '\images/upload/' . $imageName,
                        "user" => Auth::id(),
                    ]);
                }
            }
        }

        if ($insert) {
            return back()->with('success', 'Success! file uploaded');
        } else {
            return back()->with('failed', 'Alert! file not uploaded');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $data = Gallery::find($gallery->id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'image' => 'required',
            'image.*' => 'mimes:jpg,png,jpeg|max:2048'
        ]);

        $file = $request->file('image');

        if ($request->hasfile('image')) {
            $imageName = time() . $file->getClientOriginalName() . '.' . $file->extension();


            $imageResize = Image::make($file);
            $imageResize->orientate()
                ->fit(600, 600, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })
                ->save('images\upload' . '/' . $imageName);

            if ($imageResize) {
                $update = Gallery::where('id', $gallery->id)
                    ->update([
                        'image' => '\images/upload/' . $imageName,
                        "user" => Auth::id(),
                    ]);
            }
        }

        if ($update) {
            return back()->with('success', 'Success! file uploaded');
        } else {
            return back()->with('failed', 'Alert! file not uploaded');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $file_path = public_path() .  $gallery->image;
        unlink($file_path);


        $delete = Gallery::destroy($gallery->id);

        if ($delete) {
            return back()->with('success', 'Success! file deleted');
        } else {
            return back()->with('failed', 'Alert! file not deleted');
        }
    }
}
