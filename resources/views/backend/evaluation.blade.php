@extends('layouts.admin.admin')

@section('admin')
    <ul class="nav nav-pills nav-justified rounded mb-3" style="background-color: #adb5bd !important" id="myTab"
        role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs active" id="penilaian-tab" data-bs-toggle="tab" data-bs-target="#penilaian-tab-pane"
                type="button" role="tab" aria-controls="penilaian-tab-pane" aria-selected="true">
                Penilaian Siswa
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs" id="list-tab" data-bs-toggle="tab" data-bs-target="#list-tab-pane" type="button"
                role="tab" aria-controls="list-tab-pane" aria-selected="false">
                Daftar Penilaian
            </button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="penilaian-tab-pane" role="tabpanel" aria-labelledby="penilaian-tab"
            tabindex="0">
            <form class="needs-validation" action="{{ route('evaluation.store') }}" method="post" novalidate>
                @csrf
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">

                                </div>
                                <div class="row">
                                    <div class="col-md-3 mt-2">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="/evaluation/exportPdf?kelas={{ request('kelas') . '&id_mapel=' . request('id_mapel') . '&tgl=' . request('tgl') }}"
                                                target="_blank" class="btn btn-success">
                                                <span class="me-1">Print PDF</span>
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </a>
                                            <a href="/evaluation/exportExcel?kelas={{ request('kelas') . '&id_mapel=' . request('id_mapel') . '&tgl=' . request('tgl') }}"
                                                target="_blank" class="btn btn-warning">
                                                <span class="me-1">Print Excel</span>
                                                <i class="fa-solid fa-file-excel"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <div class="form-floating">
                                            <select class="form-select" name="kelas" id="kelas" required>
                                                <option selected value="">Pilih Kelas</option>
                                                @foreach ($kelas as $item)
                                                    <option
                                                        {{ request('kelas') == $item->kelas . ' ' . $item->sub_kelas ? 'selected' : '' }}
                                                        value="{{ $item->kelas . ' ' . $item->sub_kelas }}">
                                                        {{ $item->kelas . ' ' . $item->sub_kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="kelas">Kelas</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <div class="form-floating">
                                            <select class="form-select" name="id_mapel" id="id_mapel" required>
                                                <option selected value="">Pilih Mata Pelajaran</option>
                                                @foreach ($mapel as $item)
                                                    <option {{ request('id_mapel') == $item->id ? 'selected' : '' }}
                                                        value="{{ old('id_mapel', $item->id) }}">
                                                        {{ $item->mata_pelajaran }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="mata_pelajaran">Mata Pelajaran</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="tanggal_penilaian"
                                                name="tanggal_penilaian" value="{{ date('Y-m-d') }}">
                                            <label for="tanggal_penilaian">Tanggal Ujian</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-striped text-center  table-responsive rounded rounded-1 overflow-hidden">
                                                <thead class="bg-dark text-light">
                                                    <thead class="bg-dark text-light">
                                                        <tr>
                                                            <th scope="col">No.</th>
                                                            <th scope="col">Nama Siswa</th>
                                                            <th scope="col">Jenis Kelamin</th>
                                                            <th scope="col">Nilai</th>
                                                            <th scope="col">Grade</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                <tbody>
                                                    @if (!empty($siswa))
                                                        @foreach ($siswa as $key => $item)
                                                            <input type="hidden" name="id_siswa[]"
                                                                value="{{ $item->id }}">
                                                            <tr>
                                                                <th scope="row" class="align-middle">
                                                                    {{ $key + 1 }}
                                                                </th>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control bg-light text-capitalize"
                                                                        value="{{ $item->nama_siswa }}" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control bg-light text-capitalize"
                                                                        value="{{ $item->jenis_kelamin }}" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control nilai"
                                                                        name="nilai[]" value="0" required>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select" name="grade[]">
                                                                        <option selected disabled value="">Pilih
                                                                            Grade
                                                                        </option>
                                                                        <option value="A">A</option>
                                                                        <option value="B">B</option>
                                                                        <option value="C">C</option>
                                                                        <option value="D">D</option>
                                                                        <option value="E">E</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <input type="hidden"
                                                                            name="status[{{ $key }}]"
                                                                            value="no">
                                                                        <input class="form-check-input align-middle"
                                                                            name="status[{{ $key }}]"
                                                                            type="checkbox" value="yes" checked>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif


                                                    @if (count($siswa) == 0)
                                                        <td colspan="7">
                                                            <span class="text-danger">Data Tidak Tersedia </span>
                                                        </td>
                                                    @endif
                                                </tbody>
                                            </table>

                                            <div class="d-flex justify-content-start">
                                                <button type="submit" class="btn btn-primary me-2">
                                                    <i class="fa-solid fa-floppy-disk"></i>
                                                    Simpan
                                                </button>
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa-brands fa-whatsapp"></i>
                                                    Kirim
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="list-tab-pane" role="tabpanel" aria-labelledby="list-tab" tabindex="0">
            <form class="needs-validation" action="{{ route('evaluation.update', $cek_penilaian->id ?? '') }}"
                method="post" novalidate>
                @csrf
                @method('PUT')
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="offset-md-3 col-md-3 mt-1">
                                        <div class="form-floating">
                                            <select class="form-select" name="kelas" id="kelas_daftarEvaluation"
                                                required>
                                                <option selected value="">Pilih Kelas</option>
                                                @foreach ($kelas as $item)
                                                    <option
                                                        {{ request('daftar_kelas') == $item->kelas . ' ' . $item->sub_kelas ? 'selected' : '' }}
                                                        value="{{ $item->kelas . ' ' . $item->sub_kelas }}">
                                                        {{ $item->kelas . ' ' . $item->sub_kelas }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="kelas">Kelas</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <div class="form-floating">
                                            <select class="form-select" name="id_mapel" id="id_mapel_daftarEvaluation"
                                                required>
                                                <option selected value="">Pilih Mata Pelajaran</option>
                                                @foreach ($mapel as $item)
                                                    <option {{ request('daftar_mapel') == $item->id ? 'selected' : '' }}
                                                        value="{{ $item->id }}">
                                                        {{ $item->mata_pelajaran }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="mata_pelajaran">Mata Pelajaran</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-1">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="tgl_daftarEvaluation"
                                                name="tanggal_penilaian"
                                                value="{{ request('daftar_tanggal') ? request('daftar_tanggal') : date('Y-m-d') }}">
                                            <label for="tanggal_penilaian">Tanggal Ujian</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-striped text-center  table-responsive rounded rounded-1 overflow-hidden">
                                                <thead class="bg-dark text-light">
                                                    <thead class="bg-dark text-light">
                                                        <tr>
                                                            <th scope="col">No.</th>
                                                            <th scope="col">Nama Siswa</th>
                                                            <th scope="col">Jenis Kelamin</th>
                                                            <th scope="col">Nilai</th>
                                                            <th scope="col">Grade</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                <tbody>
                                                    @if (!empty($penilaians))
                                                        @foreach ($penilaians as $key => $item)
                                                            <input type="hidden" name="id_siswa[]"
                                                                value="{{ $item->id_siswa }}">
                                                            <input type="hidden" name="id_penilaian[]"
                                                                value="{{ $item->id }}">
                                                            <tr class="{{ $item->status == 'no' ? 'bg-danger' : '' }}">
                                                                <th scope="row" class="align-middle">
                                                                    {{ $key + 1 }}
                                                                </th>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control bg-light text-capitalize {{ $item->nilai_siswa < 60 ? 'border border-warning' : '' }}"
                                                                        value="{{ $item->nama_siswa }}" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control bg-light text-capitalize {{ $item->nilai_siswa < 60 ? 'border border-warning' : '' }}"
                                                                        value="{{ $item->jenis_kelamin }}" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="text"
                                                                        class="form-control nilai {{ $item->nilai_siswa < 60 ? 'border border-warning' : '' }}"
                                                                        name="nilai[]" value="{{ $item->nilai_siswa }}"
                                                                        required>
                                                                </td>
                                                                <td>
                                                                    <select
                                                                        class="form-select {{ $item->nilai_siswa < 60 ? 'border border-warning' : '' }}"
                                                                        name="grade[]">
                                                                        <option selected value="">Pilih
                                                                            Grade
                                                                        </option>
                                                                        <option {{ $item->grade == 'A' ? 'selected' : '' }}
                                                                            value="A">A</option>
                                                                        <option {{ $item->grade == 'B' ? 'selected' : '' }}
                                                                            value="B">B</option>
                                                                        <option {{ $item->grade == 'C' ? 'selected' : '' }}
                                                                            value="C">C</option>
                                                                        <option {{ $item->grade == 'D' ? 'selected' : '' }}
                                                                            value="D">D</option>
                                                                        <option {{ $item->grade == 'E' ? 'selected' : '' }}
                                                                            value="E">E</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <div>
                                                                        <input type="hidden"
                                                                            name="status[{{ $key }}]"
                                                                            value="no">
                                                                        <input class="form-check-input align-middle"
                                                                            name="status[{{ $key }}]"
                                                                            type="checkbox" value="yes"
                                                                            {{ $item->status == 'yes' ? 'checked' : '' }}>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif


                                                    @if (count($penilaians) == 0)
                                                        <td colspan="7">
                                                            <span class="text-danger">Data Tidak Tersedia </span>
                                                        </td>
                                                    @endif
                                                </tbody>
                                            </table>

                                            <div class="d-flex justify-content-start">
                                                <button type="submit" class="btn btn-primary me-2">
                                                    <i class="fa-solid fa-floppy-disk"></i>
                                                    Simpan
                                                </button>
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa-brands fa-whatsapp"></i>
                                                    Kirim
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let nilai = $('.nilai');
            $(document).on('click', '.nilai', function() {
                if (nilai.val() == '') {
                    nilai.val(0)
                }
                $(this).val('')
            })


            $('.tabs').on('click', function() {
                $('.selectTab').val('')
                window.history.replaceState(null, null, window.location.pathname);
            })

            // kelas
            $(document).on('change', '#kelas', function() {
                var kelas = $(this).val();
                var id_mapel = $('#id_mapel').val();
                var tgl = $('#tanggal_penilaian').val();


                window.location = "/evaluation?kelas=" + kelas + '&id_mapel=' + id_mapel + '&tgl=' + tgl;

                return false;
            })

            $(document).on('change', '#id_mapel', function() {
                var kelas = $('#kelas').val();
                var id_mapel = $(this).val();
                var tgl = $('#tanggal_penilaian').val();

                window.location = "/evaluation?kelas=" + kelas + '&id_mapel=' + id_mapel + '&tgl=' + tgl;
                return false;
            })

            $(document).on('change', '#tanggal_penilaian', function() {
                var kelas = $('#kelas').val();
                var id_mapel = $('#id_mapel').val();
                var tgl = $(this).val();

                window.location = "/evaluation?kelas=" + kelas + '&id_mapel=' + id_mapel + '&tgl=' + tgl;
                return false;
            })

            // daftar kelas
            $(document).on('change', '#kelas_daftarEvaluation', function() {
                var kelas = $('#kelas_daftarEvaluation').val();
                var mapel = $('#id_mapel_daftarEvaluation').val();
                var tgl = $('#tgl_daftarEvaluation').val();

                window.location = "/evaluation?daftar_kelas=" + kelas + "&daftar_mapel=" + mapel +
                    "&daftar_tanggal=" + tgl;
            })

            // daftar mapel
            $(document).on('change', '#id_mapel_daftarEvaluation', function() {
                var kelas = $('#kelas_daftarEvaluation').val();
                var mapel = $('#id_mapel_daftarEvaluation').val();
                var tgl = $('#tgl_daftarEvaluation').val();

                window.location = "/evaluation?daftar_kelas=" + kelas + "&daftar_mapel=" + mapel +
                    "&daftar_tanggal=" + tgl;
            })

            // daftar tanggal
            $(document).on('change', '#tgl_daftarEvaluation', function() {
                var kelas = $('#kelas_daftarEvaluation').val();
                var mapel = $('#id_mapel_daftarEvaluation').val();
                var tgl = $('#tgl_daftarEvaluation').val();

                window.location = "/evaluation?daftar_kelas=" + kelas + "&daftar_mapel=" + mapel +
                    "&daftar_tanggal=" + tgl;
            })
        })
    </script>
@endsection
