<?php

namespace App\Http\Controllers;

use App\Models\Introduction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;





class IntroductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hakAksesController();

        $title = 'Kata Pengantar';
        $introduction = Introduction::first();

        return view('backend.introduction', compact('title', 'introduction'));
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
            'text' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);

        $cek_row = Introduction::first();

        if ($request->hasFile('image')) {
            $images = $request->file('image');
            $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();
            // resize image 
            $canvas = Image::canvas(1024, 1024);
            $image  = Image::make($images->getRealPath())->resize(1024, 1024, function ($constraint) {
                $constraint->aspectRatio();
            });
            $canvas->insert($image, 'center');
            $canvas->save('images\upload' . '/' . $imageName);

            $data = [
                'text' => $request->text,
                'image' => '\images/upload/' . $imageName,
                "user" => Auth::id(),
            ];


            if (empty($cek_row)) {
                $insert = Introduction::create($data);
            } else {
                $insert = Introduction::where('id', $cek_row->id)->update($data);
            }
        } else {
            $insert = Introduction::where('id', $cek_row->id)->update([
                'text' => $request->text,
                "user" => Auth::id(),
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
     * @param  \App\Models\Introduction  $introduction
     * @return \Illuminate\Http\Response
     */
    public function show(Introduction $introduction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Introduction  $introduction
     * @return \Illuminate\Http\Response
     */
    public function edit(Introduction $introduction)
    {
        $data = Introduction::find($introduction->id);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Introduction  $introduction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Introduction $introduction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Introduction  $introduction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Introduction $introduction)
    {
        $file_path = public_path() .  $introduction->image;
        unlink($file_path);


        $delete = Introduction::destroy($introduction->id);

        if ($delete) {
            return back()->with('success', 'Success! file deleted');
        } else {
            return back()->with('failed', 'Alert! file not deleted');
        }
    }
}
