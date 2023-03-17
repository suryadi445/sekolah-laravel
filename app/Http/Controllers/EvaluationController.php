<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Mapel;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_guru = userLogin()->id_guru;
        $kelas = Kelas::select('kelas', 'sub_kelas')->where('id_guru', $id_guru)->get();
        // QUERY Penilaian Siswa--------------------------------
        $paramKelas = request('kelas');
        if ($paramKelas) {
            $string = urldecode($paramKelas);
            $array = explode(" ", $string);
            $class = $array[0];
            $subClass = $array[1];
        }
        $murid = Siswa::orderByRaw('kelas asc, sub_kelas asc, nama_siswa asc');
        if ($paramKelas) {
            $murid->where('kelas', $class);
            $murid->where('sub_kelas', $subClass);
        }
        $murid = $murid->get();

        $siswa = [];
        foreach ($murid as $value) {
            $kelasSiswa = $value->kelas;
            $subKelasSiswa = $value->sub_kelas;
            foreach ($kelas as  $val) {
                $kelasKelas = $val->kelas;
                $subKelasKelas = $val->sub_kelas;
                if ($kelasSiswa == $kelasKelas && $subKelasKelas == $subKelasSiswa) {
                    $siswa[] = $value;
                }
            }
        }

        // QUERY DAFTAR penilaian--------------------------------
        $tanggal = request('daftar_tanggal');
        $mapel = request('daftar_mapel');
        $kls = request('daftar_kelas');
        $cek_penilaian = Evaluation::where('tanggal_penilaian', date('Y-m-d'))->groupBy('id_mapel')->orderByDesc('id')->first();
        $penilaian = Evaluation::join('siswas', 'evaluations.id_siswa', '=', 'siswas.id');
        // filter mata pelajaran 
        if (!empty($mapel)) {
            $penilaian->where('evaluations.id_mapel', $mapel);
        }
        // filter kelas 
        if (!empty($kls)) {
            $penilaian->where('evaluations.kelas', $kls);
        }
        // filter tanggal
        if (empty($tanggal)) {
            $penilaian->where('tanggal_penilaian', date('Y-m-d'));
        } else {
            $penilaian->where('tanggal_penilaian', $tanggal);
        }
        $penilaian->select('evaluations.*', 'siswas.nama_siswa', 'siswas.jenis_kelamin', 'siswas.nis');
        $penilaian->orderByRaw('evaluations.tanggal_penilaian, siswas.nama_siswa')->get();
        $penilaians = $penilaian->get();

        $data['title'] = 'Penilaian Siswa';
        $data['kelas'] = $kelas;
        $data['penilaians'] = $penilaians;
        $data['siswa'] = $siswa;
        $data['cek_penilaian'] = $cek_penilaian;
        $data['evaluation'] = Evaluation::latest()->paginate(20);
        $data['mapel'] = Mapel::all();


        return view('backend.evaluation', $data);
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

        // dd($request);

        $jumlah_siswa = count($request->id_siswa);

        for ($i = 0; $i < $jumlah_siswa; $i++) {
            $insert = Evaluation::create([
                'id_siswa' => $request->id_siswa[$i],
                'id_mapel' => $request->id_mapel,
                'kelas' => $request->kelas,
                'tanggal_penilaian' => $request->tanggal_penilaian,
                'nilai_siswa' => $request->nilai[$i],
                'grade' => $request->grade[$i] ?? '',
                'user' => Auth::id(),
                'status' => $request->status[$i],
            ]);
        }

        if ($insert) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        $jumlah_siswa = count($request->id_siswa);

        for ($i = 0; $i < $jumlah_siswa; $i++) {
            $update = Evaluation::where('id', $request->id_penilaian[$i])
                ->update([
                    'id_siswa' => $request->id_siswa[$i],
                    'id_mapel' => $request->id_mapel,
                    'kelas' => $request->kelas,
                    'tanggal_penilaian' => $request->tanggal_penilaian,
                    'nilai_siswa' => $request->nilai[$i],
                    'grade' => $request->grade[$i] ?? '',
                    'user' => Auth::id(),
                    'status' => $request->status[$i],
                ]);
        }

        if ($update) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluation  $evaluation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
