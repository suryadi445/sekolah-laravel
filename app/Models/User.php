<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'no_hp',
        'id_siswa',
        'id_guru',
        'id_group',
        'password',
        'is_active',
        'passAsli',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function printPDF($user, $status)
    {
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

        foreach ($data as $user) {
            $user->is_active = $user->is_active == '0' ? 'Tidak Aktif' : 'Aktif';
        }

        $data = $data->toArray();

        return $data;
    }
}
