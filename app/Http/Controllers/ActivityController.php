<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Kegiatan Siswa';
        $activity = Activity::orderByDesc('id')->paginate(10);


        return view('backend.activity', compact(['title', 'activity']));
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
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
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

        $insert = Activity::create([
            'judul' => $request->judul,
            'text' => $request->text,
            'image' => '\images/upload/' . $imageName,
            'user'  => Auth::id(),
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
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        $data = Activity::where('id', $activity->id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'text' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('image')) {

            // delete image lama    
            $file_path = public_path() .  $activity->image;
            unlink($file_path);

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

            $imageName = $activity->image;
        }

        $insert = Activity::where('id', $request->id)
            ->update([
                'judul' => $request->judul,
                'text' => $request->text,
                'image' => $imageName,
                'user'  => Auth::id(),
            ]);

        if ($insert) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $file_path = public_path() .  $activity->image;
        unlink($file_path);

        $delete = Activity::destroy($activity->id);

        if ($delete) {
            return back()->with('success', 'Success! Data successfuly deleted');
        } else {
            return back()->with('failed', 'Alert! Data failed to deleted');
        }
    }
}