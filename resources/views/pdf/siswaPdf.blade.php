<!DOCTYPE html>
<html>

<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
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
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Kelas</th>
                <th>Sub Kelas</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Agama</th>
                <th>NIS</th>
                <th>NISN</th>
                <th>Tahun Ajaran</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
                <th>No Hp Ayah</th>
                <th>No Hp Ibu</th>
                <th>Pekerjaan Ayah</th>
                <th>Pekerjaan Ibu</th>
                <th>Alamat Orang Tua</th>
                <th>Nama Wali</th>
                <th>No Hp Wali</th>
                <th>Pekerjaan Wali</th>
                <th>Alamat Wali</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $sis)
                <tr>
                    <td>{{ $sis['nama_siswa'] }}</td>
                    <td>{{ $sis['tempat_lahir'] }}</td>
                    <td>{{ $sis['tgl_lahir'] }}</td>
                    <td>{{ $sis['kelas'] }}</td>
                    <td>{{ $sis['sub_kelas'] }}</td>
                    <td>{{ $sis['jenis_kelamin'] }}</td>
                    <td>{{ $sis['alamat'] }}</td>
                    <td>{{ $sis['agama'] }}</td>
                    <td>{{ $sis['nis'] }}</td>
                    <td>{{ $sis['nisn'] }}</td>
                    <td>{{ $sis['thn_ajaran'] }}</td>
                    <td>{{ $sis['nama_ayah'] }}</td>
                    <td>{{ $sis['nama_ibu'] }}</td>
                    <td>{{ $sis['no_hp_ayah'] }}</td>
                    <td>{{ $sis['no_hp_ibu'] }}</td>
                    <td>{{ $sis['pekerjaan_ayah'] }}</td>
                    <td>{{ $sis['pekerjaan_ibu'] }}</td>
                    <td>{{ $sis['alamat_ortu'] }}</td>
                    <td>{{ $sis['nama_wali'] }}</td>
                    <td>{{ $sis['no_hp_wali'] }}</td>
                    <td>{{ $sis['pekerjaan_wali'] }}</td>
                    <td>{{ $sis['alamat_wali'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
