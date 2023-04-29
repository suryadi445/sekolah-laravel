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
                <th>Jabatan</th>
                <th>Nama</th>
                <th>No Hp</th>
                <th>Email</th>
                <th>Tgl Lahir</th>
                <th>Proses</th>
                <th>Tanggal Mendaftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $row['jabatan'] }}</td>
                    <td>{{ $row['nama'] }}</td>
                    <td>{{ $row['no_hp'] }}</td>
                    <td>{{ $row['email'] }}</td>
                    <td>{{ $row['tgl_lahir'] }}</td>
                    <td>{{ $row['proses'] }}</td>
                    <td>{{ $row['created_at'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
