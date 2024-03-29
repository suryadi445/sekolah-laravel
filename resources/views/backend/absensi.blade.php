@extends('layouts.admin.admin')

@section('admin')

    <ul class="nav nav-pills nav-justified rounded mb-3" style="background-color: #adb5bd !important" id="myTab"
        role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs active" id="absensi-tab" data-bs-toggle="tab" data-bs-target="#absensi-tab-pane"
                type="button" role="tab" aria-controls="absensi-tab-pane" aria-selected="true">
                Absensi
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs" id="list-tab" data-bs-toggle="tab" data-bs-target="#list-tab-pane" type="button"
                role="tab" aria-controls="list-tab-pane" aria-selected="false">
                Daftar Absensi
            </button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="absensi-tab-pane" role="tabpanel" aria-labelledby="absensi-tab"
            tabindex="0">
            <form action="{{ route('absensi.store') }}" class="needs-validation" novalidate method="post">
                @csrf
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="btn-group w-100" role="group" aria-label="Basic example">
                                            <a href="/absensi/exportPdf?kelas={{ request('kelas') . '&tipe=absensi' . '&tgl_absensi=' . request('tgl_absensi') . '&id_mapel=' . request('id_mapel') . '&thn_ajaran=' . request('thn_ajaran') }}"
                                                target="_blank" class="btn btn-success">
                                                <span class="me-1">Print PDF</span>
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </a>
                                            <a href="/absensi/exportExcel?kelas={{ request('kelas') . '&tipe=absensi' . '&tgl_absensi=' . request('tgl_absensi') . '&id_mapel=' . request('id_mapel') . '&thn_ajaran=' . request('thn_ajaran') }}"
                                                target="_blank" class="btn btn-warning">
                                                <span class="me-1">Print Excel</span>
                                                <i class="fa-solid fa-file-excel"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="thn_ajaran" id="thn_ajaran_absensi" class="form-select selectTab">
                                            <option value="{{ $ajaran_awal . '-' . $ajaran_akhir }}" selected>
                                                {{ 'Tahun Ajaran : ' . $ajaran_awal . '-' . $ajaran_akhir }}
                                            </option>
                                            <option
                                                {{ request('thn_ajaran') == $ajaran_awal - 1 . '-' . $ajaran_akhir - 1 ? 'selected' : '' }}
                                                value="{{ $ajaran_awal - 1 . '-' . $ajaran_akhir - 1 }}">
                                                {{ 'Tahun Ajaran : ' . $ajaran_awal - 1 . '-' . $ajaran_akhir - 1 }}
                                            </option>
                                            <option
                                                {{ request('thn_ajaran') == $ajaran_awal - 2 . '-' . $ajaran_akhir - 2 ? 'selected' : '' }}
                                                value="{{ $ajaran_awal - 2 . '-' . $ajaran_akhir - 2 }}">
                                                {{ 'Tahun Ajaran : ' . $ajaran_awal - 2 . '-' . $ajaran_akhir - 2 }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-3 mt-1 mb-1">
                                        <input type="date" class="form-control" name="tgl_absensi" id="tgl_absensi"
                                            value="{{ request('tgl_absensi') ? request('tgl_absensi') : '' }}" required>
                                    </div>
                                    <div class="col-md-3 mt-1 mb-1">
                                        <select name="id_mapel" id="id_mapel" class="form-select selectTab" required>
                                            <option value="" disabled selected>
                                                Pilih Mata Pelajaran
                                            </option>
                                            @foreach ($mapel as $item)
                                                <option {{ request('id_mapel') == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->mata_pelajaran }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="offset-md-3 col-md-3 mt-1 mb-1">
                                        <select name="kelas" id="kelas" class="form-select selectTab" required>
                                            <option value="" selected>Semua Kelas</option>
                                            @foreach ($kelas as $item)
                                                <option
                                                    {{ request('kelas') == $item->kelas . ' ' . $item->sub_kelas ? 'selected' : '' }}
                                                    value="{{ $item->kelas . ' ' . $item->sub_kelas }}">
                                                    {{ $item->kelas . ' ' . $item->sub_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="p-2 mt-2 table-responsive">
                                    <table
                                        class="table table-striped text-center text-capitalize table-responsive rounded rounded-1 overflow-hidden">
                                        <thead class="bg-dark text-light">
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Kelas</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">Nama Siswa</th>
                                                <th scope="col">Jenis Kelamin</th>
                                                <th scope="col">Action</th>
                                                <th scope="col">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($siswa))
                                                @foreach ($siswa as $key => $item)
                                                    <input type="hidden" name="id_siswa[]" value="{{ $item->id }}">
                                                    <tr>
                                                        <th>{{ $key + 1 }}</th>
                                                        <td>{{ $item->kelas . ' ' . $item->sub_kelas }}</td>
                                                        <td>{{ $item->nis }}</td>
                                                        <td>{{ $item->nama_siswa }}</td>
                                                        <td>{{ $item->jenis_kelamin }}</td>
                                                        <td>
                                                            <div>
                                                                <input type="hidden" name="absensi[{{ $key }}]"
                                                                    value="no">
                                                                <input class="form-check-input align-middle absensi"
                                                                    name="absensi[{{ $key }}]" type="checkbox"
                                                                    value="yes">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <select name="keterangan[{{ $key }}]"
                                                                class="form-select">
                                                                <option value="" selected>Pilih Keterangan</option>
                                                                <option value="Sakit">Sakit</option>
                                                                <option value="Izin">Izin</option>
                                                                <option value="Alpha">Alpha</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif


                                            @if (count($siswa) == 0)
                                                <td colspan="8">
                                                    <span class="text-danger">Data Tidak Tersedia </span>
                                                </td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer py-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="list-tab-pane" role="tabpanel" aria-labelledby="list-tab" tabindex="0">
            <form action="{{ route('absensi.update', $cek_absensi->id ?? '') }}" class="needs-validation" novalidate
                method="post">
                @csrf
                @method('PUT')
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="btn-group w-100" role="group" aria-label="Basic example">
                                            <a href="/absensi/exportPdf?kelas={{ request('daftar_kelas') . '&tipe=list' . '&daftar_tanggal=' . request('daftar_tanggal') . '&daftar_mapel=' . request('daftar_mapel') . '&thn_ajaran=' . request('thn_ajaran') }}"
                                                target="_blank" class="btn btn-success">
                                                <span class="me-1">Print PDF</span>
                                                <i class="fa-solid fa-file-pdf"></i>
                                            </a>
                                            <a href="/absensi/exportExcel?kelas={{ request('daftar_kelas') . '&tipe=list' . '&daftar_tanggal=' . request('daftar_tanggal') . '&daftar_mapel=' . request('daftar_mapel') . '&thn_ajaran=' . request('thn_ajaran') }}"
                                                target="_blank" class="btn btn-warning">
                                                <span class="me-1">Print Excel</span>
                                                <i class="fa-solid fa-file-excel"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <select name="thn_ajaran" id="thn_ajaran_daftarAbsensi"
                                            class="form-select selectTab">
                                            <option value="{{ $ajaran_awal . '-' . $ajaran_akhir }}" selected>
                                                {{ 'Tahun Ajaran : ' . $ajaran_awal . '-' . $ajaran_akhir }}
                                            </option>
                                            <option
                                                {{ request('thn_ajaran') == $ajaran_awal - 1 . '-' . $ajaran_akhir - 1 ? 'selected' : '' }}
                                                value="{{ $ajaran_awal - 1 . '-' . $ajaran_akhir - 1 }}">
                                                {{ 'Tahun Ajaran : ' . $ajaran_awal - 1 . '-' . $ajaran_akhir - 1 }}
                                            </option>
                                            <option
                                                {{ request('thn_ajaran') == $ajaran_awal - 2 . '-' . $ajaran_akhir - 2 ? 'selected' : '' }}
                                                value="{{ $ajaran_awal - 2 . '-' . $ajaran_akhir - 2 }}">
                                                {{ 'Tahun Ajaran : ' . $ajaran_awal - 2 . '-' . $ajaran_akhir - 2 }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-3 mt-1 mb-1">
                                        <input type="date" class="form-control" name="tgl_absensi"
                                            id="tgl_daftarAbsensi"
                                            value="{{ request('daftar_tanggal') ? request('daftar_tanggal') : '' }}">
                                    </div>
                                    <div class="col-md-3 mt-1 mb-1">
                                        <select name="id_mapel" id="id_mapel_daftarAbsensi" class="form-select selectTab"
                                            required>
                                            <option value="" selected>
                                                Pilih Mata Pelajaran
                                            </option>
                                            @foreach ($mapel as $item)
                                                <option {{ request('daftar_mapel') == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->mata_pelajaran }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="offset-md-3 col-md-3 mt-1 mb-1">
                                        <select name="kelas" id="kelas_daftarAbsensi" class="form-select selectTab"
                                            required>
                                            <option value="" selected>Pilih Kelas</option>
                                            @foreach ($kelas as $item)
                                                <option
                                                    {{ request('daftar_kelas') == $item->kelas . ' ' . $item->sub_kelas ? 'selected' : '' }}
                                                    value="{{ $item->kelas . ' ' . $item->sub_kelas }}">
                                                    {{ $item->kelas . ' ' . $item->sub_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row container">
                                    <div class="col-sm-3">
                                        <span class="d-block">Siswa Masuk : {{ $jumlah_siswa['masuk'] }} </span>
                                        <span class="d-block">Siswa Sakit : {{ $jumlah_siswa['sakit'] }} </span>
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="d-block">Siswa Izin : {{ $jumlah_siswa['izin'] }} </span>
                                        <span class="d-block">Siswa Alpha : {{ $jumlah_siswa['alpha'] }}</span>
                                    </div>
                                </div>
                                <div class="p-2 mt-2 table-responsive">
                                    <table
                                        class="table table-striped text-center text-capitalize table-responsive rounded rounded-1 overflow-hidden">
                                        <thead class="bg-dark text-light">
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">NIS</th>
                                                <th scope="col">Nama Siswa</th>
                                                <th scope="col">Jenis Kelamin</th>
                                                <th scope="col">Action</th>
                                                <th scope="col">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($absensi))
                                                @foreach ($absensi as $key => $item)
                                                    <input type="hidden" name="id_absensi[]"
                                                        value="{{ $item->id }}">
                                                    <input type="hidden" name="id_siswa[]"
                                                        value="{{ $item->id_siswa }}">
                                                    <tr>
                                                        <th>{{ $key + 1 }}</th>
                                                        <td>{{ $item->nis }}</td>
                                                        <td>{{ $item->nama_siswa }}</td>
                                                        <td>{{ $item->jenis_kelamin }}</td>
                                                        <td>
                                                            <div>
                                                                <input type="hidden" name="absensi[{{ $key }}]"
                                                                    value="no">
                                                                <input class="form-check-input align-middle"
                                                                    name="absensi[{{ $key }}]" type="checkbox"
                                                                    value="yes"
                                                                    {{ $item->absensi == 'yes' ? 'checked' : '' }}>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <select name="keterangan[]" id="keterangan"
                                                                class="form-select">
                                                                <option {{ $item->keterangan == '' ? 'selected' : '' }}
                                                                    value="">
                                                                    Pilih Keterangan</option>
                                                                <option
                                                                    {{ $item->keterangan == 'Sakit' ? 'selected' : '' }}
                                                                    value="Sakit">Sakit</option>
                                                                <option {{ $item->keterangan == 'Izin' ? 'selected' : '' }}
                                                                    value="Izin">Izin</option>
                                                                <option
                                                                    {{ $item->keterangan == 'Alpha' ? 'selected' : '' }}
                                                                    value="Alpha">Alpha</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif


                                            @if ($absensi->count() == 0)
                                                <td colspan="8">
                                                    <span class="text-danger">Data Tidak Tersedia </span>
                                                </td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer py-2">
                                <button type="submit" class="btn btn-primary {{ $cek_absensi ? '' : 'disabled' }}">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script>
        $(function() {

            $('.tabs').on('click', function() {
                $('.selectTab').val('')
                window.history.replaceState(null, null, window.location.pathname);
            })

            $('#absensi-tab').on('click', function() {
                $('#thn_ajaran_absensi option:first').prop('selected', true);
            })

            $('#list-tab').on('click', function() {
                $('#thn_ajaran_daftarAbsensi option:first').prop('selected', true);
            })

            // absensi
            $(document).on('change', '#kelas', function() {
                var kelas = $(this).val();
                var id_mapel = $('#id_mapel').val();
                var tgl_absensi = $('#tgl_absensi').val();
                window.location = "/absensi?kelas=" + kelas + '&id_mapel=' + id_mapel + '&tgl_absensi=' +
                    tgl_absensi;
            })

            $(document).on('change', '#id_mapel', function() {
                var id_mapel = $(this).val();
                var tgl_absensi = $('#tgl_absensi').val();
                var kelas = $('#kelas').val();
                window.location = "/absensi?kelas=" + kelas + '&id_mapel=' + id_mapel + '&tgl_absensi=' +
                    tgl_absensi;
            })

            $(document).on('change', '#tgl_absensi', function() {
                var tgl_absensi = $(this).val();
                var kelas = $('#kelas').val();
                var id_mapel = $('#id_mapel').val();
                window.location = "/absensi?kelas=" + kelas + '&id_mapel=' + id_mapel + '&tgl_absensi=' +
                    tgl_absensi;
            })

            $(document).on('change', '#thn_ajaran_absensi', function() {
                var thn_ajaran_daftarAbsensi = $(this).val();
                window.location = "/absensi?thn_ajaran=" + thn_ajaran_daftarAbsensi;
            })

            // daftar absensi
            $(document).on('change', '#thn_ajaran_daftarAbsensi', function() {
                var thn_ajaran_daftarAbsensi = $(this).val();
                window.location = "/absensi?thn_ajaran=" + thn_ajaran_daftarAbsensi;
            })

            $(document).on('change', '#kelas_daftarAbsensi', function() {
                var kelas = $('#kelas_daftarAbsensi').val();
                var mapel = $('#id_mapel_daftarAbsensi').val();
                var thn_ajaran_daftarAbsensi = $('#thn_ajaran_daftarAbsensi').val();
                var tgl = $('#tgl_daftarAbsensi').val();


                window.location = "/absensi?daftar_kelas=" + kelas + "&daftar_mapel=" + mapel +
                    "&daftar_tanggal=" + tgl + "&thn_ajaran=" + thn_ajaran_daftarAbsensi;
            })

            $(document).on('change', '#id_mapel_daftarAbsensi', function() {
                var kelas = $('#kelas_daftarAbsensi').val();
                var mapel = $('#id_mapel_daftarAbsensi').val();
                var thn_ajaran_daftarAbsensi = $('#thn_ajaran_daftarAbsensi').val();
                var tgl = $('#tgl_daftarAbsensi').val();

                window.location = "/absensi?daftar_kelas=" + kelas + "&daftar_mapel=" + mapel +
                    "&daftar_tanggal=" + tgl + "&thn_ajaran=" + thn_ajaran_daftarAbsensi;
            })

            $(document).on('change', '#tgl_daftarAbsensi', function() {
                var kelas = $('#kelas_daftarAbsensi').val();
                var mapel = $('#id_mapel_daftarAbsensi').val();
                var thn_ajaran_daftarAbsensi = $('#thn_ajaran_daftarAbsensi').val();
                var tgl = $('#tgl_daftarAbsensi').val();


                window.location = "/absensi?daftar_kelas=" + kelas + "&daftar_mapel=" + mapel +
                    "&daftar_tanggal=" + tgl + "&thn_ajaran=" + thn_ajaran_daftarAbsensi;
            })


            $(document).on('click', '.btn_delete', function(e) {
                e.preventDefault()
                var form = $(this).closest("form");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Data Tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6e7881',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {

                        form.submit();

                    }
                })
            })
        });
    </script>
@endsection
