<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Career;
use App\Models\DefaultWeb;
use App\Models\Rekruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class TentangKamiController extends Controller
{
    public function index($slug = null)
    {
        $jumbotron  = Banner::where('kategori', 'about')->first();
        $profile    = DefaultWeb::where('url', 'like', 'tentangKami/profile%')->first();
        $sejarah    = DefaultWeb::where('url', 'like', 'tentangKami/sejarah%')->first();
        $karir      = Career::orderBy('deadline')->paginate(9);
        $jenis_jabatan = Career::groupBy('jabatan')->get();
        $data = $this->default();

        if (empty($jumbotron)) {
            $jumbotron = [];
        }

        if ($slug) {
            if ($slug == 'profile') {
                $detail = About::where('slug', 'profile')->first();
                $data = $this->default_profile();
            } elseif ($slug == 'sejarah') {
                $detail = About::where('slug', 'sejarah')->first();
                $data = $this->default_sejarah();
            }

            return view('frontend.detailTentangKami', compact(['jumbotron', 'profile', 'sejarah', 'detail', 'jenis_jabatan', 'karir', 'data']));
        } else {
            return view('frontend.tentangKami', compact(['jumbotron', 'profile', 'sejarah', 'jenis_jabatan', 'karir', 'data']));
        }
    }

    public function getPosisi_row($id)
    {
        $data = Career::where('id', $id)->first();

        return response()->json($data);
    }

    public function getPosisi($jabatan)
    {
        $data = Career::where('jabatan', $jabatan)->get();

        return response()->json($data);
    }

    public function karir(Request $request)
    {
        $request->validate([
            "cv" => "required|mimetypes:application/pdf|max:2500",
            "nama" => "required",
            "no_hp" => "required",
            "email" => "required|email",
            "tgl_lahir" => "required",
        ]);

        $file = $request->file('cv');
        $fileName = time() . $file->getClientOriginalName() . '.' . $file->extension();

        $file->move(public_path('file/cv/'), $fileName);

        $insert = Rekruitment::create([
            "cv" =>  '\file/cv/' . $fileName,
            "jabatan" => $request->jabatan,
            "nama" => $request->nama,
            "no_hp" => $request->no_hp,
            "email" => $request->email,
            "tgl_lahir" => $request->tgl_lahir,
        ]);

        if ($insert) {
            Session::flash('success', 'Success! Data saved successfully');
        } else {
            Session::flash('failed', 'Alert! Data failed to save');
        }

        return redirect('tentangKami');
    }

    public function default()
    {

        $data['judul']      = 'Tentang Kami';
        $data['text']       = 'Kami adalah sekolah yang berdedikasi untuk menciptakan lingkungan belajar yang menginspirasi dan mendukung pertumbuhan holistik setiap siswa. Dengan fokus pada pembelajaran kolaboratif, pengembangan karakter, dan penerimaan terhadap keberagaman, kami berkomitmen untuk menciptakan iklim yang inklusif dan menghargai perspektif beragam. Guru kami tidak hanya sebagai pendidik, tetapi juga sebagai mentor yang memberdayakan siswa untuk mencapai potensi penuh mereka. Di sini, siswa kami dipersiapkan untuk menghadapi tantangan dunia dengan kepercayaan diri, integritas, dan semangat berinovasi. Selamat datang di sekolah kami, di mana mimpi-mimpi menjadi nyata dan prestasi merayakan keberhasilan!';

        return $data;
    }

    public function default_profile()
    {

        $data['judul_profile']      = 'Profile Sekolah Kami';
        $data['profile'] = 'Kami adalah sekolah yang berdedikasi untuk menciptakan lingkungan belajar yang menginspirasi dan mendukung pertumbuhan holistik setiap siswa. Dengan fokus pada pembelajaran kolaboratif, pengembangan karakter, dan penerimaan terhadap keberagaman, kami berkomitmen untuk menciptakan iklim yang inklusif dan menghargai perspektif beragam. Guru kami tidak hanya sebagai pendidik, tetapi juga sebagai mentor yang memberdayakan siswa untuk mencapai potensi penuh mereka. Di sini, siswa kami dipersiapkan untuk menghadapi tantangan dunia dengan kepercayaan diri, integritas, dan semangat berinovasi. Selamat datang di sekolah kami, di mana mimpi-mimpi menjadi nyata dan prestasi merayakan keberhasilan!';

        return $data;
    }

    public function default_sejarah()
    {

        $data['judul_profile']      = 'Sejarah Sekolah Kami';
        $data['profile'] = 'Sejarah sekolah kami kaya akan perjalanan panjang yang berakar kuat. Sejak berdirinya sekolah kami, kami telah tumbuh menjadi lembaga pendidikan yang dihormati, menempuh berbagai tantangan dan pencapaian yang mengesankan. Selama perjalanan ini, kami telah memberikan kontribusi yang berarti bagi pendidikan dan masyarakat. Dengan dedikasi guru dan staf yang luar biasa, serta dukungan penuh dari orang tua dan siswa, sekolah kami terus berkembang sebagai tempat di mana mimpi-mimpi menjadi nyata, dan setiap siswa meraih prestasi gemilang untuk masa depan yang cerah.';

        return $data;
    }
}
