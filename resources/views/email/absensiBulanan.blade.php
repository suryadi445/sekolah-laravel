<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Absensi Bulanan
        {{ nomorToBulan(date('m')) . ' Tahun ' . date('Y') }}
    </title>
</head>

<body>

    <h3>
        List Absensi Kehadiran Siswa Bulan {{ nomorToBulan(date('m')) . ' Tahun ' . date('Y') }}
    </h3>



    <br>
    <p>
        * List yang tertera menampilkan semua siswa pada bulan ini.
    </p>
    <p>
        * Mohon hubungi wali kelas jika ada kesalahan dalam pengisian absensi bulanan.
    </p>
    <p>
        * Mohon kabarkan kepada orang tua / wali murid (saudara / tetangga Bapak/Ibu) yang anaknya sering tidak masuk
        sekolah.
    </p>
</body>

</html>
