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
                                            <option {{ date('Y') + 1 == request('tahun') ?? null ? 'selected' : '' }}
                                                value="{{ date('Y') + 1 }}">{{ date('Y') + 1 }}</option>
                                            <option
                                                {{ date('Y') == request('tahun') || empty(request('tahun')) ? 'selected' : '' }}
                                                value="{{ date('Y') }}">
                                                {{ date('Y') }}
                                            </option>
                                            <option {{ date('Y') - 1 == request('tahun') ?? null ? 'selected' : '' }}
                                                value="{{ date('Y') - 1 }}">
                                                {{ date('Y') - 1 }}</option>
                                            <option {{ date('Y') - 2 == request('tahun') ? 'selected' : '' }}
                                                value="{{ date('Y') - 2 }}">
                                                {{ date('Y') - 2 }}</option>
                                            <option {{ date('Y') - 3 == request('tahun') ? 'selected' : '' }}
                                                value="{{ date('Y') - 3 }}">
                                                {{ date('Y') - 3 }}</option>
                                            <option {{ date('Y') - 4 == request('tahun') ? 'selected' : '' }}
                                                value="{{ date('Y') - 4 }}">
                                                {{ date('Y') - 4 }}</option>
                                            <option {{ date('Y') - 5 == request('tahun') ? 'selected' : '' }}
                                                value="{{ date('Y') - 5 }}">
                                                {{ date('Y') - 5 }}</option>
                                            <option {{ date('Y') - 6 == request('tahun') ? 'selected' : '' }}
                                                value="{{ date('Y') - 6 }}">
                                                {{ date('Y') - 6 }}</option>
                                        </select>
                                        <label for="tahun">Tahun </label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="spp"
                                            placeholder="name@example.com" value="{{ rupiah($biodata->biaya_spp ?? '0') }}"
                                            readonly>
                                        <label for="floatingInput">SPP</label>
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
                                    <span class="fw-bold text-capitalize">{{ $biodata->nis ?? '' }}</span>
                                </li>
                                <li class="list-group-item">
                                    Nama Siswa :
                                    <span class="fw-bold text-capitalize">{{ $biodata->nama_siswa ?? '' }}</span>
                                </li>
                                <li class="list-group-item">
                                    Kelas :
                                    <span class="fw-bold text-capitalize"
                                        id="id_kelas">{{ $biodata->kelas . ' ' . $biodata->sub_kelas ?? '' }}</span>
                                </li>
                                <li class="list-group-item">
                                    Tanggal Lahir :
                                    <span class="fw-bold text-capitalize">{{ $biodata->tgl_lahir ?? '' }}</span>
                                </li>
                                <li class="list-group-item">
                                    Jenis Kelamin :
                                    <span class="fw-bold text-capitalize">{{ $biodata->jenis_kelamin ?? '' }}</span>
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
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar" data-bulan="01"
                                                id="01">Januari</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar" data-bulan="02"
                                                id="02">Februari</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar" data-bulan="03"
                                                id="03">Maret</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar" data-bulan="04"
                                                id="04">April</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar" data-bulan="05"
                                                id="05">Mei</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar" data-bulan="06"
                                                id="06">Juni</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar" data-bulan="07"
                                                id="07">Juli</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar" data-bulan="08"
                                                id="08">Agustus</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar" data-bulan="09"
                                                id="09">September</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                data-bulan="10" id="10">Oktober</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                data-bulan="11" id="11">November</button>
                                        </div>
                                        <div class="col-sm-3 d-grid mt-2">
                                            <button type="button" class="btn btn-sm btn-primary btn_bayar"
                                                data-bulan="12" id="12">Desember</button>
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
                                            <td>Tanggal Pembayaran</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($dataSiswa))
                                            @foreach ($dataSiswa as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $item->nama_bulan }}</td>
                                                    <td>{{ $item->tahun }}</td>
                                                    <td>{{ $item->tipe_pembayaran }}</td>
                                                    <td>{{ $item->jenis_pembayaran }}</td>
                                                    <td>{{ $item->jenis_pembayaran != '-' ? $item->nama_bank . ' (' . $item->no_rek . ')' : '-' }}
                                                    </td>
                                                    <td>{{ $item->keterangan ?? '-' }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-warning btn_edit"
                                                            data-id="{{ $item->id_spp }}" data-bs-toggle="modal"
                                                            data-bs-target="#modal_edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                            Edit
                                                        </button>
                                                        <form method="POST"
                                                            action="{{ route('sppSiswa.destroy', $item->id_spp) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit"
                                                                class="btn btn-sm btn-danger btn_delete mt-2">
                                                                <i class="fa-solid fa-trash"></i>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        @if (count($dataSiswa) == 0)
                                            <tr>
                                                <td colspan="9" class="text-danger">
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

    <!-- Modal Add-->
    <div class="modal fade" id="exampleModal" style="overflow:hidden;" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="nama_bulan"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sppSiswa.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id_bulan" name="bulan">
                        <input type="hidden" class="form-control" id="id_siswa" name="id_siswa"
                            value="{{ $biodata->id ?? '' }}">
                        <input type="hidden" class="form-control" id="id_tahun" name="tahun">
                        <input type="hidden" class="form-control" id="kelas" name="kelas"
                            value="{{ $biodata->id_kelas ?? '' }}">
                        <input type="hidden" class="form-control" id="nominal" name="nominal"
                            value="{{ $biodata->biaya_spp ?? '' }}">
                        <table class="table align-middle table-borderless">
                            <tr>
                                <td width="30%">
                                    Tipe Pembayaran
                                    <i class="text-danger">*</i>
                                </td>
                                <td>:</td>
                                <td width="70%">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_pembayaran"
                                            id="tipe_pembayaran" value="tunai" checked>
                                        <label class="form-check-label" for="tipe_pembayaran">
                                            Tunai
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_pembayaran"
                                            id="tipe_pembayaran2" value="non tunai">
                                        <label class="form-check-label" for="tipe_pembayaran2">
                                            Non Tunai
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-none emoney">
                                <td width="30%">
                                    Jenis Pembayaran
                                    <i class="text-danger">*</i>
                                </td>
                                <td>:</td>
                                <td width="70%">
                                    <select class="form-select" name="jenis_pembayaran" id="jenis_pembayaran">
                                        <option disabled selected value="">Pilih Jenis Pembayaran</option>
                                        <option value="Bank">Transfer Bank</option>
                                        <option value="Uang Elektronik">Uang Elektronik</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="d-none emoney">
                                <td width="30%">Merchant </td>
                                <td>:</td>
                                <td width="70%">
                                    <select class="form-select" name="merchant" id="merchant">
                                        <option disabled selected value="">
                                            Pilih Merchant Pembayaran
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
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

    {{-- modal edit --}}
    <div class="modal fade" id="modal_edit" style="overflow:hidden;" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="nama_bulan_edit"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sppSiswa.store') }}" method="post" id="form_edit">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id_edit" name="id">
                        <input type="hidden" class="form-control" id="bulan_edit" name="bulan">
                        <input type="hidden" class="form-control" id="siswa_edit" name="id_siswa">
                        <input type="hidden" class="form-control" id="tahun_edit" name="tahun">
                        <input type="hidden" class="form-control" id="kelas_edit" name="kelas">
                        <input type="hidden" class="form-control" id="nominal_edit" name="nominal">
                        <table class="table align-middle table-borderless">
                            <tr>
                                <td width="30%">
                                    Tipe Pembayaran
                                    <i class="text-danger">*</i>
                                </td>
                                <td>:</td>
                                <td width="70%">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_pembayaran"
                                            id="tipe_pembayaran_edit" value="tunai">
                                        <label class="form-check-label" for="tipe_pembayaran_edit">
                                            Tunai
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="tipe_pembayaran"
                                            id="tipe_pembayaran2_edit" value="non tunai">
                                        <label class="form-check-label" for="tipe_pembayaran2_edit">
                                            Non Tunai
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="d-none emoney">
                                <td width="30%">
                                    Jenis Pembayaran
                                    <i class="text-danger">*</i>
                                </td>
                                <td>:</td>
                                <td width="70%">
                                    <select class="form-select" name="jenis_pembayaran" id="jenis_pembayaran_edit">
                                        <option disabled selected value="">Pilih Jenis Pembayaran</option>
                                        <option value="Bank">Transfer Bank</option>
                                        <option value="Uang Elektronik">Uang Elektronik</option>
                                    </select>
                                </td>
                            </tr>
                            <tr class="d-none emoney">
                                <td width="30%">Merchant </td>
                                <td>:</td>
                                <td width="70%">
                                    <select class="form-select" name="merchant" id="merchant_edit" disabled>
                                        @foreach ($payment as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->nama . ' (' . $item->nomor . ')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Keterangan </td>
                                <td>:</td>
                                <td width="70%">
                                    <input type="text" name="keterangan" id="keterangan_edit" class="form-control">
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

            let id_tahun = $('#tahun').val()
            let id_siswa = {{ Request::segment(3) }}

            $.ajax({
                type: "GET",
                url: "/sppSiswa/cekPembayaran?tahun=" + id_tahun + '&id_siswa=' + id_siswa,
                dataType: "JSON",
                success: function(res) {
                    $.each(res, function(key, value) {
                        $("#" + value.bulan).addClass('disabled')
                    });
                }
            });

            $(document).on('change', '#tahun', function() {
                var tahun = $(this).val();
                var url = window.location.pathname;

                window.location = url + '?tahun=' + tahun;
            })

            $('input[name="tipe_pembayaran"]').change(function() {
                let value = $(this).val()

                if (value == 'non tunai') {
                    $('.emoney').removeClass('d-none')
                } else {
                    $('.emoney').addClass('d-none')
                    $('#jenis_pembayaran').val('')
                    $('#merchant').val('')
                    $('#jenis_pembayaran_edit').val('')
                    $('#merchant_edit').val('')
                }
            });

            $('#jenis_pembayaran').on('change', function() {
                let jenis_pembayaran = $(this).val()
                $('#merchant').find('option').not(':first').remove();
                $.ajax({
                    type: "GET",
                    url: "/sppSiswa/getPembayaran" + '?jenis_pembayaran=' +
                        jenis_pembayaran,
                    dataType: "JSON",
                    success: function(response) {
                        $.each(response, function(key, value) {
                            $('#merchant').append($('<option>', {
                                value: value.id,
                                text: value.nama
                            }));
                        });
                    }
                })
            });

            $('#jenis_pembayaran_edit').on('change', function() {
                let jenis_pembayaran = $(this).val()
                $('#merchant_edit').find('option').remove();
                $('#merchant_edit').html(
                    `<option disabled selected value="" value="">Pilih Merchant Pembayaran</option>`);
                $.ajax({
                    type: "GET",
                    url: "/sppSiswa/getPembayaran" + '?jenis_pembayaran=' +
                        jenis_pembayaran,
                    dataType: "JSON",
                    success: function(response) {
                        $('#merchant_edit').removeAttr('disabled')
                        $.each(response, function(key, value) {
                            $('#merchant_edit').append($('<option>', {
                                value: value.id,
                                text: value.nama
                            }));
                        });
                    }
                })
            });

            $(document).on('click', '.btn_bayar', function() {
                let id_bulan = $(this).attr('data-bulan')
                let id_tahun = $('#tahun').val()
                let spp = $('#spp').val()
                let nama_bulan = $(this).text()
                let myModal = new bootstrap.Modal(document.getElementById("exampleModal"), {});

                $('.emoney').addClass('d-none')
                $("#tipe_pembayaran").prop("checked", true);
                $('#id_bulan').val(id_bulan)
                $('#id_tahun').val(id_tahun)
                $('#nama_bulan').html('Spp Bulan : ' + nama_bulan + ' <small>(Rp. ' + spp + ')</small>')

                myModal.show();
            })

            $(document).on('click', '.btn_edit', function() {
                var id = $(this).attr('data-id')
                let spp = $('#spp').val()

                $.get("{{ route('sppSiswa.index') }}" + '/' + id + '/edit', function(
                    data) {
                    $('#nama_bulan_edit').html(data.nama_bulan + ' <small>(Rp. ' + spp +
                        ')</small>')
                    $('#id_edit').val(data.id)
                    $('#bulan_edit').val(data.bulan)
                    $('#siswa_edit').val(data.id_siswa)
                    $('#kelas_edit').val(data.id_kelas)
                    $('#bulan_edit').val(data.bulan)
                    $('#tahun_edit').val(data.tahun)
                    $('#nominal_edit').val(data.nominal)
                    $('#keterangan_edit').val(data.keterangan)
                    if (data.tipe_pembayaran === "tunai") {
                        $("#tipe_pembayaran_edit").prop("checked", true);
                        $('.emoney').addClass('d-none')
                        $('#jenis_pembayaran_edit').val('')
                        $('#merchant_edit').val('')
                    } else if (data.tipe_pembayaran === "non tunai") {
                        $("#tipe_pembayaran2_edit").prop("checked", true);
                        $('.emoney').removeClass('d-none')
                        $('#jenis_pembayaran_edit').val(data.jenis_pembayaran)
                        $('#merchant_edit').val(data.merchant)

                    }
                    $('#form_edit').attr('action', "{{ route('sppSiswa.index') }}" + '/' + id);

                })
            })

            $(document).on('click', '.btn_delete', function(e) {
                e.preventDefault()
                var form = $(this).closest("form");


                Swal.fire({
                    title: 'Are you sure?',
                    text: "Data tidak bisa dikembalikan!",
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
