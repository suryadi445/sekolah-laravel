<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use App\Models\Banner;


class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Notice::latest()->paginate(20);
        $data = Banner::where('kategori', 'Pengumuman')->first();
        if (empty($data)) {
            $data = $this->default();
        }

        return view('frontend.pengumuman', compact('pengumuman', 'data'));
    }

    public function default()
    {
        $data['judul']      = 'Pengumuman';
        $data['text']       = 'Kami dengan senang hati ingin berbagi informasi terbaru dan penting melalui halaman pengumuman kami. Di sini, Anda akan menemukan berbagai pengumuman terkini seputar acara, kegiatan, perubahan jadwal, dan berita terkini dari sekolah kami. Tetaplah terhubung dengan halaman ini untuk mendapatkan update terbaru secara berkala. Informasi yang kami bagikan di sini akan membantu Anda tetap terinformasi dan terlibat dalam kehidupan sekolah. Jangan lewatkan kesempatan untuk berpartisipasi dalam acara dan kegiatan menarik kami. Kami harap Anda menikmati pengalaman menjelajahi halaman pengumuman ini dan semoga informasi yang kami berikan dapat bermanfaat bagi Anda dan seluruh komunitas sekolah kami.';
        $data['judul_pengumuman'] = 'Pengumuman Penerimaan Siswa Baru';
        $data['text_pengumuman'] = 'Kami dengan gembira ingin memberitahukan bahwa pendaftaran siswa baru untuk tahun ajaran berikutnya telah resmi dibuka! Kami mengundang calon siswa dan orang tua untuk bergabung dalam keluarga sekolah kami. Dengan lingkungan belajar yang inspiratif dan kurikulum yang mendukung, kami berkomitmen untuk memberikan pengalaman pendidikan yang bermutu dan menarik bagi setiap siswa. Segera daftarkan diri Anda dan jadilah bagian dari perjalanan pendidikan yang penuh prestasi, eksplorasi, dan pertumbuhan di sekolah kami. Informasi lebih lanjut dan formulir pendaftaran dapat ditemukan di halaman website kami. Selamat datang dan kami sangat bersemangat untuk menyambut Anda!';

        return $data;
    }
}
