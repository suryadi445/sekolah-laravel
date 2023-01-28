@extends('layouts.admin.admin')

@section('admin')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Clients</a>
        <a href="#">Contact</a>
    </div>


    <div class="card mb-5">
        <div class="card-header">
            Dashboard Siswa
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row" style="min-height: 20rem">
                        <div class="col-sm-12">
                            <div class="card h-100">
                                <div class="card-header">
                                    Jumlah Siswa Baru
                                </div>
                                <div class="card-body">
                                    <canvas id="siswa"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mt-3">
                            <div class="card h-100">
                                <div class="card-header">
                                    Agama Siswa
                                </div>
                                <div class="card-body">
                                    <canvas id="agama"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 mt-3">
                            <div class="card h-100">
                                <div class="card-header">
                                    Jumlah Kelas Siswa
                                </div>
                                <div class="card-body">
                                    <canvas id="kelas"></canvas>
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
                        <table class="table text-center text-capitalize">
                            <thead id="tbl_head">
                                {{-- dinamis --}}
                            </thead>
                            <tbody class="table-group-divider" id="tbl_body">
                                {{-- dinamis --}}
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


    <script type="text/javascript">
        // chart agama
        var agamaCanvas = document.getElementById("agama");
        var dataList = {
            labels: {{ Js::from($nama_agama) }},
            datasets: [{
                data: {{ Js::from($jml_agama) }},
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

        var pieChart = new Chart(agamaCanvas, {
            type: 'pie',
            data: dataList,
            options: {
                maintainAspectRatio: false,
                onClick: (event, elements, chart) => {
                    if (elements[0]) {
                        const i = elements[0].index;
                        // alert(chart.data.labels[i] + ': ' + chart.data.datasets[0].data[i]);

                        $.ajax({
                            type: "GET",
                            url: "/dashboard/getAgama/" + chart.data.labels[i],
                            dataType: "json",
                            success: function(response) {
                                $('#tbl_head').html('')
                                let header = '<tr>' +
                                    '<th scope="col">Nama Siswa</th>' +
                                    '<th scope="col">Tanggal Lahir</th>' +
                                    '<th scope="col">Kelas</th>' +
                                    '<th scope="col">Jenis Kelamin</th>' +
                                    '<th scope="col">Alamat</th>' +
                                    '<th scope="col">Tahun Ajaran</th>' +
                                    '</tr>';
                                $('#tbl_head').html(header)

                                $('#tbl_body').html('')
                                var table = '';
                                for (var i = 0; i < response.length; i++) {
                                    table = '<tr>' +
                                        '<td>' + response[i].nama_siswa +
                                        '</td>' +
                                        '<td>' + response[i].tgl_lahir +
                                        '</td>' +
                                        '<td>' + response[i].kelas +
                                        '</td>' +
                                        '<td>' + response[i].jenis_kelamin +
                                        '</td>' +
                                        '<td>' + response[i].alamat +
                                        '</td>' +
                                        '<td>' + response[i].thn_ajaran +
                                        '</td>' +
                                        '</tr>';

                                    $("#tbl_body").append(table);
                                }

                            }
                        });

                        $('#staticBackdropLabel').text('Agama ' + chart.data.labels[i])
                        $('#staticBackdrop').modal('show')
                    }
                }
            }
        });



        // chart jumlah siswa
        var chart_siswa = document.getElementById("siswa").getContext('2d');
        var data_siswa = {
            datasets: [{
                    data: {{ Js::from($pria) }},
                    label: "Laki-Laki",
                    backgroundColor: [
                        '#68B984',
                        '#DAE2B6',
                        '#FFD56F',
                        '#F0997D',
                        '#FA7070',
                        '#483838',
                        '#5BB318',
                        '#3F4E4F',
                        '#B9F3FC',
                        '#554994',
                        '#678983',
                        '#f39c12',
                    ],
                },
                {
                    data: {{ Js::from($perempuan) }},
                    label: "Perempuan",
                    backgroundColor: [
                        '#61764B',
                        '#F2DEBA',
                        '#FFEFD6',
                        '#BA94D1',
                        '#FBFACD',
                        '#F5D5AE',
                        '#E8C4C4',
                        '#CE7777',
                        '#678983',
                        '#EDEDED',
                        '#F2D388',
                        '#96E5D1',
                    ],
                }
            ],
            labels: {{ Js::from($bulan) }},
        };
        var chartSiswa = new Chart(chart_siswa, {
            type: 'bar',
            data: data_siswa,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12
                    }
                },
                onClick: (e, activeEls, chart) => {
                    let datasetIndex = activeEls[0].datasetIndex;
                    let dataIndex = activeEls[0].index;
                    let jenis_kelamin = e.chart.data.datasets[datasetIndex].label;
                    let bulan = e.chart.data.labels[dataIndex];
                    let jumlah = e.chart.data.datasets[datasetIndex].data[dataIndex];

                    if (activeEls[0]) {
                        $.ajax({
                            type: "GET",
                            url: "/dashboard/getSiswa?bulan=" + bulan + '&jenis_kelamin=' +
                                jenis_kelamin,
                            dataType: "json",
                            success: function(response) {
                                $('#tbl_head').html('')
                                let header = '<tr>' +
                                    '<th scope="col">Nama Siswa</th>' +
                                    '<th scope="col">Tanggal Lahir</th>' +
                                    '<th scope="col">Kelas</th>' +
                                    '<th scope="col">Jenis Kelamin</th>' +
                                    '<th scope="col">Alamat</th>' +
                                    '<th scope="col">Tahun Ajaran</th>' +
                                    '</tr>';
                                $('#tbl_head').html(header)

                                $('#tbl_body').html('')
                                var table = '';
                                for (var i = 0; i < response.length; i++) {
                                    table = '<tr>' +
                                        '<td>' + response[i].nama_siswa +
                                        '</td>' +
                                        '<td>' + response[i].tgl_lahir +
                                        '</td>' +
                                        '<td>' + response[i].kelas +
                                        '</td>' +
                                        '<td>' + response[i].jenis_kelamin +
                                        '</td>' +
                                        '<td>' + response[i].alamat +
                                        '</td>' +
                                        '<td>' + response[i].thn_ajaran +
                                        '</td>' +
                                        '</tr>';

                                    $("#tbl_body").append(table);
                                }

                            }
                        });
                    }

                    $('#staticBackdropLabel').text('Siswa ' + jenis_kelamin)
                    $('#staticBackdrop').modal('show')
                }
            }
        });

        // chart kelas
        var chart_kelas = document.getElementById("kelas").getContext('2d');
        var data_3 = {
            datasets: [{
                data: {{ Js::from($kelas) }},
                label: "Laki-Laki",
                backgroundColor: [
                    '#68B984',
                    '#DAE2B6',
                    '#FFD56F',
                    '#F0997D',
                    '#FA7070',
                    '#483838',
                    '#5BB318',
                    '#3F4E4F',
                    '#B9F3FC',
                    '#554994',
                    '#678983',
                    '#f39c12',
                ],
            }, ],
            labels: {{ Js::from($nama_kelas) }},
        };
        var myDoughnutChart_3 = new Chart(chart_kelas, {
            type: 'pie',
            data: data_3,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12
                    }
                }
            }
        });
    </script>
@endsection
