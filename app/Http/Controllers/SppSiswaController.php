<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Payment;
use App\Models\Siswa;
use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SppExport;
use Maatwebsite\Excel\Facades\Excel;



class SppSiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        hakAksesController();

        $title = 'Spp Siswa';
        $subKelas = Kelas::select('id', 'kelas', 'sub_kelas')->groupBy('sub_kelas')->get();

        if (request()->ajax()) {
            $data = Siswa::select('*')->orderByDesc('id');

            if (!empty($request->kelas)) {
                $data->where('kelas', '=', $request->kelas);
            }

            if (!empty($request->subKelas)) {
                $data->where('sub_kelas', '=', $request->subKelas);
            }

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


        return view('backend.spp', compact(['title', 'subKelas']));
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
            "bulan" => 'required',
            "tahun" => 'required',
            "kelas" => 'required',
            "tipe_pembayaran" => 'required',
            "nominal" => 'numeric',
        ]);

        $ajaran_awal = getTahunAjaran()->thn_ajaran_awal;
        $ajaran_akhir = getTahunAjaran()->thn_ajaran_akhir;


        $insert = Spp::create([
            "bulan" => $request->bulan,
            "nama_bulan" => nomorToBulan($request->bulan),
            "id_siswa" => $request->id_siswa,
            "tahun" => $request->tahun,
            "id_kelas" => $request->kelas,
            "jenis_pembayaran" => $request->jenis_pembayaran ?? '-',
            "merchant" => $request->merchant ?? '-',
            "tipe_pembayaran" => $request->tipe_pembayaran,
            "keterangan" => $request->keterangan,
            "nominal" => $request->nominal,
            'tahun_ajaran_awal' => $ajaran_awal,
            'tahun_ajaran_akhir' => $ajaran_akhir,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_siswa)
    {
        $title = 'Detail SPP Siswa';

        $tahun = request('tahun');
        if (empty($tahun)) {
            $tahun = date('Y');
        }

        $payment = Payment::all();

        $biodata = Siswa::join('kelas', function ($join) {
            $join->on('siswas.kelas', '=', 'kelas.kelas')
                ->on('siswas.sub_kelas', '=', 'kelas.sub_kelas');
        })
            ->where('siswas.id', $id_siswa)
            ->select('siswas.*', 'kelas.biaya_spp', 'kelas.sub_kelas', 'kelas.id as id_kelas')
            ->first();


        $dataSiswa = Spp::rightJoin('siswas', 'spps.id_siswa', '=', 'siswas.id')
            ->leftJoin('payments', 'payments.id', '=', 'spps.merchant')
            ->where('siswas.id', $id_siswa)
            ->where('spps.tahun', $tahun)
            ->groupBy('spps.bulan')
            ->orderBy('spps.tahun')
            ->orderByDesc('spps.bulan')
            ->select('siswas.*', 'spps.id as id_spp', 'spps.nama_bulan', 'spps.bulan', 'spps.tahun', 'spps.tipe_pembayaran', 'spps.jenis_pembayaran', 'spps.merchant', 'spps.keterangan', 'payments.nama as nama_bank', 'payments.nomor as no_rek')
            ->get();

        return view('backend.sppDetail', compact(['title', 'dataSiswa', 'biodata', 'payment']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Spp::where('id', $id)->first();

        return response()->json($data);
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
        $request->validate([
            "bulan" => 'required',
            "tahun" => 'required',
            "kelas" => 'required',
            "tipe_pembayaran" => 'required',
            "nominal" => 'numeric',
        ]);


        $update = Spp::where('id', $id)
            ->update([
                "bulan" => $request->bulan,
                "nama_bulan" => nomorToBulan($request->bulan),
                "id_siswa" => $request->id_siswa,
                "tahun" => $request->tahun,
                "id_kelas" => $request->kelas,
                "jenis_pembayaran" => $request->jenis_pembayaran ?? '-',
                "merchant" => $request->merchant ?? '-',
                "tipe_pembayaran" => $request->tipe_pembayaran,
                "keterangan" => $request->keterangan,
                "nominal" => $request->nominal,
                "user" => Auth::id(),
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Spp::destroy($id);

        if ($delete) {
            return back()->with('success', 'Success! Data successfuly deleted');
        } else {
            return back()->with('failed', 'Alert! Data failed to deleted');
        }
    }

    public function getPembayaran()
    {
        $jenis = request('jenis_pembayaran');

        $data = Payment::where('jenis', $jenis)->get();

        return response()->json($data);
    }

    public function cekPembayaran()
    {
        $tahun = request('tahun');
        $id_siswa = request('id_siswa');

        $data = Spp::where('tahun', $tahun)
            ->where('id_siswa', $id_siswa)
            ->select('bulan', 'tahun')->get();

        return response()->json($data);
    }

    public function exportExcel($kelas = null, $sub_kelas = null)
    {
        $header = ['Nama Siswa', 'Kelas', 'Sub Kelas', 'Bulan', 'Tahun', 'Tipe Pembayaran', 'Jenis Pembayaran', 'Merchant', 'Keterangan', 'Nominal', 'Created At'];

        return Excel::download(new SppExport($header, $kelas, $sub_kelas), 'spp.xlsx');
    }

    public function exportPdf($kelas = null, $sub_kelas = null)
    {
        $object = new Spp();
        $data = $object->printPDF($kelas, $sub_kelas);
        $title = 'Daftar Spp Siswa';


        $pdf = PDF::loadview('pdf.sppPdf', ['data' => $data, 'title' => $title]);
        return $pdf->stream('spp.pdf');
        // return $pdf->download('Siswa.pdf');
    }
}
