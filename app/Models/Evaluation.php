<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeSearch($query)
    {
        return $query->where('nama_siswa', 'like', '%' . request('cari') . '%')
            ->orWhere('jenis_kelamin', 'like', '%' . request('cari') . '%')
            ->orWhere('tgl_lahir', 'like', '%' . request('cari') . '%')
            ->orWhere('thn_ajaran', 'like', '%' . request('cari') . '%')
            ->orWhere('kelas', 'like', '%' . request('cari') . '%');
    }
}
