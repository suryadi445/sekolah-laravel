<?php

namespace App\Http\Controllers;

use App\Models\DefaultWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DefaultWebController extends Controller
{
    public function index()
    {
        $default = DefaultWeb::orderByDesc('id')->paginate(20);
        $title = 'Halaman Default';

        return view('backend.default', compact(['default', 'title']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|max:2048',
        ]);

        $url = 'tentangKami/' . $request->url; // url harus unique
        $cek_url = DefaultWeb::where('url', $url)->first();

        if ($cek_url) {

            $insert = false;
        } else {

            if ($request->hasFile('image')) {
                $images = $request->file('image');
                $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();

                $images->move(public_path('images/upload/'), $imageName);
            }

            $insert = DefaultWeb::create([
                'image' => '\images/upload/' . $imageName,
                'url' => $url,
                'user' => Auth::id(),
            ]);
        }

        if ($insert) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    public function edit($id)
    {
        $data = DefaultWeb::where('id', $id)->first();

        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpg,png,jpeg|max:2048',
        ]);

        $url = 'tentangKami/' . $request->url; // url harus unique
        $cek_url = DefaultWeb::where('url', $url)->first(); // cek url
        $tb_default = DefaultWeb::where('id', $request->id)->first(); // pakai row yg sama

        if ($request->hasFile('image')) {

            $images = $request->file('image');
            $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();

            $images->move(public_path('images/upload/'), $imageName);

            $gambar = '\images/upload/' . $imageName;

            if ($tb_default) {
                $file_path = public_path() .  $tb_default->image;
                unlink($file_path);
            }
        } else {
            $gambar = $tb_default->image;
        }

        if ($cek_url) {
            $update = DefaultWeb::where('id', $request->id)
                ->update([
                    'image' => $gambar,
                    'user' => Auth::id(),
                ]);
        } else {
            $update = DefaultWeb::where('id', $request->id)
                ->update([
                    'image' => $gambar,
                    'url' => $url,
                    'user' => Auth::id(),
                ]);
        }

        if ($update) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    public function destroy($id)
    {
        $tb_default = DefaultWeb::where('id', $id)->first(); // pakai row yg sama

        $file_path = public_path() .  $tb_default->image;
        unlink($file_path);

        $update = DefaultWeb::destroy($id);

        if ($update) {
            return back()->with('success', 'Success! Data deleted successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to delete');
        }
    }
}