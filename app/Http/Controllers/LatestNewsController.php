<?php

namespace App\Http\Controllers;

use App\Models\LatestNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;



class LatestNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Berita Terkini';
        $latestNews = LatestNews::orderByDesc('updated_at')->paginate(10);

        return view('backend.latestNews', compact(['title', 'latestNews']));
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
            'judul' => 'required|max:255',
            'text' => 'required',
            'image' => 'mimes:jpg,png,jpeg|max:2048',
        ]);


        $images = $request->file('image');
        $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();
        $imageResize = Image::make($images);
        $imageResize->orientate()
            ->fit(360, 360, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })
            ->save('images\upload' . '/' . $imageName);

        // insert to db
        $insert = LatestNews::create([
            'judul' => $request->judul,
            'text' => $request->text,
            'image' => '\images/upload/' . $imageName,
            "user" => Auth::id(),
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
     * @param  \App\Models\LatestNews  $latestNews
     * @return \Illuminate\Http\Response
     */
    public function show(LatestNews $latestNews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LatestNews  $latestNews
     * @return \Illuminate\Http\Response
     */
    public function edit(LatestNews $latestNews)
    {
        $data = LatestNews::where('id', $latestNews->id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LatestNews  $latestNews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LatestNews $latestNews)
    {
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|max:2048',
            'judul' => 'required|max:255',
            'text' => 'required',
        ]);

        $file = $request->file('image');
        if ($request->hasFile('image')) {

            $file_path = public_path() .  $latestNews->image;
            unlink($file_path);

            $images = $request->file('image');
            $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();
            $imageResize = Image::make($images);
            $imageResize->orientate()
                ->fit(360, 360, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })
                ->save('images\upload' . '/' . $imageName);

            $update_data = [
                'judul' => $request->judul,
                'text' => $request->text,
                'image' => '\images\upload/' . $imageName,
            ];
        } else {
            $update_data = [
                'judul' => $request->judul,
                'text' => $request->text,
                'image' => $latestNews->image,
            ];
        }

        $update = LatestNews::where('id', $request->id)
            ->update($update_data);


        if ($update) {
            return back()->with('success', 'Success! Data saved updated');
        } else {
            return back()->with('failed', 'Alert! Data failed to change');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LatestNews  $latestNews
     * @return \Illuminate\Http\Response
     */
    public function destroy(LatestNews $latestNews)
    {
        $file_path = public_path() .  $latestNews->image;
        unlink($file_path);

        $delete = LatestNews::destroy($latestNews->id);

        if ($delete) {
            return back()->with('success', 'Success! Data successfuly deleted');
        } else {
            return back()->with('failed', 'Alert! Data failed to deleted');
        }
    }
}
