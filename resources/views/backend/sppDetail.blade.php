@extends('layouts.admin.admin')

@section('admin')
    <div class="row">
        <div class="col-sm-12">
            <div class="card mb-5 px-0">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-floating">
                                        <select class="form-select" id="tahun" name="tahun"
                                            aria-label="Floating label select example" required value="{{ old('tahun') }}">
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
                        <div class="col-sm-3 mt-2">
                            <ul class="list-group">
                                <li class="list-group-item bg-dark text-light">Data Siswa</li>
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
                                    <span class="fw-bold text-capitalize" id="id_kelas">{{ $dataSiswa[0]->kelas }}</span>
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
                        <div class="col-sm-9 mt-2">
                            <div class="card shadow mb-5 bg-body-tertiary rounded">
                                <div class="card-header bg-dark text-light">
                                    Daftar Bulan
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                data-bulan="1">Januari</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                data-bulan="2">Februari</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                data-bulan="3">Maret</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                data-bulan="4">April</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                data-bulan="5">Mei</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                data-bulan="6">Juni</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                data-bulan="7">Juli</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                data-bulan="8">Agustus</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                data-bulan="9">September</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                data-bulan="10">Oktober</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                data-bulan="11">November</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
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
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="nama_bulan"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sppSiswa.store') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id_bulan" name="bulan">
                        <input type="hidden" class="form-control" id="id_siswa" name="id_bulan">
                        <input type="hidden" class="form-control" id="tahun" name="tahun">
                        <input type="hidden" class="form-control" id="kelas" name="kelas">
                        <table class="table align-middle">
                            <tr>
                                <td width="30%">
                                    Tipe Pembayaran
                                    <i class="text-danger">*</i>
                                </td>
                                <td>:</td>
                                <td width="70%">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_pembayaran"
                                            id="tipe_pembayaran" checked>
                                        <label class="form-check-label" for="tipe_pembayaran">
                                            Tunai
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_pembayaran"
                                            id="tipe_pembayaran2">
                                        <label class="form-check-label" for="tipe_pembayaran2">
                                            Non Tunai
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">
                                    Jenis Pembayaran
                                    <i class="text-danger">*</i>
                                </td>
                                <td>:</td>
                                <td width="70%">
                                    <select class="form-select" name="jenis_pembayaran" id="jenis_pembayaran" required>
                                        <option disabled selected value="">Pilih Jenis Pembayaran</option>
                                        <option value="Transfer Bank">Transfer Bank</option>
                                        <option value="Uang Elektronik">Uang Elektronik</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="d-none emoney">
                                <td width="30%">Merchant </td>
                                <td>:</td>
                                <td width="70%">
                                    <span class="select2-selection select2-selection--single form-control input-lg"
                                        role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                        aria-labelledby="select2-e8ez-container" style="border: 0.1px solid #ced4da;">
                                        <select class="form-select select2 bordered" name="merchant" id="merchant">
                                            <option disabled selected value="">Pilih Merchant Pembayaran</option>
                                            @foreach (namaBank() as $item)
                                                <option value="Transfer Bank">{{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                </td>
                            </tr>
                            <tr class="d-none emoney">
                                <td width="30%">Keterangan </td>
                                <td>:</td>
                                <td width="70%">
                                    <input type="text" name="keterangan" id="keterangan" class="form-control">
                                </td>
                            </tr>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".select2").select2({
                dropdownParent: $("#exampleModal"),
                theme: 'bootstrap-5',
            });

            $(document).on('change', '#jenis_pembayaran', function() {
                let value = $(this).val()

                if (value == 'Uang Elektronik') {
                    $('.emoney').removeClass('d-none')
                } else {
                    $('.emoney').addClass('d-none')
                }
            })

            $(document).on('click', '.btn_bayar', function() {
                let id_bulan = $(this).attr('data-bulan')
                let kelas = $('#id_kelas').text()
                let nama_bulan = $(this).text()
                let myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});

                $('#id_bulan').val(id_bulan)
                $('#kelas').val(kelas)
                $('#nama_bulan').text('Spp Bulan : ' + nama_bulan)

                myModal.show();
            })
        });
    </script>
@endsection
