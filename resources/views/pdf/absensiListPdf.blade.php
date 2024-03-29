<!DOCTYPE html>
<html>

<head>
    <title>Print PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        @page {
            size: landscape;
        }
    </style>
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 10px;
            padding: 0 !important;
            margin: 0 !important;
        }
    </style>

    <div class="row mb-3">
        <div class="col-sm-12">
            <h3 class="text-center">{{ $title }}</h3>
        </div>
    </div>

    <table class="table table-bordered text-center" style="table-layout:fixed;">
        <thead class="p-0">
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Jumlah Masuk</th>
                <th>Jumlah Tidak Masuk</th>
                <th>Jumlah Sakit</th>
                <th>Jumlah Izin</th>
                <th>Jumlah Alpha</th>
                <th>Tanpa Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($data))
                @foreach ($data as $key => $row)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ ucwords($row['nama_siswa']) }}</td>
                        <td>{{ $row['kelas'] }}</td>
                        <td>{{ $row['jumlahMasuk'] }}</td>
                        <td class="text-danger">{{ $row['jumlahGaMasuk'] }}</td>
                        <td>{{ $row['jumlahSakit'] }}</td>
                        <td>{{ $row['jumlahIzin'] }}</td>
                        <td>{{ $row['jumlahAlpha'] }}</td>
                        <td>{{ $row['tanpaKeterangan'] }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-danger" colspan="100%">Data Tidak Tersedia</td>
                </tr>
            @endif
        </tbody>
    </table>

</body>

</html>
