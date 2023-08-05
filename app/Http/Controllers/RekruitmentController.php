<?php

namespace App\Http\Controllers;

use App\Models\Rekruitment;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RekruitmentExport;
use Barryvdh\DomPDF\Facade\Pdf;


class RekruitmentController extends Controller
{
    public function index()
    {
        $title = 'Rekruitment';
        $jabatan = Rekruitment::select('jabatan')->groupBy('jabatan')->get();
        $get_jabatan = request('jabatan');
        $get_proses = request('proses');

        $rekruitment = Rekruitment::orderByDesc('created_at');
        if ($get_jabatan != 'all' && $get_jabatan != null) {
            $rekruitment->where('jabatan', $get_jabatan);
            if ($get_proses != 'all') {
                $rekruitment->where('proses', $get_proses);
            }
        } else {
            if ($get_proses != 'all' && $get_proses != null) {
                $rekruitment->where('proses', $get_proses);
            }
        }
        $rekruitment = $rekruitment->paginate(20);


        return view('backend.rekruitment', compact(['title', 'rekruitment', 'jabatan']));
    }

    public function prosesCV(Request $request)
    {
        $value = $request->value;

        $update = Rekruitment::where('id', $request->id)
            ->update(['proses' => $value]);

        if ($update) {
            $request->session()->put('success', 'Success! Data saved successfully');
        } else {
            $request->session()->put('failed', 'Alert! Data failed to save');
        }
    }

    public function deleteCV(Request $request)
    {
        $jabatan = $request->jabatan;
        $proses = $request->proses;

        $delete = Rekruitment::orderByDesc('created_at');
        if ($jabatan != 'all' && $jabatan != null) {
            $delete->where('jabatan', $jabatan);
        }
        if ($proses != 'all' && $proses != null) {
            $delete->where('proses', $proses);
        }
        $delete->delete();

        if ($delete) {
            return back()->with('success', 'Success! Data deleted successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to delete');
        }
    }

    public function exportExcel()
    {
        $header = ['Jabatan', 'Nama', 'No Hp', 'Email', 'Tanggal Lahir', 'Proses'];

        return Excel::download(new RekruitmentExport($header), 'rekruitment.xlsx');
    }

    public function exportPdf()
    {
        $object = new Rekruitment();
        $data = $object->printPDF();
        $title = 'Daftar Rekruitment';


        $pdf = PDF::loadview('pdf.rekruitmentPdf', ['data' => $data, 'title' => $title]);
        return $pdf->stream('rekruitment.pdf');
        // return $pdf->download('Siswa.pdf');
    }
}
