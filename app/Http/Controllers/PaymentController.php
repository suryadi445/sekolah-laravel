<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentExport;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        hakAksesController();

        $title = 'Payment';
        $payment = Payment::latest()->paginate();

        return view('backend.pembayaran', compact(['title', 'payment']));
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
            'jenis' => 'string',
            'nama' => 'string',
            'pemilik' => 'string',
            'nomor' => 'numeric',
        ]);

        $insert = Payment::create([
            'jenis' => $request->jenis,
            'nama' => $request->nama,
            'nomor' => $request->nomor,
            'pemilik' => $request->pemilik,
            'user' => Auth::id()
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
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $data = Payment::where($payment->id)->first();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'jenis' => 'string',
            'nama' => 'string',
            'pemilik' => 'string',
            'nomor' => 'numeric',
        ]);

        $update = Payment::where('id', $request->id)
            ->update([
                'jenis' => $request->jenis,
                'nama' => $request->nama,
                'nomor' => $request->nomor,
                'pemilik' => $request->pemilik,
                'user' => Auth::id()
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
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Payment::destroy($id);

        if ($delete) {
            return back()->with('success', 'Success! Data successfuly deleted');
        } else {
            return back()->with('failed', 'Alert! Data failed to deleted');
        }
    }

    public function exportExcel()
    {
        $header = ['Nama Pembayaran', 'Jenis Pembayaran', 'Nomor Pembayaran', 'Pemilik Akun'];

        return Excel::download(new PaymentExport($header), 'payment.xlsx');
    }

    public function exportPdf()
    {
        $object = new Payment();
        $data = $object->printPDF();
        $title = 'Daftar Jenis Pembayaran';

        $pdf = PDF::loadview('pdf.paymentPdf', ['data' => $data, 'title' => $title]);
        return $pdf->stream('payment.pdf');
        // return $pdf->download('Siswa.pdf');
    }
}
