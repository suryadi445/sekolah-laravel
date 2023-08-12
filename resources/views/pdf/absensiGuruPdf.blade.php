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
                <th>Nama Guru</th>
                <th>Nik</th>
                <th>Hari Absensi</th>
                <th>Tanggal Absensi</th>
                <th>Jam Absensi</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($data))
                @foreach ($data as $key => $row)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ ucwords($row['nama_guru']) }}</td>
                        <td>{{ $row['nik'] }}</td>
                        <td>{{ $row['hari'] }}</td>
                        <td>{{ $row['tgl_absensi'] }}</td>
                        <td>{{ $row['jam'] }}</td>
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
