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

    <table class="table table-bordered" style="table-layout:fixed;">
        <thead class="p-0">
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>Jenis Kelamin</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Agama</th>
                <th>NIS</th>
                <th>NISN</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $row)
                <tr class="{{ $row['status'] == 'no' ? 'text-danger' : '' }}"">
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $row['nama_siswa'] }}</td>
                    <td>{{ $row['jenis_kelamin'] }}</td>
                    <td>{{ $row['tempat_lahir'] }}</td>
                    <td>{{ $row['tgl_lahir'] }}</td>
                    <td>{{ $row['agama'] }}</td>
                    <td>{{ $row['nis'] }}</td>
                    <td>{{ $row['nisn'] }}</td>
                    <td>{{ $row['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
