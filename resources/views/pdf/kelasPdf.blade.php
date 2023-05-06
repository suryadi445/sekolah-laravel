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
                <th>Kelas</th>
                <th>SUb Kelas</th>
                <th>Keterangan</th>
                <th>Biaya Spp</th>
                <th>Wali Kelas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $row)
                <tr>
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $row['kelas'] }}</td>
                    <td>{{ $row['sub_kelas'] }}</td>
                    <td>{{ $row['keterangan'] }}</td>
                    <td>{{ number_format($row['biaya_spp'], 0, ',', '.') }}</td>
                    <td>{{ $row['nama_guru'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
