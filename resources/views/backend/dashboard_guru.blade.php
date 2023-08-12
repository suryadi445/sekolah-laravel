@extends('layouts.admin.admin')

@section('admin')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="card mb-5">
        <div class="card-header">
            Dashboard Guru
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-4 col-xxl-4 d-flex">
                    <div class="card flex-fill" style="background-color: #0dcaf0">
                        <div class="card-body p-0 d-flex flex-fill">
                            <div class="row g-0 w-100">
                                <div class="col-12 text-end">
                                    <div class="p-3 m-1">
                                        <button class="btn button_tab" style="background-color: #0dcaf0;" type="button"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
                                            aria-controls="offcanvasScrolling" data-id="guru">
                                            <h3 class="">{{ $absensiBulan }}</h3>
                                            <h6 class="mb-0">Jumlah Absensi</h6>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4 col-xxl-4 d-flex">
                    <div class="card flex-fill" style="background-color: #ffc107">
                        <div class="card-body p-0 d-flex flex-fill">
                            <div class="row g-0 w-100">
                                <div class="col-12 text-end">
                                    <div class=" p-3 m-1">
                                        <button class="btn button_tab" style="background-color: #ffc107;" type="button"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
                                            aria-controls="offcanvasScrolling" data-id="kelas">
                                            <h3 class="">{{ $jumlah_kelas }}</h3>
                                            <h6 class="mb-0">Jumlah Kelas</h6>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-4 col-xxl-4 d-flex">
                    <div class="card flex-fill" style="background-color: #74dc2e">
                        <div class="card-body p-0 d-flex flex-fill">
                            <div class="row g-0 w-100">
                                <div class="col-12 text-end">
                                    <div class=" p-3 m-1">
                                        <button class="btn button_tab" style="background-color: #74dc2e;" type="button"
                                            data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"
                                            aria-controls="offcanvasScrolling" data-id="siswa">
                                            <h3 class="">{{ $jumlah_siswa }}</h3>
                                            <h6 class="mb-0">Jumlah Siswa</h6>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-12">
                    <div class="row" style="min-height: 20rem">
                        <div class="col-sm-8">
                            <div class="card h-100">
                                <div class="card-header">
                                    Grafik Absensi {{ date('Y') }}
                                </div>
                                <div class="card-body">
                                    <canvas id="absensi"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    Agama Siswa
                                </div>
                                <div class="card-body">
                                    <canvas id="agama"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-capitalize" id="staticBackdropLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center text-capitalize  rounded rounded-1 overflow-hidden"
                            id="data-table" width="100%">
                            <thead class="bg-dark text-light " id="tbl_head">
                                <tr>
                                    <td>Nama Siswa</td>
                                    <td>Tanggal Lahir</td>
                                    <td>Kelas</td>
                                    <td>Sub Kelas</td>
                                    <td>Jenis Kelamin</td>
                                    <td>Alamat</td>
                                    <td>Tahun Ajaran</td>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- ajax --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal guru --}}
    <div class="modal fade" id="staticBackdropGuru" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabelGuru" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-capitalize" id="staticBackdropLabelGuru"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped text-center text-capitalize  rounded rounded-1 overflow-hidden"
                            id="data-table-guru" width="100%">
                            <thead class="bg-dark text-light " id="tbl_head">
                                <tr>
                                    <td>Nama Guru</td>
                                    <td>Tanggal Absensi</td>
                                    <td>Waktu Absensi</td>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- ajax --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
        id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-capitalize" id="offcanvasScrollingLabel">List <span id="list_tipe"></span>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" id="row_table">

        </div>

    </div>

    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {

            const spinner =
                '<div class="text-center"><div class="spinner-border text-secondary" role="status"><span class="visually-hidden">Loading...</span></div></div>';

            $('.nav-link').click(function() {
                // Hapus kelas active dari semua tombol
                $('.nav-link').removeClass('active');
                // Tambahkan kelas active pada tombol yang diklik
                $(this).addClass('active');

                // Dapatkan target tab dari atribut data-bs-target
                const targetTab = $(this).attr('data-bs-target');
                // Hapus kelas active dari semua tab konten
                $('.tab-pane').removeClass('active');
                // Tambahkan kelas active pada tab konten yang sesuai
                $(targetTab).addClass('active');
            });

            $(document).on('click', '.button_tab', function(e) {
                e.preventDefault();
                let id = $(this).attr('data-id')
                if (id == 'guru') {
                    $('#list_tipe').text('Absensi')
                } else {
                    $('#list_tipe').text(id)
                }

                $('#row_table').html(spinner)

                $.ajax({
                    type: "GET",
                    url: "/dashboard/get_data_guru?id=" + id,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        $('#row_table').html(response)
                    }
                });
            })

            $(document).on('click', '.tab_detail', function(e) {
                e.preventDefault();
                let tipe = $(this).attr('data-id')
                let id = $('#id_tipe').val()

                $('#row_table').html(spinner)

                $.ajax({
                    type: "GET",
                    url: "/dashboard/get_data_guru?id=" + id + "&tipe=" + tipe,
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);
                        $('#row_table').html(response)
                    }
                });
            })
        });
    </script>

    {{-- script datatbale --}}
    <script>
        function initializeDataTable(data) {

            $('#data-table').DataTable({
                data: data,
                columns: [{
                        data: 'nama_siswa'
                    },
                    {
                        data: 'tgl_lahir'
                    },
                    {
                        data: 'kelas'
                    },
                    {
                        data: 'sub_kelas'
                    },
                    {
                        data: 'jenis_kelamin'
                    },
                    {
                        data: 'alamat'
                    },
                    {
                        data: 'thn_ajaran'
                    },
                ],
                bDestroy: true,
                bInfo: false,
            });
        }

        function initializeDataTableGuru(data) {

            $('#data-table-guru').DataTable({
                data: data,
                columns: [{
                        data: 'nama_guru'
                    },
                    {
                        data: 'tgl_absensi'
                    },
                    {
                        data: 'created_at'
                    },
                ],
                bDestroy: true,
                bInfo: false,
            });
        }
    </script>

    <script>
        // chart absensi
        var chart_absensi = document.getElementById("absensi");
        var data_absensi = {
            labels: {{ Js::from($bulan) }},
            datasets: [{
                data: {{ Js::from($jumlah_absensi) }},
                label: "Total Absensi",
                backgroundColor: [
                    "#B70404",
                    "#B799FF",
                    "#FFB84C",
                    "#1D267D",
                    "#D291BC",
                    "#38E54D",
                    "#F86F03",
                    "#A1C2F1",
                    "#F1C27B",
                    "#1E5128",
                    "#2B2A4C",
                    "#4C4B16",
                ]
            }]
        };

        var absensiChart = new Chart(chart_absensi, {
            type: 'bar',
            data: data_absensi,
            options: {
                scales: {
                    y: {
                        beginAtZero: false, // Memulai sumbu Y dari nilai bukan 0
                        ticks: {
                            stepSize: 1, // Langkah antara setiap nilai pada sumbu Y
                            precision: 0, // Jumlah desimal yang ditampilkan pada label sumbu Y
                        },
                        // max: 35
                        max: 5
                    }
                },
                maintainAspectRatio: false,
                onClick: (event, elements, chart) => {
                    if (elements[0]) {
                        const i = elements[0].index;
                        $.ajax({
                            type: "GET",
                            url: "/dashboard/getAbsensi/" + chart.data.labels[i],
                            dataType: "json",
                            success: function(response) {
                                initializeDataTableGuru(response.data);
                            }
                        });

                        $('#staticBackdropLabelGuru').text('Absensi ' + chart.data.labels[i])
                        $('#staticBackdropGuru').modal('show')
                    }
                }
            }
        });

        // chart agama
        var chart_agama = document.getElementById("agama");
        var data_agama = {
            labels: {{ Js::from($nama_agama) }},
            datasets: [{
                data: {{ Js::from($jml_agama) }},
                label: "Agama",
                backgroundColor: [
                    "#1F8A70",
                    "#7286D3",
                    "#7B8FA1",
                    "#CD0404",
                    "#A31ACB",
                    "#FFC93C"
                ]
            }]
        };

        var agamaChart = new Chart(chart_agama, {
            type: 'pie',
            data: data_agama,
            options: {
                maintainAspectRatio: false,
                onClick: (event, elements, chart) => {
                    if (elements[0]) {
                        const i = elements[0].index;
                        $.ajax({
                            type: "GET",
                            url: "/dashboard/getAgama/" + chart.data.labels[i],
                            dataType: "json",
                            success: function(response) {
                                initializeDataTable(response.data);
                            }
                        });

                        $('#staticBackdropLabel').text('Agama ' + chart.data.labels[i])
                        $('#staticBackdrop').modal('show')
                    }
                }
            }
        });
    </script>
@endsection
