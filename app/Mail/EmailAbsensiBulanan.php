<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Siswa;


class EmailAbsensiBulanan extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function build()
    {
        $excelFilePath = $this->create_excel();

        return $this->view('email.absensiBulanan')
            ->attach($excelFilePath);
    }

    public function create_excel()
    {
        $model_siswa = new Siswa;

        $data = $model_siswa->getSiswaMonthly();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul kolom
        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'Mata Pelajaran');
        $sheet->setCellValue('C1', 'Kelas');
        $sheet->setCellValue('D1', 'Tanggal Absensi');
        $sheet->setCellValue('E1', 'Absensi');
        $sheet->setCellValue('F1', 'Keterangan');

        // Populate data
        $row = 2;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $item->nama_siswa);
            $sheet->setCellValue('B' . $row, $item->mata_pelajaran);
            $sheet->setCellValue('C' . $row, $item->kelas);
            $sheet->setCellValue('D' . $row, $item->tgl_absensi);
            $sheet->setCellValue('E' . $row, $item->absensi);
            $sheet->setCellValue('F' . $row, $item->keterangan);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $excelFilePath = public_path('file/absensi/AbsensiBulanan(' . date('m-Y)') . '.xlsx');
        $writer->save($excelFilePath);

        return $excelFilePath;
    }
}
