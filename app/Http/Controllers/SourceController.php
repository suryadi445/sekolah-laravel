<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function index($slug)
    {
        if ($slug == 'student') {
            $datas = $this->student();
            $data = $this->default_siswa();

            return view('frontend.source_siswa', compact(['data', 'datas']));
        } else {
            // teacher
            $datas = $this->guru();
            $data = $this->default_guru();

            return view('frontend.source_guru', compact(['data', 'datas']));
        }
    }

    public function student()
    {
        $data = Siswa::latest()->search()->paginate(12);

        return $data;
    }

    public function guru()
    {
        $data = Guru::latest()->search()->paginate(12);

        return $data;
    }

    public function get_guru($id)
    {
        $data = Guru::find($id);

        return response()->json($data);
    }

    public function default_siswa()
    {
        $data['judul']      = 'Siswa di Sekolah Kami';
        $data['text']       = 'Siswa adalah harapan dan aset berharga bagi masa depan. Dengan semangat belajar yang gigih, mereka mengejar ilmu pengetahuan dan pengetahuan yang akan membawa mereka menuju prestasi luar biasa. Melalui pengetahuan dan pembelajaran yang mereka peroleh, siswa menjadi agen perubahan positif dalam masyarakat. Setiap hari, mereka menghadapi tantangan belajar dengan tekad untuk meraih kesuksesan. Siswa adalah generasi penerus, yang kami percaya akan membawa perubahan positif dan menginspirasi dunia dengan inovasi dan kreativitas mereka. Kami bangga dengan kemampuan mereka, dan bersama-sama kami menciptakan lingkungan belajar yang inklusif dan memberdayakan, mempersiapkan mereka untuk menghadapi dunia yang penuh tantangan dengan kepercayaan diri dan optimisme.';

        return $data;
    }

    public function default_guru()
    {
        $data['judul']      = 'Guru Di Sekolah Kami';
        $data['text']       = 'Guru-guru memiliki peran penting dalam pembentukan masa depan siswa. Mereka bukan hanya penyampai pengetahuan, tetapi juga pemandu dan inspirator. Dari sekolah dasar hingga menengah, guru membimbing siswa dengan kesabaran dan dedikasi. Mereka mengajarkan pelajaran serta nilai-nilai sosial dan moral. Guru-guru memberikan dukungan dan dorongan agar siswa tetap termotivasi dalam belajar. Mereka membantu siswa menghadapi tantangan akademis dan membentuk karakter yang baik. Pengalaman belajar dan bimbingan dari guru-guru menciptakan fondasi kuat bagi perkembangan intelektual dan emosional siswa. Dengan dedikasi mereka, guru-guru membawa pengaruh positif dan mempersiapkan siswa untuk masa depan yang cerah.';

        return $data;
    }
}
