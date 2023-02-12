<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Guru extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function scopeSearch($query)
    {
        if (request('cari')) {

            return $query->where('nama_guru', 'like', '%' . request('cari') . '%')
                ->orWhere('pendidikan_terakhir', 'like', '%' . request('cari') . '%')
                ->orWhere('no_hp', 'like', '%' . request('cari') . '%')
                ->orWhere('jabatan', 'like', '%' . request('cari') . '%')
                ->orWhere('jenis_kelamin', 'like', '%' . request('cari') . '%')
                ->orWhere('nip', 'like', '%' . request('cari') . '%')
                ->orWhere('nik', 'like', '%' . request('cari') . '%');
        }
    }
}
