@extends('layouts.admin.admin')

@section('admin')
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group" role="group">
                                <a href="/promoted/exportPdf/{{ request()->segment(3) . '/' . request()->segment(4) . '/' . 'detail' }}"
                                    id="printPdf" target="_blank" class="btn btn-success">
                                    <span class="me-1">Print PDF</span>
                                    <i class="fa-solid fa-file-pdf"></i>
                                </a>
                                <a href="/promoted/exportExcel/{{ request()->segment(3) . '/' . request()->segment(4) . '/' . 'detail' }}"
                                    id="printExcel" target="_blank" class="btn btn-warning">
                                    <span class="me-1">Print Excel</span>
                                    <i class="fa-solid fa-file-excel"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 mt-2 table-responsive">
                    <form action="/promoted/store" method="POST" class="row g-3">
                        @csrf
                        <input type="hidden" name="kelas" value="{{ Request::segment(3) }}">
                        <input type="hidden" name="sub_kelas" value="{{ Request::segment(4) }}">
                        <table
                            class="table table-striped text-center text-capitalize table-responsive rounded rounded-1 overflow-hidden data-table"
                            width="100%">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Tempat Tanggal Lahir</th>
                                    <th scope="col">Agama</th>
                                    <th scope="col">Nis</th>
                                    <th scope="col">Nisn</th>
                                    <th scope="col">Naik Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($siswas) > 0)
                                    @foreach ($siswas as $key => $item)
                                        <tr>
                                            <td class="{{ $item->status == 'no' ? 'text-danger' : '' }}">{{ $key + 1 }}
                                            </td>
                                            <td class="{{ $item->status == 'no' ? 'text-danger' : '' }}">
                                                {{ $item->nama_siswa }}</td>
                                            <td class="{{ $item->status == 'no' ? 'text-danger' : '' }}">
                                                {{ $item->jenis_kelamin }}</td>
                                            <td class="{{ $item->status == 'no' ? 'text-danger' : '' }}">
                                                {{ $item->tempat_lahir . ', ' . $item->tgl_lahir }}</td>
                                            <td class="{{ $item->status == 'no' ? 'text-danger' : '' }}">
                                                {{ $item->agama }}</td>
                                            <td class="{{ $item->status == 'no' ? 'text-danger' : '' }}">
                                                {{ $item->nis ?? '-' }}</td>
                                            <td class="{{ $item->status == 'no' ? 'text-danger' : '' }}">
                                                {{ $item->nisn ?? '-' }}</td>
                                            <td>
                                                <div>
                                                    <input type="hidden" name="id_siswa[]" value="{{ $item->id }}">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="status[{{ $key }}]"
                                                            id="flexRadioDefault{{ $key }}" value="yes"
                                                            {{ $item->status == 'yes' || $item->status == '' ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="flexRadioDefault{{ $key }}">
                                                            Naik Kelas
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="status[{{ $key }}]"
                                                            id="flexRadioDefault{{ $key }}" value="no"
                                                            {{ $item->status == 'no' ? 'checked' : '' }}>
                                                        <label
                                                            class="form-check-label {{ $item->status == 'no' ? 'text-danger' : '' }}"
                                                            for="flexRadioDefault{{ $key }}">
                                                            Tidak Naik
                                                        </label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="100%">
                                            Data Tidal Tersedia
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        @if (count($siswas) > 0 && empty($cekNaikKelas))
                            <button type="submit" class="btn btn-primary" id="kirim">Simpan</button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#kirim').on('click', function(e) {
                e.preventDefault()
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: 'Semua siswa akan berubah kelas!',
                    showDenyButton: true,
                    icon: 'info',
                    confirmButtonText: 'Simpan',
                    denyButtonText: 'Batal',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $(this).parent('form').trigger('submit')

                    }
                })
            })
        });
    </script>
@endsection
