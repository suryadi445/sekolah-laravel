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

    @if ($user == 'internal')
        <table class="table table-bordered" style="table-layout:fixed;">
            <thead class="p-0">
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Guru</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $row)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $row['nip'] }}</td>
                        <td>{{ $row['nama_guru'] }}</td>
                        <td>{{ $row['jenis_kelamin'] }}</td>
                        <td>{{ $row['alamat'] }}</td>
                        <td>{{ $row['is_active'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <table class="table table-bordered" style="table-layout:fixed;">
            <thead class="p-0">
                <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama Siswa</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $row)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $row['nis'] }}</td>
                        <td>{{ $row['nama_siswa'] }}</td>
                        <td>{{ $row['jenis_kelamin'] }}</td>
                        <td>{{ $row['alamat'] }}</td>
                        <td>{{ $row['is_active'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif


</body>

</html>
