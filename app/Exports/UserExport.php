<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class UserExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    private $header;
    private $user;
    private $status;
    protected $hidden = ['id', 'cv', 'created_at', 'updated_at'];


    public function __construct(array $header, $user, $status)
    {
        $this->user = $user;
        $this->status = $status;
        $this->header = $header;
    }
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $user = $this->user;
        $status = $this->status;

        if ($user == 'internal') {

            $data = User::join('gurus', 'users.id_guru', '=', 'gurus.id');
            $data->select('gurus.nip', 'gurus.nama_guru', 'gurus.jenis_kelamin', 'gurus.alamat', 'users.is_active');
        } else {

            $data = User::join('siswas', 'users.id_siswa', '=', 'siswas.id');
            $data->select('siswas.nis', 'siswas.nama_siswa', 'siswas.jenis_kelamin', 'siswas.alamat', 'users.is_active');
        }

        if ($status != null) {
            $data->where('users.is_active', '=', $status);
        }
        $data = $data->get();

        if (!empty($data)) {
            foreach ($data as $user) {
                $user->is_active = $user->is_active == '0' ? 'Tidak Aktif' : 'Aktif';
            }
        }

        return $data;
    }

    public function headings(): array
    {
        return $this->header;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}
