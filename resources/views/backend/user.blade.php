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

    <div id="alert-success" class="d-none">
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success">
                    <strong class="me-auto text-light">Success</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body  bg-success text-light">
                    <span id="text-alert-success"></span>
                </div>
            </div>
        </div>
    </div>
    <div id="alert-failed" class="d-none">
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="liveToast-failed" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-danger">
                    <strong class="me-auto text-light">Error</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body  bg-danger text-light">
                    <span id="text-alert-failed"></span>
                </div>
            </div>
        </div>
    </div>

    <ul class="nav nav-pills nav-justified rounded mb-3" style="background-color: #adb5bd !important" id="myTab"
        role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs active" id="internal-tab" data-bs-toggle="tab" data-bs-target="#internal-tab-pane"
                type="button" role="tab" aria-controls="internal-tab-pane" aria-selected="true">
                Internal
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link tabs" id="eksternal-tab" data-bs-toggle="tab" data-bs-target="#eksternal-tab-pane"
                type="button" role="tab" aria-controls="eksternal-tab-pane" aria-selected="false">
                Eksternal
            </button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="internal-tab-pane" role="tabpanel" aria-labelledby="internal-tab"
            tabindex="0">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9 mt-1 mb-1">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="/user/exportPdf/internal/{{ request('aktivasi_guru') }}" id="pdfInternal"
                                            target="_blank" class="btn btn-success">
                                            <span class="me-1">Print PDF</span>
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </a>
                                        <a href="/user/exportExcel/internal/{{ request('aktivasi_guru') }}"
                                            id="excelInternal" target="_blank" class="btn btn-warning">
                                            <span class="me-1">Print Excel</span>
                                            <i class="fa-solid fa-file-excel"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-1 mb-1">
                                    <select name="status_aktivasi" class="form-select status_aktivasi_guru">
                                        <option value="" selected>
                                            Pilih Semua Data
                                        </option>
                                        <option {{ request('aktivasi_guru') == '0' ? 'selected' : '' }} value="0">Tidak
                                            Aktif</option>
                                        <option {{ request('aktivasi_guru') == '1' ? 'selected' : '' }} value="1">Aktif
                                        </option>
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
                                            <th scope="col">NIP</th>
                                            <th scope="col">Nama Guru</th>
                                            <th scope="col">Jenis Kelamin</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">Tanggal Registrasi</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($internal))
                                            @foreach ($internal as $key => $item)
                                                <input type="hidden" name="id_siswa[]" value="{{ $item->id }}">
                                                <tr>
                                                    <th>{{ $key + 1 }}</th>
                                                    <td>{{ $item->nip ?? '-' }}</td>
                                                    <td>{{ $item->nama_guru }}</td>
                                                    <td>{{ $item->jenis_kelamin }}</td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                                    <td>
                                                        <div class="form-switch">
                                                            <input class="form-check-input aktivasi_guru"
                                                                data-id={{ $item->id }} type="checkbox"
                                                                role="switch"
                                                                {{ $item->is_active == '1' ? 'checked' : '' }}>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif


                                        @if ($internal->count() == 0)
                                            <td colspan="8">
                                                <span class="text-danger">Data Tidak Tersedia </span>
                                            </td>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="eksternal-tab-pane" role="tabpanel" aria-labelledby="eksternal-tab"
            tabindex="0">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-9 mt-1 mb-1">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="/user/exportPdf/eksternal/{{ request('aktivasi_siswa') }}"
                                            id="pdfExternal" target="_blank" class="btn btn-success">
                                            <span class="me-1">Print PDF</span>
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </a>
                                        <a href="/user/exportExcel/eksternal/{{ request('aktivasi_siswa') }}"
                                            id="excelExternal" target="_blank" class="btn btn-warning">
                                            <span class="me-1">Print Excel</span>
                                            <i class="fa-solid fa-file-excel"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-1 mb-1">
                                    <select name="status_aktivasi" class="form-select status_aktivasi_siswa">
                                        <option value="">
                                            Pilih Semua Data
                                        </option>
                                        <option {{ request('aktivasi_siswa') == '0' ? 'selected' : '' }} value="0">
                                            Tidak
                                            Aktif</option>
                                        <option {{ request('aktivasi_siswa') == '1' ? 'selected' : '' }} value="1">
                                            Aktif
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="p-2 mt-2 table-responsive">
                                <table
                                    class="table table-striped text-center text-capitalize table-responsive rounded rounded-1 overflow-hidden mx-auto">
                                    <thead class="bg-dark text-light">
                                        <tr>
                                            <th scope="col">No.</th>
                                            <th scope="col">NIS</th>
                                            <th scope="col">Nama Siswa</th>
                                            <th scope="col">Nama Wali Murid</th>
                                            <th scope="col">Alamat</th>
                                            <th scope="col">No Handphone</th>
                                            <th scope="col">Tanggal Registrasi</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($eksternal))
                                            @foreach ($eksternal as $key => $item)
                                                <tr>
                                                    <th>{{ $key + 1 }}</th>
                                                    <td>{{ $item->nis }}</td>
                                                    <td>{{ $item->nama_siswa }}</td>
                                                    <td>{{ getWali($item->id) }}</td>
                                                    <td>{{ $item->alamat }}</td>
                                                    <td>{{ $item->no_hp }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                                    <td>
                                                        <div class="form-switch">
                                                            <input class="form-check-input aktivasi_wali"
                                                                data-id={{ $item->id }} type="checkbox"
                                                                role="switch"
                                                                {{ $item->is_active == '1' ? 'checked' : '' }}>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif


                                        @if ($eksternal->count() == 0)
                                            <td colspan="8">
                                                <span class="text-danger">Data Tidak Tersedia </span>
                                            </td>
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


    <script>
        $(function() {
            // tab Internal
            $(document).on('change', '.aktivasi_guru', function(e) {
                e.preventDefault()
                let id = $(this).attr('data-id')
                let value = $(this).is(':checked')

                if (value == true) {
                    value = '1'
                } else {
                    value = '0'
                }

                $.ajax({
                    type: "GET",
                    url: "/user/show?id=" + id + '&value=' + value + '&user=guru',
                    success: function(response) {
                        const toastLiveExample = document.getElementById('liveToast')
                        const toastLiveExampleFailed = document.getElementById(
                            'liveToast-failed')
                        if (response.success) {
                            $('#text-alert-success').text(response.success)
                            const toast = new bootstrap.Toast(toastLiveExample)

                            toast.show()
                            $('#alert-success').removeClass('d-none')
                        } else {
                            $('#text-alert-failed').text(response.failed)
                            const toast = new bootstrap.Toast(toastLiveExampleFailed)

                            toast.show()
                            $('#alert-failed').removeClass('d-none')
                        }
                    }
                });

            })

            // tab external
            $(document).on('change', '.aktivasi_wali', function(e) {
                e.preventDefault()
                let id = $(this).attr('data-id')
                let value = $(this).is(':checked')
                if (value == true) {
                    value = '1'
                } else {
                    value = '0'
                }

                $.ajax({
                    type: "GET",
                    url: "/user/show?id=" + id + '&value=' + value + '&user=siswa',
                    success: function(response) {
                        const toastLiveExample = document.getElementById('liveToast')
                        const toastLiveExampleFailed = document.getElementById(
                            'liveToast-failed')
                        if (response.success) {
                            $('#text-alert-success').text(response.success)
                            const toast = new bootstrap.Toast(toastLiveExample)

                            toast.show()
                            $('#alert-success').removeClass('d-none')
                        } else {
                            $('#text-alert-failed').text(response.failed)
                            const toast = new bootstrap.Toast(toastLiveExampleFailed)

                            toast.show()
                            $('#alert-failed').removeClass('d-none')
                        }
                    }
                });

            })

            $('.status_aktivasi_guru').change(function(e) {
                e.preventDefault();
                let value = $(this).val()

                // merubah url
                if (value == '') {
                    window.location = "/user";
                } else {
                    window.location = "/user?aktivasi_guru=" + value;
                }

            });

            $('.status_aktivasi_siswa').change(function(e) {
                e.preventDefault();
                let value = $(this).val()

                if (value == '') {
                    window.location = "/user";
                } else {
                    window.location = "/user?aktivasi_siswa=" + value;
                }

            });
        });
    </script>
@endsection
