<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spp bulan {{ $data->nama_bulan . ', tahun' . $data->tahun }}</title>
    <style>
        .centered-text-table {
            width: 100%;
            border-collapse: collapse;
        }

        .centered-text-table th,
        .centered-text-table td {
            text-align: center;
            padding: 6px;
            border: 1px solid black;
        }

        .text-danger {
            color: red !important;
        }
    </style>
</head>

<body>

    <h3>
        Pembayaran Spp bulan {{ $data->nama_bulan . ', tahun' . $data->tahun }}
    </h3>

    {{-- ->select('siswas.nama_siswa', 'siswas.email', 'siswas.kelas', 'siswas.sub_kelas', 'spps.nama_bulan', 'spps.tahun', 'spps.tipe_pembayaran', 'spps.jenis_pembayaran', 'spps.nominal') --}}

    <table class="centered-text-table">
        <tr>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Sub Kelas</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Tipe Pembayaran</th>
            <th>Jenis Pembayaran</th>
            <th>Nominal</th>
            <th>Tanggal</th>
        </tr>
        <tr>
            <td>{{ $data['nama_siswa'] }}</td>
            <td>{{ $data['kelas'] }}</td>
            <td>{{ $data['sub_kelas'] }}</td>
            <td>{{ $data['nama_bulan'] }}</td>
            <td>{{ $data['tahun'] }}</td>
            <td>{{ $data['tipe_pembayaran'] }}</td>
            <td>{{ $data['jenis_pembayaran'] }}</td>
            <td>{{ rupiah($data['nominal']) }}</td>
            <td>{{ $data['created_at'] }}</td>
        </tr>
    </table>

    <br>
    <p>
        * List yang tertera hanya menampilkan pembayaran spp terbaru.
    </p>
    <p>
        * Mohon hubungi pihak sekolah jika ada kesalahan.
    </p>
</body>

</html>
