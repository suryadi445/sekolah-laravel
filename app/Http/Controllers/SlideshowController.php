<?php

namespace App\Http\Controllers;

use App\Models\Slideshow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class SlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hakAksesController();

        $title = 'Slideshow';
        $slideshow = Slideshow::orderByDesc('id')->paginate(5);

        return view('backend.slideshow', compact(['title', 'slideshow']));
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
            foreach ($request->file('image') as $key => $file) {
                $images = $request->file('image');
                $imageName = time() . $file->getClientOriginalName() . '.' . $file->extension();
                $imageResize = Image::make($images[$key]);
                $imageResize->orientate()
                    ->fit(600, 360, function ($constraint) {
                        $constraint->upsize();
                        $constraint->aspectRatio();
                    })
                    ->save('images\upload' . '/' . $imageName);

                if ($imageName) {
                    $files[] = $imageName;
                    $insert = Slideshow::create([
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
     * @param  \App\Models\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function show(Slideshow $slideshow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function edit(Slideshow $slideshow)
    {
        $data = Slideshow::find($slideshow->id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slideshow $slideshow)
    {
        $request->validate([
            'image' => 'required',
            'image.*' => 'mimes:jpg,png,jpeg|max:2048'
        ]);

        $file = $request->file('image');

        if ($request->hasfile('image')) {
            $images = $request->file('image');
            $imageName = time() . $file->getClientOriginalName() . '.' . $file->extension();
            $imageResize = Image::make($images);
            $imageResize->orientate()
                ->fit(600, 360, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })
                ->save('images\upload' . '/' . $imageName);

            if ($imageName) {
                $update = Slideshow::where('id', $slideshow->id)
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
     * @param  \App\Models\Slideshow  $slideshow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slideshow $slideshow)
    {
        $file_path = public_path() .  $slideshow->image;
        unlink($file_path);


        $delete = Slideshow::destroy($slideshow->id);

        if ($delete) {
            return back()->with('success', 'Success! file deleted');
        } else {
            return back()->with('failed', 'Alert! file not deleted');
        }
    }
}
