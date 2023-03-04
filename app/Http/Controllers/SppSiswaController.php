<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class SppSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Spp Siswa';

        if (request()->ajax()) {
            $data = Siswa::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('image', function ($row) {
                    $image = '<img src="' . $row->image . '" class="img-fluid" width="50px">';
                    return $image;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="sppSiswa/show/' . $row->id . '" class="badge text-bg-info d-block text-decoration-none text-light">Detail</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }


        return view('backend.spp', compact(['title']));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_siswa)
    {
        $title = 'Detail Siswa SPP';

        $dataSiswa = Spp::rightJoin('siswas', 'spps.id_siswa', '=', 'siswas.id')
            ->join('kelas', 'siswas.kelas', '=', 'kelas.kelas')
            ->join('kelas as class', 'siswas.sub_kelas', '=', 'class.sub_kelas')
            ->where('siswas.id', $id_siswa)
            ->select('siswas.*', 'spps.bulan', 'spps.bulan', 'spps.tahun', 'spps.tipe_pembayaran', 'spps.jenis_pembayaran', 'spps.merchant', 'spps.keterangan', 'kelas.biaya_spp')
            ->get();

        // dd($dataSiswa);

        return view('backend.sppDetail', compact(['title', 'dataSiswa']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}