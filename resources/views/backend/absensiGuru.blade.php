@extends('layouts.admin.admin')

@section('admin')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a href="/absensi_guru/exportPdf/{{ request('bulan') }}" target="_blank" class="btn btn-success">
                            <span class="me-1">Print PDF</span>
                            <i class="fa-solid fa-file-pdf"></i>
                        </a>
                        <a href="/absensi_guru/exportExcel/{{ request('bulan') }}" target="_blank" class="btn btn-warning">
                            <span class="me-1">Print Excel</span>
                            <i class="fa-solid fa-file-excel"></i>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-select" id="bulan" name="bulan">
                        <option value="">Pilih Bulan</option>
                        <option {{ request('bulan') == '1' ? 'selected' : '' }} value="1">
                            Januari
                        </option>
                        <option {{ request('bulan') == '2' ? 'selected' : '' }} value="2">
                            Februari
                        </option>
                        <option {{ request('bulan') == '3' ? 'selected' : '' }} value="3">
                            Maret
                        </option>
                        <option {{ request('bulan') == '4' ? 'selected' : '' }} value="4">
                            April
                        </option>
                        <option {{ request('bulan') == '5' ? 'selected' : '' }} value="5">
                            Mei
                        </option>
                        <option {{ request('bulan') == '6' ? 'selected' : '' }} value="6">
                            Juni
                        </option>
                        <option {{ request('bulan') == '7' ? 'selected' : '' }} value="7">
                            Juli
                        </option>
                        <option {{ request('bulan') == '8' ? 'selected' : '' }} value="8">
                            Agustus
                        </option>
                        <option {{ request('bulan') == '9' ? 'selected' : '' }} value="9">
                            September
                        </option>
                        <option {{ request('bulan') == '10' ? 'selected' : '' }} value="10">
                            Oktober
                        </option>
                        <option {{ request('bulan') == '11' ? 'selected' : '' }} value="11">
                            November
                        </option>
                        <option {{ request('bulan') == '12' ? 'selected' : '' }} value="12">
                            Desember
                        </option>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table
                            class="table table-striped text-center text-capitalize table-responsive rounded rounded-1 overflow-hidden">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">NIK</th>
                                    <th scope="col">Hari</th>
                                    <th scope="col">Tanggal Absensi</th>
                                    <th scope="col">Jam Absensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($absensi))
                                    @foreach ($absensi as $key => $item)
                                        <tr>
                                            <td class="{{ hari($item->created_at) == 'Minggu' ? 'text-danger' : '' }}">
                                                {{ $key + 1 }}
                                            </td>
                                            <td class="{{ hari($item->created_at) == 'Minggu' ? 'text-danger' : '' }}">
                                                {{ $item->nama_guru }}
                                            </td>
                                            <td class="{{ hari($item->created_at) == 'Minggu' ? 'text-danger' : '' }}">
                                                {{ $item->nik }}
                                            </td>
                                            <td class="{{ hari($item->created_at) == 'Minggu' ? 'text-danger' : '' }}">
                                                {{ hari($item->created_at) }}
                                            </td>
                                            <td class="{{ hari($item->created_at) == 'Minggu' ? 'text-danger' : '' }}">
                                                {{ $item->tgl_absensi }}
                                            </td>
                                            <td class="{{ hari($item->created_at) == 'Minggu' ? 'text-danger' : '' }}">
                                                {{ jam($item->created_at) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif


                                @if (count($absensi) == 0)
                                    <td colspan="8">
                                        <span class="text-danger">Data Tidak Tersedia </span>
                                    </td>
                                @endif
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {!! $absensi->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {

            $(document).on('change', '#bulan', function() {
                var bulan = $(this).val();

                window.location = "/absensi_guru?bulan=" + bulan;
            })
        });
    </script>
@endsection
