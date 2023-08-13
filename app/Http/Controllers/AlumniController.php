<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;


class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Alumni';

        if (request()->ajax()) {

            $data = Alumni::orderByDesc('id')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($row) {
                    $image = '<img src="' . $row->image . '" class="img-fluid" width="50px">';
                    return $image;
                })
                ->editColumn('angkatan', function ($row) {
                    $angkatan = $row->angkatan_awal . '-' . $row->angkatan_akhir;
                    return $angkatan;
                })
                ->editColumn('created_at', function ($row) {
                    $date = date('Y-m-d', strtotime($row->created_at));
                    return $date;
                })
                ->editColumn('user', function ($row) {
                    $user = getUser($row->user)->name;
                    return $user;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<button type="button" class="btn btn-sm btn-warning btn_edit"
                        data-id="' . $row->id . '" data-bs-toggle="modal"
                        data-bs-target="#modal_edit">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Edit
                    </button>
                    <form method="POST" action="' . route('alumni.destroy', $row->id) . '"> ' . method_field('DELETE') . csrf_field() . '<button type="button" class="btn btn-sm btn-danger btn_delete mt-2" data-bs-toggle="modal" data-bs-target="#modal_confirm_delete">
                            <i class="fa-solid fa-trash"></i>
                            Delete
                        </button>
                    </form>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        return view('backend.alumni', compact(['title']));
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
            'nama_siswa' => 'required|max:255',
            'text' => 'required',
            'angkatan_awal' => 'required|numeric',
            'angkatan_akhir' => 'required|numeric',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
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

        $insert = Alumni::create([
            'nama_siswa' => $request->nama_siswa,
            'text' => $request->text,
            'angkatan_awal' => $request->angkatan_awal,
            'angkatan_akhir' => $request->angkatan_akhir,
            'image' => 'images\upload' . '/' . $imageName,
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
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function show(Alumni $alumni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Alumni::where('id', $id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumni $alumni)
    {
        $request->validate([
            'nama_siswa' => 'required|max:255',
            'text' => 'required',
            'angkatan_awal' => 'required|numeric',
            'angkatan_akhir' => 'required|numeric',
            'image' => 'mimes:jpg,jpeg,png|max:2048',
        ]);

        $id = $request->id;
        $images = $request->file('image');
        $imageName = time() . $images->getClientOriginalName() . '.' . $images->extension();
        $imageResize = Image::make($images);
        $imageResize->orientate()
            ->fit(360, 360, function ($constraint) {
                $constraint->upsize();
                $constraint->aspectRatio();
            })
            ->save('images\upload' . '/' . $imageName);

        $update = Alumni::where('id', $id)
            ->update([
                'nama_siswa' => $request->nama_siswa,
                'text' => $request->text,
                'angkatan_awal' => $request->angkatan_awal,
                'angkatan_akhir' => $request->angkatan_akhir,
                'image' => 'images\upload' . '/' . $imageName,
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
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumni = Alumni::where('id', $id)->first();
        $file_path = public_path() . '/' . $alumni->image;
        unlink($file_path);

        $delete = Alumni::destroy($alumni->id);

        if ($delete) {
            return back()->with('success', 'Success! Data successfuly deleted');
        } else {
            return back()->with('failed', 'Alert! Data failed to deleted');
        }
    }
}
