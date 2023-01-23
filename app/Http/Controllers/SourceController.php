<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function index($slug)
    {
        if ($slug == 'student') {
            $data = $this->student();
        } else {
            // teacher
            $data = $this->guru();
        }

        return view('frontend.source', compact(['data']));
    }

    public function student()
    {
        $data = Siswa::all();

        return $data;
    }

    public function guru()
    {
        $data = Guru::latest()->search()->paginate(12);

        return $data;
    }

    public function get_guru($id)
    {
        $data = Guru::find($id);

        return response()->json($data);
    }
}