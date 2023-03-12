<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hakAksesController();

        $title = 'About Us';
        $about = About::orderByDesc('id')->paginate(20);

        return view('backend.about', compact(['about', 'title']));
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
            'slug' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'text' => 'required',
            'judul' => 'required',

        ]);

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

            $insert = About::create([
                'judul' => $request->judul,
                'slug' => $request->slug,
                'text' => $request->text,
                'image' => '\images/upload/' . $imageName,
                'user'  => Auth::id(),
            ]);
        } else {
            $insert = About::create([
                'slug' => $request->slug,
                'text' => $request->text,
                'user'  => Auth::id(),
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
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        $data = About::where('id', $about->id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        $request->validate([
            'image' => 'mimes:png,jpg, jpeg|max:2048',
            'text' => 'required',
            'slug' => 'required',
            'judul' => 'required',
        ]);

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

            $imageName = '\images/upload/' . $imageName;
        } else {
            $imageName = $about->image;
        }

        $update = About::where('id', $request->id)
            ->update([
                'slug' => $request->slug,
                'text' => $request->text,
                'image' => $imageName,
                'user'  => Auth::id(),
                'judul' => $request->judul,
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
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        $image = $about->image;

        if ($image) {
            $file_path = public_path() .  $about->image;
            unlink($file_path);
        }

        $delete = About::destroy($about->id);

        if ($delete) {
            return back()->with('success', 'Success! Data successfuly deleted');
        } else {
            return back()->with('failed', 'Alert! Data failed to deleted');
        }
    }

    public function remove($id)
    {
        $about = About::where('id', $id)->update([
            'image' => NULL
        ]);

        $tbl_about = About::where('id', $id)->first();
        $image = $tbl_about->image;
        if ($image) {
            $file_path = public_path() .  $about->image;
            unlink($file_path);
        }

        return back()->with('success', 'Success! Data successfuly deleted');
    }
}
