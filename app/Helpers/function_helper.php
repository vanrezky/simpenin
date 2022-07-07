<?php
function current_timestamp()
{
    date_default_timezone_set("Asia/Jakarta");
    return date("Y-m-d H:i:s");
}

function pesan($pesan = "", $status = "info")
{
    $ex_pesan = explode('|', $pesan);

    $icon = '';
    switch ($status) {
        case 'danger':
            $icon = 'fa fa-exclamation-circle mr-3 scale-box fa-4x color-red-dark';
            break;
        case 'success':
            $icon = 'fa fa-check-circle mr-3 scale-box fa-4x color-green-dark';
            break;
        case 'warning':
            $icon = 'fa fa-exclamation-circle mr-3 scale-box fa-4x color-yellow-dark';
            break;
    }

    $head_pesan = '';
    if (count($ex_pesan) > 1) {
        $head_pesan = $ex_pesan[0];
        $pesan = $ex_pesan[1];
    }


    return '<div class="card card-style alert" role="alert">
            <div class="d-flex py-2">
                <div>
                    <i class="' . $icon . '"></i>
                </div>
                <div>
                    <h3 class="mb-0">' . $head_pesan . '</h3>
                    <p class="color-highlight mb-n1 font-12 font-600">' . $pesan . '</p>
                </div>
                <div class="ml-auto align-self-center">
                    <div data-dismiss="alert" aria-label="Close"><i class="fa fa-times-circle font-16 color-red-dark"></i></div>
                </div>
            </div>
        </div>';
}

function p($data)
{
    echo '<pre>' . var_export($data, true) . '</pre>';
}

function pp($data)
{
    echo '<pre>' . var_export($data, true) . '</pre>';
    die;
}

function toUang($str)
{
    if (!is_numeric($str)) {
        return $str;
    }
    return number_format($str, 0, ',', '.');
}

function jumlahHari($mulai, $selesai, $selisih_hari = false)
{
    date_default_timezone_set('Asia/Jakarta');
    $awal  = date_create($mulai);
    $akhir = date_create($selesai); // waktu sekarang
    $diff  = date_diff($awal, $akhir);

    // echo 'Selisih waktu: ';
    // echo $diff->y . ' tahun, ';
    // echo $diff->m . ' bulan, ';
    // echo $diff->d . ' hari, ';
    // echo $diff->h . ' jam, ';
    // echo $diff->i . ' menit, ';
    // echo $diff->s . ' detik, ';
    // Output: Selisih waktu: 28 tahun, 5 bulan, 9 hari, 13 jam, 7 menit, 7 detik
    // echo 'Total selisih hari : ' . $diff->days;
    // Output: Total selisih hari: 10398
    $array = [];
    if ($diff->y > 0) $array[] = $diff->y . ' tahun';
    if ($diff->m > 0) $array[] = $diff->m . ' bulan';
    if ($diff->d > 0) $array[] = $diff->d . ' hari';

    if ($selisih_hari) {
        return $diff->days;
    }

    return implode(', ', $array);
}

function tanggal($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function jemputDi()
{

    return ['rumah', 'kantor'];
}

function totalBayar($ukuran, $hari = "7")
{

    if ($hari > 365) { //jika sewa lebih dari 365 hari, maka sewa perhari 0.8
        $sewa_perhari = 0.8;
    } elseif ($hari >= 100 && $hari <= 365) { //jika sewa lebih dari 100 hari dan kurang dari 365 hari maka harga_perhari 1.6
        $sewa_perhari = 1.8;
    } else {
        $sewa_perhari = 2; //biaya sewa sehari
    }

    // ukuran dikali sewa perhari dikali lawa sewa (hari)
    $bayar = ($ukuran / 100) * $sewa_perhari * $hari;
    $diskon = 0;
    $minimal_ukuran_diskon = 100000; //100k cm3

    if ($ukuran > $minimal_ukuran_diskon) {
        // mendapat diskon 10%
        $diskon = round(($bayar * 10) / 100, 2);
    }

    return [
        'bayar' => $bayar,
        'diskon' => $diskon,
        'total_bayar' => $bayar - $diskon
    ];
}
