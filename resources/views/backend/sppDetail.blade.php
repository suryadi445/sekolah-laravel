@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ route('siswa.store') }}" method="POST" class="row g-3 needs-validation"
                enctype="multipart/form-data" novalidate>
                {{ csrf_field() }}
                <div class="card mb-5 px-0">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-floating">
                                            <select class="form-select" id="tahun" name="tahun"
                                                aria-label="Floating label select example" required
                                                value="{{ old('tahun') }}">
                                                <option value="" disabled>Pilih Tahun</option>
                                                <option value="{{ date('Y') + 1 }}">{{ date('Y') + 1 }}</option>
                                                <option {{ date('Y') ? 'selected' : '' }} value="{{ date('Y') }}">
                                                    {{ date('Y') }}
                                                </option>
                                                <option value="{{ date('Y') - 1 }}">{{ date('Y') - 1 }}</option>
                                                <option value="{{ date('Y') - 2 }}">{{ date('Y') - 2 }}</option>
                                                <option value="{{ date('Y') - 3 }}">{{ date('Y') - 3 }}</option>
                                                <option value="{{ date('Y') - 4 }}">{{ date('Y') - 4 }}</option>
                                                <option value="{{ date('Y') - 5 }}">{{ date('Y') - 5 }}</option>
                                                <option value="{{ date('Y') - 6 }}">{{ date('Y') - 6 }}</option>
                                            </select>
                                            <label for="tahun">Tahun</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <ul class="list-group">
                                    <li class="list-group-item bg-secondary text-light">Data Siswa</li>
                                    <li class="list-group-item">
                                        Nis :
                                        <span class="fw-bold text-capitalize">{{ $dataSiswa[0]->nis }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        Nama Siswa :
                                        <span class="fw-bold text-capitalize">{{ $dataSiswa[0]->nama_siswa }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        Kelas :
                                        <span class="fw-bold text-capitalize">{{ $dataSiswa[0]->kelas }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        Tanggal Lahir :
                                        <span class="fw-bold text-capitalize">{{ $dataSiswa[0]->tgl_lahir }}</span>
                                    </li>
                                    <li class="list-group-item">
                                        Jenis Kelamin :
                                        <span class="fw-bold text-capitalize">{{ $dataSiswa[0]->jenis_kelamin }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-9">
                                <div class="card shadow mb-5 bg-body-tertiary rounded">
                                    <div class="card-header bg-secondary text-light">
                                        Daftar Bulan
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-3 d-grid mt-3">
                                                <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                    data-bulan="1">Januari</button>
                                            </div>
                                            <div class="col-sm-3 d-grid mt-3">
                                                <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                    data-bulan="2">Februari</button>
                                            </div>
                                            <div class="col-sm-3 d-grid mt-3">
                                                <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                    data-bulan="3">Maret</button>
                                            </div>
                                            <div class="col-sm-3 d-grid mt-3">
                                                <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                    data-bulan="4">April</button>
                                            </div>
                                            <div class="col-sm-3 d-grid mt-3">
                                                <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                    data-bulan="5">Mei</button>
                                            </div>
                                            <div class="col-sm-3 d-grid mt-3">
                                                <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                    data-bulan="6">Juni</button>
                                            </div>
                                            <div class="col-sm-3 d-grid mt-3">
                                                <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                    data-bulan="7">Juli</button>
                                            </div>
                                            <div class="col-sm-3 d-grid mt-3">
                                                <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                    data-bulan="8">Agustus</button>
                                            </div>
                                            <div class="col-sm-3 d-grid mt-3">
                                                <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                    data-bulan="9">September</button>
                                            </div>
                                            <div class="col-sm-3 d-grid mt-3">
                                                <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                    data-bulan="10">Oktober</button>
                                            </div>
                                            <div class="col-sm-3 d-grid mt-3">
                                                <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                    data-bulan="11">November</button>
                                            </div>
                                            <div class="col-sm-3 d-grid mt-3">
                                                <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                    data-bulan="12">Desember</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table
                                        class="table table-striped text-center text-capitalize table-responsive rounded rounded-1 overflow-hidden">
                                        <thead class="bg-dark text-light">
                                            <tr>
                                                <td>No</td>
                                                <td>Bulan</td>
                                                <td>Tahun</td>
                                                <td>Tipe Pembayaran</td>
                                                <td>Jenis Pembayaran</td>
                                                <td>Merchant</td>
                                                <td>Keterangan</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($dataSiswa[0]->bulan))
                                                @foreach ($dataSiswa as $key => $item)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $item->bulan }}</td>
                                                        <td>{{ $item->tahun }}</td>
                                                        <td>{{ $item->tipe_pembayaran }}</td>
                                                        <td>{{ $item->jenis_pembayaran }}</td>
                                                        <td>{{ $item->merchant }}</td>
                                                        <td>{{ $item->keterangan }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-danger">
                                                        <i class="fa-solid fa-circle-info"></i>
                                                        Data Tidak Tersedia
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.btn_bayar', function() {
                let bulan = $(this).attr('data-bulan')
                let myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});

                myModal.show();
            })
        });
    </script>
@endsection
