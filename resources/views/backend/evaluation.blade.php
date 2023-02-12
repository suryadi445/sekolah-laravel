@extends('layouts.admin.admin')

@section('admin')
    <form class="needs-validation" action="{{ route('evaluation.store') }}" method="post" novalidate>
        @csrf
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="offset-md-6 col-md-3 mt-1">
                                <div class="form-floating">
                                    <select class="form-select" name="id_mapel" required>
                                        <option selected disabled value="">Pilih Mata Pelajaran</option>
                                        @foreach ($mapel as $item)
                                            <option value="{{ old('id_mapel', $item->id) }}">{{ $item->mata_pelajaran }}
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
                                                    <input type="hidden" name="id_siswa[]" value="{{ $item->id }}">
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
                                                            <input type="text" class="form-control nilai" name="nilai[]"
                                                                value="0" required>
                                                        </td>
                                                        <td>
                                                            <select class="form-select" name="grade[]">
                                                                <option selected disabled value="">Pilih Grade
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
                                                                <input type="hidden" name="status[{{ $key }}]"
                                                                    value="no">
                                                                <input class="form-check-input align-middle"
                                                                    name="status[{{ $key }}]" type="checkbox"
                                                                    value="yes" checked>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif


                                            @if ($siswa->count() == 0)
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

    <script>
        $(document).ready(function() {
            let nilai = $('.nilai');

            $(document).on('click', '.nilai', function() {
                if (nilai.val() == '') {
                    nilai.val(0)
                }

                $(this).val('')
            })
        });
    </script>
@endsection
