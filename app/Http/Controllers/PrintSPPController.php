<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Counterno;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintSPPController extends Controller
{
    public function cetakSPP($id)
    {
        $berkas = Berkas::findOrFail($id); // Ambil data berdasarkan ID

        // Pastikan ada view Blade untuk template PDF
        $pdf = Pdf::loadView('spp', ['berkas' => $berkas]);

        // Unduh PDF atau tampilkan di browser
        return $pdf->stream('Surat_Penerimaan_Permohonan.pdf');
    }

    public function cetakSBP($id)
    {
        $berkas = Berkas::findOrFail($id); // Ambil data berdasarkan ID

        //Cek nokwit
        $nokwit = $berkas->nokwit;
        if (!$nokwit) {
            $nokwit = Counterno::noCounter('NOMOR-KWIT', date('Y'));
            $data['nokwit'] = str_pad($nokwit, '5', '0', STR_PAD_LEFT) . '/KHP-DDS/' . date('Y');
            $data['tglkwit'] = now();

            $berkas->nokwit = $data['nokwit'];
            $berkas->tglkwit = $data['tglkwit'];
            $berkas->save();
            // Notification::make()->success()->title('Nomor Kwitansi Saved')->send();
        }

        // Pastikan ada view Blade untuk template PDF
        $pdf = Pdf::loadView('sbp', ['berkas' => $berkas]);

        // Unduh PDF atau tampilkan di browser
        return $pdf->stream('Surat_Bukti_Pembayaran.pdf');
    }

    public function cetakFormulirSurvey($id)
    {
        $berkas = Berkas::findOrFail($id); // Ambil data berdasarkan ID

        // Pastikan ada view Blade untuk template PDF
        $pdf = Pdf::loadView('formulirSurvey', ['berkas' => $berkas]);

        // Unduh PDF atau tampilkan di browser
        return $pdf->stream('Formulir_Survey.pdf');
    }

    public function cetakHasilSurvey($id)
    {
        $berkas = Berkas::findOrFail($id); // Ambil data berdasarkan ID

        // Pastikan ada view Blade untuk template PDF
        $pdf = Pdf::loadView('hasilSurvey', ['berkas' => $berkas]);

        // Unduh PDF atau tampilkan di browser
        return $pdf->stream('Hasil_Survey.pdf');
    }

    public function cetakSerat($id)
    {
        $berkas = Berkas::findOrFail($id); // Ambil data berdasarkan ID
        $jenis_serat = $berkas->serat_id;
        // dd($jenis_serat);

        if ($jenis_serat === 2) {
            // Pastikan ada view Blade untuk template PDF
            $pdf = Pdf::loadView('serat_palilah', ['berkas' => $berkas]);

            // Unduh PDF atau tampilkan di browser
            return $pdf->stream('Serat_Palilah.pdf');
        } elseif ($jenis_serat === 1) {
            // Pastikan ada view Blade untuk template PDF
            $pdf = Pdf::loadView('serat_kekancingan', ['berkas' => $berkas])->setPaper('A3', 'landscape');

            // Unduh PDF atau tampilkan di browser
            return $pdf->stream('Serat_kekancingan.pdf');
        }
    }

    public function cetakWarkah($id)
    {
        $berkas = Berkas::findOrFail($id); // Ambil data berdasarkan ID

        // Pastikan ada view Blade untuk template PDF
        $pdf = Pdf::loadView('warkah', ['berkas' => $berkas]);

        // Unduh PDF atau tampilkan di browser
        return $pdf->stream('warkah_arsip.pdf');
    }


    public function cetakSerah($id)
    {
        $berkas = Berkas::findOrFail($id); // Ambil data berdasarkan ID

        //Cek nokwit
        $no_di301a = $berkas->no_di301a;
        if (!$no_di301a) {
            $no_di301a = Counterno::noCounter('NOMOR-DI301A', date('Y'));
            $data['no_di301a'] = str_pad($no_di301a, '5', '0', STR_PAD_LEFT) . '/' . date('Y');
            $data['tgl_di301a'] = now();

            $berkas->no_di301a = $data['no_di301a'];
            $berkas->tgl_di301a = $data['tgl_di301a'];
            $berkas->save();
            // Notification::make()->success()->title('Nomor Tanda Terima Saved')->send();
        }

        // Pastikan ada view Blade untuk template PDF
        $pdf = Pdf::loadView('serah', ['berkas' => $berkas]);

        // Unduh PDF atau tampilkan di browser
        return $pdf->stream('Tanda_Terima.pdf');
    }
}
