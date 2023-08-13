<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Graduation;
use App\Models\Siswa;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GraduationExport;
use Barryvdh\DomPDF\Facade\Pdf;



class GraduationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Kelulusan Siswa';

        $kelas = arrayKelas();
        $kelasTerakhir  = end($kelas);
        $paramKelas = request('kelas');

        if (request()->ajax()) {

            if ($paramKelas) {
                $data = Siswa::select('*')->where('kelas', $paramKelas)->orderBy('nama_siswa');
            } else {
                $data = Siswa::select('*')->where('kelas', $kelasTerakhir)->orderBy('nama_siswa');
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($row) {
                    $image = '<img src="' . $row->image . '" class="img-fluid" width="50px">';
                    return $image;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="graduate[' . $row->id . ']" id="graduate' . $row->id . '" value="yes" checked>
                        <label class="form-check-label" for="graduate' . $row->id . '">
                            Lulus
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="graduate[' . $row->id . ']" id="graduate' . $row->id . '" value="no">
                        <label class="form-check-label" for="graduate' . $row->id . '">
                            Tidak Lulus
                        </label>
                    </div>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }


        return view('backend.graduation', compact(['title']));
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
        $graduation = $request->input('graduate');
        $alasan = $request->input('alasan');

        try {

            DB::transaction(function () use ($graduation, $alasan) {

                $id_siswa = [];
                $value = [];
                foreach ($graduation as $key => $val) {

                    if ($val == 'yes') {
                        $id_siswa[] = $key;
                    }
                }

                $siswa = Siswa::whereIn('id', $id_siswa)->get();

                $data = [];
                foreach ($siswa as $key => $value) {

                    if ($alasan == 'wisuda') {
                        $data[] = [
                            'nama_siswa' => $value->nama_siswa,
                            'image' => $value->image,
                            'angkatan_awal' => $value->thn_ajaran_berjalan_awal,
                            'angkatan_akhir' => $value->thn_ajaran_berjalan_akhir,
                            'user' => userLogin()->id,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];

                        $dataHistory[] = [
                            'id_siswa' => $value->id,
                            'keterangan' => $alasan,
                            'user' => userLogin()->id,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        ];
                    }
                }


                if ($alasan == 'wisuda') {
                    // Hanya Masuk jika dia wisuda
                    Alumni::insert($data);
                }

                // history siswa keluar
                Graduation::insert($dataHistory);
                // delete ke table siswa
                Siswa::whereIn('id', $id_siswa)->delete();
            });

            return back()->with('success', 'Success! Data saved successfully');
        } catch (\Exception $e) {

            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Graduation  $graduation
     * @return \Illuminate\Http\Response
     */
    public function show(Graduation $graduation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Graduation  $graduation
     * @return \Illuminate\Http\Response
     */
    public function edit(Graduation $graduation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Graduation  $graduation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Graduation $graduation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Graduation  $graduation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Graduation $graduation)
    {
        //
    }

    public function exportExcel()
    {
        $header = ['Nama Siswa', 'Jenis Kelamin', 'Tanggal Lahir', 'Angkatan'];

        return Excel::download(new GraduationExport($header), 'jabatan.xlsx');
    }

    public function exportPdf()
    {
        $object = new Graduation();
        $data = $object->printPDF();
        $title = 'Daftar Kelulusan';

        $pdf = PDF::loadview('pdf.kelulusanPdf', ['data' => $data, 'title' => $title]);
        return $pdf->stream('kelulusan.pdf');
        // return $pdf->download('Siswa.pdf');
    }
}
