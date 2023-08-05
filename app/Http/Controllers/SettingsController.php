<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title = 'Pengaturan';
        $settings = Settings::first();


        return view('backend.settings', compact(['settings', 'title']));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Settings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Settings $settings)
    {
        $request->validate([
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->hasFile('logo')) {

            $images = $request->file('logo');
            $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();
            $imageResize = Image::make($images);
            $imageResize->orientate()
                ->fit(360, 360, function ($constraint) {
                    $constraint->upsize();
                    $constraint->aspectRatio();
                })
                ->save('images\upload' . '/' . $imageName);

            $_POST['logo'] = '\images/upload/' . $imageName;
        }

        $cek_row = Settings::first();

        unset($_POST['_token']);
        unset($_POST['_method']);

        if (!empty($_POST['sosmed'])) {
            unset($_POST['sosmed']);

            $sosmed = [
                'facebook' => $_POST['facebook'],
                'ig' => $_POST['ig'],
                'twitter' => $_POST['twitter'],
                'linkedin' => $_POST['linkedin'],
                'youtube' => $_POST['youtube'],
            ];

            $insert = Settings::where('id', 1)
                ->update($sosmed);
        } else {

            if ($cek_row) {
                foreach ($_POST as $name => $value) {
                    $insert = Settings::where('id', 1)
                        ->update([
                            $name => $value
                        ]);
                }
            } else {
                foreach ($_POST as $name => $value) {
                    $insert = Settings::create([
                        $name => $value
                    ]);
                }
            }
        }


        if ($insert) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
