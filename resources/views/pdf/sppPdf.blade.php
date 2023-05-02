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

    <table class="table table-bordered" style="table-layout:fixed;">
        <thead class="p-0">
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Bulan / Tahun</th>
                <th>Tipe Pembayaran</th>
                <th>Jenis Pembayaran</th>
                <th>Merchant</th>
                <th>Keterangan</th>
                <th>Nominal</th>
                <th>Tanggal Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $row)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $row['nama_siswa'] }}</td>
                    <td>{{ $row['kelas'] . ' ' . $row['sub_kelas'] }}</td>
                    <td>{{ $row['nama_bulan'] . '-' . $row['tahun'] }}</td>
                    <td>{{ $row['tipe_pembayaran'] }}</td>
                    <td>{{ $row['jenis_pembayaran'] }}</td>
                    <td>{{ $row['merchant'] }}</td>
                    <td>{{ $row['keterangan'] }}</td>
                    <td>{{ $row['nominal'] }}</td>
                    <td>{{ date('d-m-Y', strtotime($row['created_at'])) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
