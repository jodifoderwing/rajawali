<?php

namespace App\Utils;

class DateUtils
{

    public static function tgl_indo($tanggal)
    {
        if ($tanggal) {
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

            // return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
            $tanggal = $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
        }

        return $tanggal;
    }

    public static function tgl_biasa($tanggal)
    {
        if ($tanggal) {
            $tanggal = date('d-m-Y', strtotime($tanggal));
        }

        return $tanggal;
    }

    public static function weton($tanggal)
    {
        $daftar_hari = array(
            'Sunday' => 'Ngahad',
            'Monday' => 'Senen',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rebu',
            'Thursday' => 'Kemis',
            'Friday' => 'Jemuwah',
            'Saturday' => 'Setu'
        );
        $namahari = date('l', strtotime($tanggal));

        $hari = $daftar_hari[$namahari];

        // dipilih tanggal 1 Maret 2010 sebagai acuan
        // hari pasaran tanggal 1 Maret 2010 adalah 'Pon'
        $tgl_ref = "2010-03-01";

        // array urutan nama hari pasaran dimulai dari 'Pon'
        $pasaran = array('Pon', 'Wage', 'Kliwon', 'Legi', 'Pahing');

        // proses mencari selisih hari antara kedua tanggal
        $jd1 = strtotime($tgl_ref);
        // dd($jd1);
        $jd2 = strtotime($tanggal);
        // dd($jd2);

        $selisih = $jd2 - $jd1;
        $selisih = $selisih / 60 / 60 / 24;
        // hitung modulo 5 dari selisih harinya
        $mod = $selisih % 5;
        $dino = $pasaran[$mod];

        return $hari . ' ' . $dino;
    }
}
