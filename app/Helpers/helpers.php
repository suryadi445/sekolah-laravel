<?php

use App\Models\Settings;
use App\Models\User;
use App\Models\Siswa;
use Carbon\Carbon;

/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('rupiah')) {
    function rupiah($number)
    {
        return number_format("$number", 0, ",", ".");
    }
}

if (!function_exists('tanggal_indo')) {
    function tanggal_indo($date)
    {
        return Carbon::parse($date)->translatedFormat('l, d F Y');
    }
}

if (!function_exists('bulan')) {
    function bulan($month)
    {
        return Carbon::parse($month)->translatedFormat('F');
    }
}

if (!function_exists('nomorToBulan')) {
    function nomorToBulan($bulan)
    {
        switch ($bulan) {
            case "01":
                $bulan = "Januari";
                break;
            case "02":
                $bulan = "Februari";
                break;
            case "03":
                $bulan = "Maret";
                break;
            case "04":
                $bulan = "April";
                break;
            case "05":
                $bulan = "Mei";
                break;
            case "06":
                $bulan = "Juni";
                break;
            case "07":
                $bulan = "Juli";
                break;
            case "08":
                $bulan = "Agustus";
                break;
            case "09":
                $bulan = "September";
                break;
            case "10":
                $bulan = "Oktober";
                break;
            case "11":
                $bulan = "November";
                break;
            case "12":
                $bulan = "Desember";
                break;
            default:
                $bulan = "";
        }

        return $bulan;
    }
}

if (!function_exists('bulanToNomor')) {
    function bulanToNomor($bulan)
    {
        switch ($bulan) {
            case "Januari":
                $bulan = "01";
                break;
            case "Februari":
                $bulan = "02";
                break;
            case "Maret":
                $bulan = "03";
                break;
            case "April":
                $bulan = "04";
                break;
            case "Mei":
                $bulan = "05";
                break;
            case "Juni":
                $bulan = "06";
                break;
            case "Juli":
                $bulan = "07";
                break;
            case "Agustus":
                $bulan = "08";
                break;
            case "September":
                $bulan = "09";
                break;
            case "Oktober":
                $bulan = "10";
                break;
            case "November":
                $bulan = "11";
                break;
            case "Desember":
                $bulan = "12";
                break;
            default:
                $bulan = "";
        }

        return $bulan;
    }
}

/**
 * Write code on Method
 *
 * @return response()
 */
if (!function_exists('convertMdyToYmd')) {
    function convertMdyToYmd($date)
    {
        return Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
    }
}

if (!function_exists('getUser')) {
    function getUser($id_user)
    {
        return User::where('id', $id_user)->first() ?? '';
    }
}

if (!function_exists('getUmur')) {
    function getUmur($tanggal)
    {
        return Carbon::parse($tanggal)->diff(\Carbon\Carbon::now())->format('%y Tahun, %m bulan');
    }
}

if (!function_exists('getWali')) {
    function getWali($id_siswa)
    {
        $data = Siswa::where('id', $id_siswa)->first() ?? '';

        if ($data) {
            if ($data->nama_ayah) {
                $result = $data->nama_ayah;
            } else if ($data->nama_ibu) {
                $result = $data->nama_ayah;
            } else {
                $result = $data->nama_wali;
            }
        }

        return $result ?? '';
    }
}

if (!function_exists('arrayKelas')) {
    function arrayKelas()
    {
        $sekolah = Settings::first();
        if ($sekolah) {
            $tipe_sekolah = $sekolah->tipe_sekolah;

            if ($tipe_sekolah == 'Pra Sekolah') {
                $result = [
                    '0'
                ];
            } elseif ($tipe_sekolah == 'SD') {
                $result = [
                    'I',
                    'II',
                    'III',
                    'IV',
                    'V',
                    'VI',
                ];
            } elseif ($tipe_sekolah == 'SMP') {
                $result = [
                    'VII',
                    'VIII',
                    'IX',
                ];
            } elseif ($tipe_sekolah == 'SMA') {
                $result = [
                    'X',
                    'XI',
                    'XII',
                ];
            }


            return $result;
        };
    }
}

if (!function_exists('userLogin')) {
    function userLogin()
    {
        return auth()->user();
    }
}

if (!function_exists('namaBank')) {
    function namaBank()
    {
        $bank = [
            [
                "name" => "OVO",
                "code" => "OVO"
            ],
            [
                "name" => "Gopay",
                "code" => "Gopay"
            ],
            [
                "name" => "Dana",
                "code" => "Dana"
            ],
            [
                "name" => "Shopee Pay",
                "code" => "Shopee Pay"
            ],
            [
                "name" => "BANK BRI",
                "code" => "002"
            ],
            [
                "name" => "BANK EKSPOR INDONESIA",
                "code" => "003"
            ],
            [
                "name" => "BANK MANDIRI",
                "code" => "008"
            ],
            [
                "name" => "BANK BNI",
                "code" => "009"
            ],
            [
                "name" => "BANK DANAMON",
                "code" => "011"
            ],
            [
                "name" => "PERMATA BANK",
                "code" => "013"
            ],
            [
                "name" => "BANK BCA",
                "code" => "014"
            ],
            [
                "name" => "BANK BII",
                "code" => "016"
            ],
            [
                "name" => "BANK PANIN",
                "code" => "019"
            ],
            [
                "name" => "BANK ARTA NIAGA KENCANA",
                "code" => "020"
            ],
            [
                "name" => "BANK NIAGA",
                "code" => "022"
            ],
            [
                "name" => "BANK BUANA IND",
                "code" => "023"
            ],
            [
                "name" => "BANK LIPPO",
                "code" => "026"
            ],
            [
                "name" => "BANK NISP",
                "code" => "028"
            ],
            [
                "name" => "AMERICAN EXPRESS BANK LTD",
                "code" => "030"
            ],
            [
                "name" => "CITIBANK N.A.",
                "code" => "031"
            ],
            [
                "name" => "JP. MORGAN CHASE BANK, N.A.",
                "code" => "032"
            ],
            [
                "name" => "BANK OF AMERICA, N.A",
                "code" => "033"
            ],
            [
                "name" => "ING INDONESIA BANK",
                "code" => "034"
            ],
            [
                "name" => "BANK MULTICOR TBK.",
                "code" => "036"
            ],
            [
                "name" => "BANK ARTHA GRAHA",
                "code" => "037"
            ],
            [
                "name" => "BANK CREDIT AGRICOLE INDOSUEZ",
                "code" => "039"
            ],
            [
                "name" => "THE BANGKOK BANK COMP. LTD",
                "code" => "040"
            ],
            [
                "name" => "THE HONGKONG & SHANGHAI B.C.",
                "code" => "041"
            ],
            [
                "name" => "THE BANK OF TOKYO MITSUBISHI UFJ LTD",
                "code" => "042"
            ],
            [
                "name" => "BANK SUMITOMO MITSUI INDONESIA",
                "code" => "045"
            ],
            [
                "name" => "BANK DBS INDONESIA",
                "code" => "046"
            ],
            [
                "name" => "BANK RESONA PERDANIA",
                "code" => "047"
            ],
            [
                "name" => "BANK MIZUHO INDONESIA",
                "code" => "048"
            ],
            [
                "name" => "STANDARD CHARTERED BANK",
                "code" => "050"
            ],
            [
                "name" => "BANK ABN AMRO",
                "code" => "052"
            ],
            [
                "name" => "BANK KEPPEL TATLEE BUANA",
                "code" => "053"
            ],
            [
                "name" => "BANK CAPITAL INDONESIA, TBK.",
                "code" => "054"
            ],
            [
                "name" => "BANK BNP PARIBAS INDONESIA",
                "code" => "057"
            ],
            [
                "name" => "BANK UOB INDONESIA",
                "code" => "058"
            ],
            [
                "name" => "KOREA EXCHANGE BANK DANAMON",
                "code" => "059"
            ],
            [
                "name" => "RABOBANK INTERNASIONAL INDONESIA",
                "code" => "060"
            ],
            [
                "name" => "ANZ PANIN BANK",
                "code" => "061"
            ],
            [
                "name" => "DEUTSCHE BANK AG.",
                "code" => "067"
            ],
            [
                "name" => "BANK WOORI INDONESIA",
                "code" => "068"
            ],
            [
                "name" => "BANK OF CHINA LIMITED",
                "code" => "069"
            ],
            [
                "name" => "BANK BUMI ARTA",
                "code" => "076"
            ],
            [
                "name" => "BANK EKONOMI",
                "code" => "087"
            ],
            [
                "name" => "BANK ANTARDAERAH",
                "code" => "088"
            ],
            [
                "name" => "BANK HAGA",
                "code" => "089"
            ],
            [
                "name" => "BANK IFI",
                "code" => "093"
            ],
            [
                "name" => "BANK CENTURY, TBK.",
                "code" => "095"
            ],
            [
                "name" => "BANK MAYAPADA",
                "code" => "097"
            ],
            [
                "name" => "BANK JABAR",
                "code" => "110"
            ],
            [
                "name" => "BANK DKI",
                "code" => "111"
            ],
            [
                "name" => "BPD DIY",
                "code" => "112"
            ],
            [
                "name" => "BANK JATENG",
                "code" => "113"
            ],
            [
                "name" => "BANK JATIM",
                "code" => "114"
            ],
            [
                "name" => "BPD JAMBI",
                "code" => "115"
            ],
            [
                "name" => "BPD ACEH",
                "code" => "116"
            ],
            [
                "name" => "BANK SUMUT",
                "code" => "117"
            ],
            [
                "name" => "BANK NAGARI",
                "code" => "118"
            ],
            [
                "name" => "BANK RIAU",
                "code" => "119"
            ],
            [
                "name" => "BANK SUMSEL",
                "code" => "120"
            ],
            [
                "name" => "BANK LAMPUNG",
                "code" => "121"
            ],
            [
                "name" => "BPD KALSEL",
                "code" => "122"
            ],
            [
                "name" => "BPD KALIMANTAN BARAT",
                "code" => "123"
            ],
            [
                "name" => "BPD KALTIM",
                "code" => "124"
            ],
            [
                "name" => "BPD KALTENG",
                "code" => "125"
            ],
            [
                "name" => "BPD SULSEL",
                "code" => "126"
            ],
            [
                "name" => "BANK SULUT",
                "code" => "127"
            ],
            [
                "name" => "BPD NTB",
                "code" => "128"
            ],
            [
                "name" => "BPD BALI",
                "code" => "129"
            ],
            [
                "name" => "BANK NTT",
                "code" => "130"
            ],
            [
                "name" => "BANK MALUKU",
                "code" => "131"
            ],
            [
                "name" => "BPD PAPUA",
                "code" => "132"
            ],
            [
                "name" => "BANK BENGKULU",
                "code" => "133"
            ],
            [
                "name" => "BPD SULAWESI TENGAH",
                "code" => "134"
            ],
            [
                "name" => "BANK SULTRA",
                "code" => "135"
            ],
            [
                "name" => "BANK NUSANTARA PARAHYANGAN",
                "code" => "145"
            ],
            [
                "name" => "BANK SWADESI",
                "code" => "146"
            ],
            [
                "name" => "BANK MUAMALAT",
                "code" => "147"
            ],
            [
                "name" => "BANK MESTIKA",
                "code" => "151"
            ],
            [
                "name" => "BANK METRO EXPRESS",
                "code" => "152"
            ],
            [
                "name" => "BANK SHINTA INDONESIA",
                "code" => "153"
            ],
            [
                "name" => "BANK MASPION",
                "code" => "157"
            ],
            [
                "name" => "BANK HAGAKITA",
                "code" => "159"
            ],
            [
                "name" => "BANK GANESHA",
                "code" => "161"
            ],
            [
                "name" => "BANK WINDU KENTJANA",
                "code" => "162"
            ],
            [
                "name" => "HALIM INDONESIA BANK",
                "code" => "164"
            ],
            [
                "name" => "BANK HARMONI INTERNATIONAL",
                "code" => "166"
            ],
            [
                "name" => "BANK KESAWAN",
                "code" => "167"
            ],
            [
                "name" => "BANK TABUNGAN NEGARA (PERSERO)",
                "code" => "200"
            ],
            [
                "name" => "BANK HIMPUNAN SAUDARA 1906, TBK .",
                "code" => "212"
            ],
            [
                "name" => "BANK TABUNGAN PENSIUNAN NASIONAL",
                "code" => "213"
            ],
            [
                "name" => "BANK SWAGUNA",
                "code" => "405"
            ],
            [
                "name" => "BANK JASA ARTA",
                "code" => "422"
            ],
            [
                "name" => "BANK MEGA",
                "code" => "426"
            ],
            [
                "name" => "BANK JASA JAKARTA",
                "code" => "427"
            ],
            [
                "name" => "BANK BUKOPIN",
                "code" => "441"
            ],
            [
                "name" => "BANK SYARIAH MANDIRI",
                "code" => "451"
            ],
            [
                "name" => "BANK BISNIS INTERNASIONAL",
                "code" => "459"
            ],
            [
                "name" => "BANK SRI PARTHA",
                "code" => "466"
            ],
            [
                "name" => "BANK JASA JAKARTA",
                "code" => "472"
            ],
            [
                "name" => "BANK BINTANG MANUNGGAL",
                "code" => "484"
            ],
            [
                "name" => "BANK BUMIPUTERA",
                "code" => "485"
            ],
            [
                "name" => "BANK YUDHA BHAKTI",
                "code" => "490"
            ],
            [
                "name" => "BANK MITRANIAGA",
                "code" => "491"
            ],
            [
                "name" => "BANK AGRO NIAGA",
                "code" => "494"
            ],
            [
                "name" => "BANK INDOMONEX",
                "code" => "498"
            ],
            [
                "name" => "BANK ROYAL INDONESIA",
                "code" => "501"
            ],
            [
                "name" => "BANK ALFINDO",
                "code" => "503"
            ],
            [
                "name" => "BANK SYARIAH MEGA",
                "code" => "506"
            ],
            [
                "name" => "BANK INA PERDANA",
                "code" => "513"
            ],
            [
                "name" => "BANK HARFA",
                "code" => "517"
            ],
            [
                "name" => "PRIMA MASTER BANK",
                "code" => "520"
            ],
            [
                "name" => "BANK PERSYARIKATAN INDONESIA",
                "code" => "521"
            ],
            [
                "name" => "BANK AKITA",
                "code" => "525"
            ],
            [
                "name" => "LIMAN INTERNATIONAL BANK",
                "code" => "526"
            ],
            [
                "name" => "ANGLOMAS INTERNASIONAL BANK",
                "code" => "531"
            ],
            [
                "name" => "BANK DIPO INTERNATIONAL",
                "code" => "523"
            ],
            [
                "name" => "BANK KESEJAHTERAAN EKONOMI",
                "code" => "535"
            ],
            [
                "name" => "BANK UIB",
                "code" => "536"
            ],
            [
                "name" => "BANK ARTOS IND",
                "code" => "542"
            ],
            [
                "name" => "BANK PURBA DANARTA",
                "code" => "547"
            ],
            [
                "name" => "BANK MULTI ARTA SENTOSA",
                "code" => "548"
            ],
            [
                "name" => "BANK MAYORA",
                "code" => "553"
            ],
            [
                "name" => "BANK INDEX SELINDO",
                "code" => "555"
            ],
            [
                "name" => "BANK VICTORIA INTERNATIONAL",
                "code" => "566"
            ],
            [
                "name" => "BANK EKSEKUTIF",
                "code" => "558"
            ],
            [
                "name" => "CENTRATAMA NASIONAL BANK",
                "code" => "559"
            ],
            [
                "name" => "BANK FAMA INTERNASIONAL",
                "code" => "562"
            ],
            [
                "name" => "BANK SINAR HARAPAN BALI",
                "code" => "564"
            ],
            [
                "name" => "BANK HARDA",
                "code" => "567"
            ],
            [
                "name" => "BANK FINCONESIA",
                "code" => "945"
            ],
            [
                "name" => "BANK MERINCORP",
                "code" => "946"
            ],
            [
                "name" => "BANK MAYBANK INDOCORP",
                "code" => "947"
            ],
            [
                "name" => "BANK OCBC – INDONESIA",
                "code" => "948"
            ],
            [
                "name" => "BANK CHINA TRUST INDONESIA",
                "code" => "949"
            ],
            [
                "name" => "BANK COMMONWEALTH",
                "code" => "950"
            ],
            [
                "name" => "Lain-Lain",
                "code" => "Lain-Lain"
            ],
        ];

        return $bank;
    }
}


if (!function_exists('getProvinsi')) {
    function getProvinsi()
    {
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/provinsi';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        $data = json_decode($response);

        if ($data) {
            $provinces = $data->provinsi;
        }

        curl_close($ch);

        return $provinces ?? [];
    }
}

if (!function_exists('getKota')) {
    function getKota($province_id)
    {
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/kota?id_provinsi=' . $province_id . '';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        $data = json_decode($response);

        if ($data) {
            $cities = $data->kota_kabupaten;
        }

        curl_close($ch);

        return $cities ?? [];
    }
}

if (!function_exists('getKecamatan')) {
    function getKecamatan($city_id)
    {
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/kecamatan?id_kota=' . $city_id . '';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        $data = json_decode($response);

        if ($data) {
            $districts = $data->kecamatan;
        }

        curl_close($ch);

        return $districts ?? [];
    }
}


if (!function_exists('getKelurahan')) {
    function getKelurahan($district_id)
    {
        $url = 'https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=' . $district_id . '';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        $data = json_decode($response, true);

        if ($data) {
            $subdistricts = $data->kelurahan;
        }

        curl_close($ch);

        return $subdistricts ?? [];
    }
}


if (!function_exists('arrayKota')) {
    function arrayKota()
    {
        return [
            "Ambon",
            "Balikpapan",
            "Banda Aceh",
            "Bandar Lampung",
            "Bandung",
            "Banjar",
            "Banjarbaru",
            "Banjarmasin",
            "Batam",
            "Batu",
            "Bau-Bau",
            "Bekasi",
            "Bengkulu",
            "Bima",
            "Binjai",
            "Bitung",
            "Blitar",
            "Bogor",
            "Bondowoso",
            "Bontang",
            "Brebes",
            "Cilegon",
            "Cimahi",
            "Cirebon",
            "Denpasar",
            "Depok",
            "Dumai",
            "Gorontalo",
            "Gunungsitoli",
            "Jakarta Barat",
            "Jakarta Pusat",
            "Jakarta Selatan",
            "Jakarta Timur",
            "Jakarta Utara",
            "Jambi",
            "Jayapura",
            "Kediri",
            "Kendari",
            "Ketapang",
            "Kupang",
            "Kendal",
            "Klaten",
            "Kudus",
            "Kuta",
            "Lahat",
            "Lamongan",
            "Langsa",
            "Lhokseumawe",
            "Lubuklinggau",
            "Madiun",
            "Magelang",
            "Makassar",
            "Malang",
            "Manado",
            "Martapura",
            "Mataram",
            "Medan",
            "Metro",
            "Meulaboh",
            "Mojokerto",
            "Padang",
            "Padang Panjang",
            "Padang Sidempuan",
            "Pagar Alam",
            "Palangkaraya",
            "Palembang",
            "Palopo",
            "Palu",
            "Pangkal Pinang",
            "Parepare",
            "Pariaman",
            "Pasuruan",
            "Payakumbuh",
            "Pekalongan",
            "Pekanbaru",
            "Pematangsiantar",
            "Pendopo",
            "Pontianak",
            "Prabumulih",
            "Praya",
            "Probolinggo",
            "Sabang",
            "Salatiga",
            "Samarinda",
            "Sawahlunto",
            "Semarang",
            "Serang",
            "Sibolga",
            "Singkawang",
            "Singaraja",
            "Singkawang",
            "Solok",
            "Sorong",
            "Subulussalam",
            "Sukabumi",
            "Sumbawa Besar",
            "Sumedang",
            "Sumenep",
            "Surabaya",
            "Surakarta",
            "Tangerang",
            "Tangerang Selatan",
            "Tanjung Balai",
            "Tanjung Pinang",
            "Tanjung Redeb",
            "Tanjung Selor",
            "Tanjungpandan",
            "Tasikmalaya",
            "Tebing Tinggi",
            "Tegal",
            "Ternate",
            "Tidore Kepulauan",
            "Tomohon",
            "Tual",
            "Tuban",
            "Tulungagung",
            "Ungaran",
            "Waingapu",
        ];
    }
}

if (!function_exists('hakAksesView')) {
    function hakAksesView()
    {
        $userGroup = auth()->user()->id_group;
        if ($userGroup == 3 || $userGroup == 4) {
            return 'd-none';
        }
    }
}

if (!function_exists('hakAksesController')) {
    function hakAksesController()
    {
        $userGroup = auth()->user()->id_group;

        if ($userGroup == 3 || $userGroup == 4) {
            abort(redirect('/dashboard')->with('failed', 'Warning! You do not have access that page'));
        }
    }
}