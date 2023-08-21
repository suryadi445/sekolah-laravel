<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Absensi {{ $data[0]['tgl_absensi'] }}</title>
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
        List Absensi Tidak Hadir Siswa Pada
        {{ hari($data[0]['created_at']) . ', ' . date('d-m-Y', strtotime($data[0]['tgl_absensi'])) }}
    </h3>

    <table class="centered-text-table">
        <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Kelas</th>
            <th>Mata Pelajaran</th>
            <th>Absensi</th>
            <th>Keterangan</th>
        </tr>
        @foreach ($data as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item['nama_siswa'] }}</td>
                <td>{{ $item['kelas'] }}</td>
                <td>{{ $item['mata_pelajaran'] }}</td>
                <td class="{{ $item['absensi'] == 'yes' ? '' : 'text-danger' }}">
                    {{ $item['absensi'] == 'yes' ? 'Masuk' : 'Tidak Masuk' }}
                </td>
                <td>{{ $item['keterangan'] ?? '-' }}</td>
            </tr>
        @endforeach
    </table>

    <br>
    <p>
        * List yang tertera hanya menampilkan siswa yang tidak hadir pada hari ini.
    </p>
    <p>
        * Mohon hubungi wali kelas jika ada kesalahan dalam pengisian absensi harian.
    </p>
    <p>
        * Akan ada rekap absensi bulanan yang akan dikirim setiap akhir bulan.
    </p>
</body>

</html>
