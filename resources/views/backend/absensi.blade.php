@extends('layouts.admin.admin')

@section('admin')
    <style>
        .tabs.active {
            background-color: #adb5bd !important;
            padding-bottom: 10px;
            font-size: 115%;
            text-transform: uppercase;
            color: #0d6efd !important;
            font-weight: bolder;
            text-shadow: 1px 1px rgb(193, 193, 193);
            border-bottom: 2px solid #0d6efd;
            border-bottom-right-radius: 0px !important;
            border-bottom-left-radius: 0px !important;
        }

        .tabs {
            background-color: #adb5bd !important;
            padding-bottom: 10px;
            color: black !important;
        }
    </style>

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
                                    <div class="col-md-3 mt-1 mb-1">
                                        <input type="date" class="form-control" name="tgl_absensi"
                                            value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-md-3 mt-1 mb-1">
                                        <select name="id_mapel" id="id_mapel" class="form-select" required>
                                            <option value="" disabled selected>Pilih Mata Pelajaran</option>
                                            @foreach ($mapel as $item)
                                                <option value="{{ $item->id }}">{{ $item->mata_pelajaran }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="offset-md-3 col-md-3 mt-1 mb-1">
                                        <select name="kelas" id="kelas" class="form-select" required>
                                            <option value="" disabled selected>Pilih Kelas</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}">{{ $item->sub_kelas }}</option>
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


                                            @if ($siswa->count() == 0)
                                                <td colspan="8">
                                                    <span class="text-danger">Data Tidak Tersedia </span>
                                                </td>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer py-2">
                                <a href="{{ route('siswa.create') }}" class="btn btn-success">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    Kirim Pesan
                                </a>
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
                                    <div class="col-md-3 mt-1 mb-1">
                                        <input type="date" class="form-control" name="tgl_absensi"
                                            value="{{ date('Y-m-d') }}" required>
                                    </div>
                                    <div class="col-md-3 mt-1 mb-1">
                                        <select name="id_mapel" id="id_mapel" class="form-select" required>
                                            <option value="" disabled selected>Pilih Mata Pelajaran</option>
                                            @foreach ($mapel as $item)
                                                <option {{ $cek_absensi->id_mapel ?? '' == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->mata_pelajaran }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="offset-md-3 col-md-3 mt-1 mb-1">
                                        <select name="kelas" id="kelas" class="form-select" required>
                                            <option value="" selected disabled>Pilih Kelas</option>
                                            @foreach ($kelas as $item)
                                                <option {{ $cek_absensi->kelas ?? '' == $item->id ? 'selected' : '' }}
                                                    value="{{ $item->id }}">{{ $item->sub_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row container">
                                    <div class="col-sm-3">
                                        <span class="d-block">Siswa Masuk : </span>
                                        <span class="d-block">Siswa Sakit : </span>
                                    </div>
                                    <div class="col-sm-3">
                                        <span class="d-block">Siswa Izin : </span>
                                        <span class="d-block">Siswa Alpha : </span>
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
                                                                    value="">Pilih Keterangan</option>
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
                                <a href="{{ route('siswa.create') }}"
                                    class="btn btn-success {{ $cek_absensi ? '' : 'disabled' }}">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    Kirim Pesan
                                </a>
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
