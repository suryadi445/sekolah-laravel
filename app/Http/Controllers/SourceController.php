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

            return view('frontend.source_siswa', compact(['data']));
        } else {
            // teacher
            $data = $this->guru();
            return view('frontend.source_guru', compact(['data']));
        }
    }

    public function student()
    {
        $data = Siswa::latest()->search()->paginate(12);

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