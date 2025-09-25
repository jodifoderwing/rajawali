<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Layangukur;
use App\Models\Shmsg;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SUPDFController extends Controller
{
    public function viewsupdf()
    {
        $layangukurs = Layangukur::all()->sortBy('nomor');
        $data = [
            'date' => date('d-m-Y'),
            'layangukurs' => $layangukurs

        ];
        $dt = strtotime(date(now()));
        // dd('su' . $dt . '.pdf');

        $pdf = PDF::loadView('suratukurPDF', $data);

        // return $pdf->download('suratukur.pdf');
        return $pdf->stream('su' . $dt . '.pdf');
    }

    public function refresh()
    {
        // Mendapatkan semua record dari Tabel Berkas yang no_serat tidak kosong
        $berkass = Berkas::whereNotNull('no_serat')->get();
        // dd($berkass);

        foreach ($berkass as $berkas) {
            // Memeriksa apakah nomor_bidang tidak kosong
            if (!empty($berkas->no_serat)) {
                // Mencari record di Tabel layangukur dengan npk yang sama
                $layangukur = Layangukur::where('kalkel_id', $berkas->kalkel_id)->where('npk', $berkas->npk)->first();

                // dd($layangukur);
                if ($layangukur) {
                    // Jika record ditemukan, lakukan pembaruan
                    $layangukur->update(
                        // Tentukan field yang ingin diperbarui
                        self::savingData($berkas)
                    );
                } else {
                    // Jika record tidak ditemukan, buat data baru
                    Layangukur::create(
                        self::savingData($berkas)
                    );
                }
            }
        }
    }

    public function savingData($berkas): array
    {

        $data =
            [
                'kabkota_id' => $berkas->kabkota_id,
                'kapkem_id' => $berkas->kapkem_id,
                'kalkel_id' => $berkas->kalkel_id,
                'padkam_id' => $berkas->padkam_id,
                'npk' => $berkas->npk,
                'luas' => $berkas->luas_ukur,
                'koordinat' => $berkas->koordinat,
                'status' => 'GS',
                'nomor' => $berkas->no_gs,
                'tanggal' => $berkas->tgl_gs,
                'pemanfaat' => $berkas->nama_pemegang,
                'pemanfaatan' => $berkas->pemanfaatan,
                'ket' => $berkas->ket,
                'upload_su' => $berkas->upload_gs,
                'upload_bk' => $berkas->upload_berkas,
                'is_shm' => $berkas->is_shm,
                'is_utuh' => $berkas->is_utuh,
            ];
        if ($berkas->seratId === 2) {
            $data +=
                [
                    'no_pal' => $berkas->no_serat,
                    'tgl_pal' => $berkas->tgl_serat,
                    'masa_pal' => $berkas->jangka_waktu,
                    'tgl_pal_akhir' => $berkas->tgl_akhir,
                    'upload_pal' => $berkas->upload_serat,
                ];
        } elseif ($berkas->seratId === 1) {
            $data +=
                [
                    'no_kk' => $berkas->no_serat,
                    'tgl_kk' => $berkas->tgl_serat,
                    'masa_kk' => $berkas->jangka_waktu,
                    'tgl_kk_akhir' => $berkas->tgl_akhir,
                    'upload_kk' => $berkas->upload_serat,

                ];

            $shm_sg = Shmsg::where('kalkel_id', $berkas->kalkel_id)->where('nohak', $berkas->no_shm)->first();
            if ($shm_sg) {
                $data +=
                    [
                        'shmsg_id' => $shm_sg->id,
                        'upload_shm' => $shm_sg->upload_shm,
                    ];
            }
        }

        return $data;
    }
}
