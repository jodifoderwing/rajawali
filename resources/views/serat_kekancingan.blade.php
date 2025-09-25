<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Serat Kekancingan</title>
    <style>
        body {
            font-family: "Bookman Old Style", "Georgia", serif;
            /* font-family: 'Times New Roman', Times, serif; */
            margin: 0;
            padding: 0;
            font-size: 17px;
            box-sizing: border-box;
        }
        .header {
            margin-top: 90px;
            text-align: center;
        }

        .page01 {
            margin-top:0px;
            margin-bottom:0px;
            line-height: 1.5;
        }

        .jenis_hak {
            top: 680px;
            left: 1040px;
        }

        .nomor_hak {
            top: 680px;
            left: 1240px;
        }

        .diy {
            top: 718px;
            left: 1040px;
        }

        .diy_kabkota {
            top: 756px;
            left: 1040px;
        }

        .diy_kapkem {
            top: 794px;
            left: 1040px;
        }

        .diy_kalkel {
            top: 832px;
            left: 1040px;
        }

        .nomor_kode {
            top: 918px;
            left: 835px;
        }

        .page02 {
            margin-top:0px;
            margin-bottom:0px;
        }

        /* Menempatkan data di posisi yang sesuai pada blangko */
        .no_serat {
            top: 67px; /* Sesuaikan posisi data dengan blangko */
            left: 110px;
        }

        .nama_pemegang {
            top: 80px;
            left: 302px;
        }

        .nama_kalurahan {
            top: 87px;
            left: 180px;
        }

        .akhir_serat {
            top: 108px;
            left: 207px;
        }

        .nik_pemegang {
            top: 157px;
            left: 100px;
        }

        .permohonan {
            top: 207px;
            left: 160px;
        }

        .tglberkas {
            top: 228px;
            left: 120px;
        }

        .no_shm {
            top: 233px;
            left: 387px;
        }

        .noberkas {
            top: 248px;
            left: 120px;
        }

        .luas_sg {
            top: 258px;
            left: 370px;
        }

        .nama_kalkel {
            top: 283px;
            left: 440px;
        }

        .peringatan {
            top: 399px;
            left: 48px;
        }

        .tgl_ukur {
            top: 420px;
            left: 398px;
        }

        .luas_ukur {
            top: 445px;
            left: 380px;
        }

        .dino_weton {
            top: 572px;
            left: 412px;
        }

        .tgl_terbit {
            top: 572px;
            left: 563px;
        }

        .gkr_mangkubumi {
            top: 707px;
            left: 90px;
        }

        .gkr_condrokirono {
            top: 815px;
            left: 90px;
        }


        .krt_suryo {
            top: 707px;
            left: 413px;
        }

        .page03 {
            margin-top:0px;
            margin-bottom:0px;
        }

        .page04 {
            margin-top:0px;
            margin-bottom:0px;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
        }

        .field {
            position: absolute;
            font-size: 14px;
            color: black;
        }

        .content {
            margin-top:20px;
            margin-bottom:30px;
            line-height: 2;
        }

        .title {
            position: absolute;
            font-size: 17px;
            top: 78px;
            left: 800px;
            line-height: 1;
        }

        .section_kanan {
            position: absolute;
            font-size: 17px;
            top: 370px;
            left: 800px;
            line-height: 1;
        }

        .section_kanan_1 {
            position: absolute;
            font-size: 17px;
            top: 70px;
            left: 800px;
            line-height: 1;
        }

        .section_kiri {
            position: absolute;
            font-size: 17px;
            top: 70px;
            left: 10px;
            line-height: 1;
        }

    </style>
</head>

<body>

    @php
        use App\Utils\DateUtils;
        use App\Utils\NumberUtils;
    @endphp

    <div class="page01">

        <div class="field jenis_hak">
            <span id="no_serat">{{ $berkas->hak->nama }}</span>
        </div>

        <div class="field nomor_hak">
            <span id="jenis_hak">{{ substr($berkas->no_serat, 11, 4) . substr($berkas->no_serat, 21, 5) }}</span>
        </div>

        <div class="field diy">
            <span id="diy">Daerah Istimewa Yogyakarta</span>
        </div>

        <div class="field diy_kabkota">
            <span id="diy_kabkota">{{ ucwords(strtolower($berkas->kabkota->type)) . ' ' . ucwords(strtolower($berkas->kabkota->nama)) }}</span>
        </div>

        <div class="field diy_kapkem">
            <span id="diy_kapkem">{{ ucwords(strtolower($berkas->kapkem->type)) . ' ' . ucwords(strtolower($berkas->kapkem->nama)) }}</span>
        </div>

        <div class="field diy_kalkel">
            <span id="diy_kalkel">{{ ucwords(strtolower($berkas->kalkel->type)) . ' ' . ucwords(strtolower($berkas->kalkel->nama)) }}</span>
        </div>


        <div class="field nomor_kode">
            <table style="width: 602px; text-align: center; border-collapse: collapse;">
                <tr>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 0, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 1, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 2, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 3, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 4, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 5, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 6, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 7, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 8, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 9, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 10, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 11, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 12, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 13, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 14, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 15, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 16, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 17, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 18, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 19, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 20, 1) }}</td>
                    <td style="width: 22.2px;">{{ substr($berkas->no_serat, 21, 1) }}</td>
                    <td style="width: 50px;">{{ substr($berkas->no_serat, 22, 4) }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div style="page-break-before:always;"> </div>

    <div class="page02">
        <div class="field no_serat">
            <span id="no_serat">{{ $berkas->no_serat }}</span>
        </div>

        <div class="field nama_pemegang" style="font-weight: bold">
            <table style="width: 360px; text-align: center; border-collapse: collapse;">
                <tr>
                    <td>
                        <span id="nama_pemegang">{{ strtoupper($berkas->nama_pemegang) }}</span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="field nama_kalurahan">
            <span id="nama_kalurahan">{{ ucwords(strtolower($berkas->kalkel->nama)) }}</span>
        </div>

        <div class="field akhir_serat">
            <span id="akhir_serat">{{ date('d-m-Y',strtotime($berkas->tgl_akhir)) }}</span>
        </div>

        <div class="field nik_pemegang">
            <span id="nik_pemegang">{{ $berkas->nik_pemegang }}</span>
        </div>

        <div class="field permohonan">
            {{-- <span id="permohonan">{{ substr($berkas->permohonan[0],11,15) }}</span> --}}
            <span id="permohonan">{{ $berkas->permohonan[0] }}</span>
        </div>

        <div class="field tglberkas">
            <span id="tglberkas">{{ date('d-m-Y',strtotime($berkas->tglberkas)) }}</span>
        </div>

        @php
            $shmsgId = $berkas->shmsg_id;
            $shmsg = \App\Models\Shmsg::find($shmsgId); // pastikan pakai namespace jika di luar controller
            $noshm = $shmsg?->nohak;
            $luas = number_format($shmsg?->luassu, 0, ",", ".") . ' M²';
        @endphp

        <div class="field no_shm">
            <span id="no_shm">{{ $noshm }}</span>
        </div>

        <div class="field noberkas">
            <span id="noberkas">{{ $berkas->noberkas }}</span>
        </div>

        <div class="field luas_sg">
            <span id="luas_sg">{{ $luas }}</span>
        </div>

        <div class="field nama_kalkel">
            <span id="nama_kalkel">{{ ucwords(strtolower($berkas->kalkel->type . ' ' . $berkas->kalkel->nama)) }}</span>
        </div>

        <div class="field peringatan">
            <table style="width: 245px; text-align: justify; border-collapse: collapse;">
                <tr>
                    <td>
                        <span id="peringatan">PEMEGANG KEKANCINGAN DILA-RANG MENGALIHKAN BAIK SELURUH MAUPUN SEBAGIAN HAK ATAS TANAH TERSEBUT TANPA SEIZIN KASULTANAN NGAYOG-YAKARTA HADININGRAT DENGAN SANKSI KEKANCINGAN BATAL DEMI HUKUM</span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="field tgl_ukur">
            <span id="tgl_ukur">{{ DateUtils::tgl_biasa($berkas->tgl_ukur) }}</span>
        </div>

        <div class="field luas_ukur">
            <span id="luas_ukur">{{ number_format($berkas->luas_ukur,0,',','.') }} M2</span>
        </div>

        <div class="field dino_weton">
            <table style="width: 120px; text-align: center; border-collapse: collapse;">
                <tr>
                    <td>
                        <span id="dino_weton">{{ DateUtils::weton($berkas->tgl_serat) }}</span>
                    </td>
                </tr>
            </table>
        </div>

        <div class="field tgl_terbit">
            <span id="tgl_terbit">{{ DateUtils::tgl_biasa($berkas->tgl_serat) }}</span>
        </div>

        <div class="field gkr_mangkubumi">
            <span id="gkr_mangkubumi">GKR. MANGKUBUMI</span>
        </div>

        <div class="field gkr_condrokirono">
            <span id="gkr_condrokirono">GKR. CONDROKIRONO</span>
        </div>

        <div class="field krt_suryo">
            <span id="krt_suryo">KRT. SURYO SATRIYANTO</span>
        </div>

    </div>

    <div style="page-break-before:always;"> </div>

    <div class="page03">

        <div class="section_kiri">
            <table style="width: 700px; text-align: justify; border-collapse: collapse;">
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 3%; vertical-align: top;">b.</td>
                    <td style="width: 50%;">mengalihkan hak atas tanah yang diperoleh dari Serat Kekancingan ini kepada pihak lain, kecuali dengan persetujuan Karaton Ngayogyakarta Hadiningrat; dan/atau</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 3%; vertical-align: top;">c.</td>
                    <td style="width: 50%;">menjadikan serat kekancingan sebagai jaminan.</td>
                    <td style="width: 10%;"></td>
                </tr>
                </tr>
                    <td style="width: 100%; height: 10;" colspan="4"></td>
                </tr>
            </table>

            <table style="width: 700px; text-align: justify; border-collapse: collapse;">
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">KESEBELAS</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Dalam hal Karaton Ngayogyakarta Hadiningrat memerlukan Tanah Kasultanan sebagaimana dimaksud dalam Diktum Kedua dalam jangka waktu Serat Kekancingan ini, Karaton Ngayogyakarta Hadiningrat dapat mengganti tanah Kasultanan yang sedang dimanfaatkan oleh Pemegang Serat Kekancingan.</td>
                    <td style="width: 10%;"></td>
                </tr>
                </tr>
                    <td style="width: 100%; height: 10;" colspan="6"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">KEDUABELAS</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Ketentuan lebih lanjut mengenai penggantian Tanah Kasultanan sebagaimana dimaksud pada Diktum Kesebelas ditetapkan oleh Karaton Ngayogyakarta Hadiningrat.</td>
                    <td style="width: 10%;"></td>
                </tr>
                </tr>
                    <td style="width: 100%; height: 10;" colspan="6"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">KETIGABELAS</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Dalam hal Pemegang Serat Kekancingan tidak melakukan kewajiban sebagaimana dimaksud dalam Diktum Kesembilan dan/atau melakukan pelanggaran sebagaimana dimaksud dalam Diktum Kesepuluh, Karaton Ngayogyakarta Hadiningrat dapat membatalkan Serat Kekancingan ini.</td>
                    <td style="width: 10%;"></td>
                </tr>
                </tr>
                    <td style="width: 100%; height: 10;" colspan="6"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">KEEMPATBELAS</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Ketentuan lebih lanjut mengenai pengawasan pemanfaatan Tanah Kasultanan ditetapkan oleh Karaton Ngayogyakarta Hadiningrat.</td>
                    <td style="width: 10%;"></td>
                </tr>
                </tr>
                    <td style="width: 100%; height: 10;" colspan="6"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">KELIMABELAS</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Apabila dikemudian hari diketemukan adanya kekeliruan dalam pemberian Serat Kekancingan ini, akan diadakan peninjauan kembali atau perbaikan sebagaimana mestinya.</td>
                    <td style="width: 10%;"></td>
                </tr>
                </tr>
                    <td style="width: 100%; height: 17;" colspan="6"></td>
                </tr>
            </table>

            <table style="width: 700px; text-align: justify; border-collapse: collapse;">
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 15%; vertical-align: top;">Ditetapkan di</td>
                    <td style="width: 2%; vertical-align: top;">:</td>
                    <td style="width: 49%;" colspan="2">Karaton Ngayogyakarta Hadiningrat</td>
                </tr>
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 15%; vertical-align: top;">Pada tanggal</td>
                    <td style="width: 2%; vertical-align: top;">:</td>
                    <td style="width: 49%;" colspan="2">{{ DateUtils::tgl_indo($berkas->tgl_serat) }}</td>
                </tr>
                </tr>
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 66%;" colspan="4">-----------------------------------------------------------------</td>
                </tr>
                    <td style="width: 100%; height: 5;" colspan="5"></td>
                </tr>
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 66%;" colspan="4">PENGHAGENG KAWEDANAN HAGENG</td>
                </tr>
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 66%;" colspan="4">PUNOKAWAN DATU DANA SUYASA</td>
                </tr>
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 66%;" colspan="4">KARATON NGAYOGYAKARTA HADININGRAT,</td>
                </tr>
                </tr>
                    <td style="width: 100%; height: 70;" colspan="5"></td>
                </tr>
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 66%;" colspan="4">GUSTI KANGJENG RATU MANGKUBUMI</td>
                </tr>
            </table>
        </div>

        <div class="title">
            <table style="width: 700px; text-align: center">
                <tr>
                    <td><span id="title">SERAT KEKANCINGAN</span></td><br>
                </tr>
                <tr>
                    <td><span id="title">KARATON NGAYOGYAKARTA HADININGRAT</span></td>
                </tr>
                <tr>
                    <td><span id="title">KAWEDANAN HAGENG PUNOKAWAN DATU DANA SUYASA</span></td>
                </tr>
                <tr>
                    <td><span id="title">Nomor: {{ $berkas->no_serat }}</span></td>
                </tr>
                <br>
                <tr>
                    <td><span id="title">TENTANG</span></td>
                </tr>
                <br>
                <tr>
                    <td><span id="title">PEMBERIAN IZIN UNTUK PEMANFAATAN TANAH KASULTANAN</span></td>
                </tr>
                <tr>
                    <td><span id="title">KEPADA {{ strtoupper($berkas->nama_pemegang) }}.</span></td>
                </tr>
                <tr>
                    <td><span id="title"></span></td>
                </tr>
                <br>
                <br>
                <tr>
                    <td><span id="title">PENGHAGENG KAWEDANAN HAGENG PUNOKAWAN</span></td>
                </tr>
                <tr>
                    <td><span id="title">DATU DANA SUYASA,</span></td>
                </tr>
            </table>
        </div>

        <br>
        <br>

        <div class="section_kanan">
            <table style="width: 700px; text-align: justify">
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">Menimbang</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 5%; vertical-align: top;">a.</td>
                    <td style="width: 48%;">bahwa Pemohon telah mengajukan permohonan pemanfaatan Tanah Kasultanan;</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;"></td>
                    <td style="width: 5%; vertical-align: top;"></td>
                    <td style="width: 5%; vertical-align: top;">b.</td>
                    <td style="width: 48%;">bahwa setelah dilakukan verifikasi atas permohonan yang diajukan oleh Pemohon dan Pemohon menyetujui persyaratan pemanfaatan Tanah Kasultanan, Karaton Ngayogyakarta Hadiningrat menilai permohonan dapat disetujui;</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;"></td>
                    <td style="width: 5%; vertical-align: top;"></td>
                    <td style="width: 5%; vertical-align: top;">c.</td>
                    <td style="width: 48%;">bahwa dengan disetujuinya permohonan pemanfaatan Tanah Kasultanan, maka Karaton Ngayogyakarta Hadiningrat perlu menerbitkan Serat Kekancingan sebagai izin pemanfaatan Tanah Kasultanan;</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 100%; height: 10;" colspan="6"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">Mengingat</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 5%; vertical-align: top;">1.</td>
                    <td style="width: 48%;">Pasal 18B ayat (1) Undang-Undang Dasar Republik Indonesia Tahun 1945;</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;"></td>
                    <td style="width: 5%; vertical-align: top;"></td>
                    <td style="width: 5%; vertical-align: top;">2.</td>
                    <td style="width: 48%;">Undang-Undang Nomor 13 Tahun 2012 tentang Keistimewaan Daerah Istimewa Yogyakarta (Lembaran Negara Republik Indonesia Tahun 2012 Nomor 170, Tambahan Lembaran Negara Republik Indonesia Nomor 5339);</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;"></td>
                    <td style="width: 5%; vertical-align: top;"></td>
                    <td style="width: 5%; vertical-align: top;">3.</td>
                    <td style="width: 48%;">Peraturan Daerah Istimewa Daerah Istimewa Yogyakarta Nomor 1 Tahun 2017 tentang Pengelolaan dan Pemanfaatan Tanah Kasultanan dan Tanah Kadipaten (Lembaran Daerah Daerah Istimewa Yogyakarta Tahun 2017 Nomor 1, Tambahan Lembaran Daerah Daerah Istimewa Yogyakarta Nomor 1);</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;"></td>
                    <td style="width: 5%; vertical-align: top;"></td>
                    <td style="width: 5%; vertical-align: top;">4.</td>
                    <td style="width: 48%;">Peraturan Gubernur Daerah Istimewa Yogyakarta Nomor 33 Tahun 2017 tentang Tata Cara Pengelolaan dan Pemanfaatan Tanah Kasultanan dan Tanah Kadipaten (Berita Daerah Daerah Istimewa Yogyakarta Tahun 2017 Nomor 34);</td>
                    <td style="width: 10%;"></td>
                </tr>
            </table>
        </div>
    </div>

    <div style="page-break-before:always;"> </div>

    <div  class="page04">
        <div class="section_kiri">
            <table style="width: 700px; text-align: justify; border-collapse: collapse;">
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;"></td>
                    <td style="width: 5%; vertical-align: top;"></td>
                    <td style="width: 5%; vertical-align: top;">5.</td>
                    <td style="width: 48%;">Peraturan Gubernur Daerah Istimewa Yogyakarta Nomor 49 Tahun 2018 tentang Prosedur Permohonan Pemanfaatan Tanah Kasultanan dan Tanah Kadipaten (Berita Daerah Daerah Istimewa Yogyakarta Tahun 2018 Nomor 49);</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 100%; height: 17;" colspan="6"></td>
                </tr>
                <tr>
                    <td style="width: 100%; text-align: center" colspan="6">MEMUTUSKAN</td>
                </tr>
                <tr>
                    <td style="width: 100%; height: 17;" colspan="6"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">Menetapkan</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">SERAT KEKANCINGAN KARATON NGAYOGYAKARTA HADININGRAT KAWEDANAN HAGENG PUNOKAWAN DATU DANA SUYASA TENTANG PEMBERIAN IZIN PEMANFAATAN TANAH KASULTANAN KEPADA {{ strtoupper($berkas->nama_pemegang) }}.</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 100%; height: 15;" colspan="6"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">PERTAMA</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Memberikan izin untuk memanfaatkan Tanah Kasultanan kepada :</td>
                    <td style="width: 10%;"></td>
                </tr>
            </table>

            <table style="width: 700px; text-align: justify; border-collapse: collapse;">
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 17%; vertical-align: top;">Nama</td>
                    <td style="width: 2%; vertical-align: top;">:</td>
                    <td style="width: 34%;"> {{ strtoupper($berkas->nama_pemegang) }} </td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 17%; vertical-align: top;">NIK</td>
                    <td style="width: 2%; vertical-align: top;">:</td>
                    <td style="width: 34%;"> {{ $berkas->nik_pemegang }} </td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 17%; vertical-align: top;">Tempat/Tanggal Lahir</td>
                    <td style="width: 2%; vertical-align: top;">:</td>
                    <td style="width: 34%;">{{ ucwords(strtolower($berkas->tmplahir_Pemegang)). ' / ' . DateUtils::tgl_biasa($berkas->tgllahir_pemegang)}}</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 17%; vertical-align: top;">Alamat</td>
                    <td style="width: 2%; vertical-align: top;">:</td>
                    <td style="width: 34%; text-align: left"> {{ $berkas->alamat_pemegang }} </td>
                    <td style="width: 10%;"></td>
                </tr>
            </table>

            <table style="width: 700px; text-align: justify; border-collapse: collapse;">
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;"></td>
                    <td style="width: 5%; vertical-align: top;"></td>
                    <td style="width: 53%;" colspan="2">yang selanjutnya disebut Pemegang Serat Kekancingan.</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 100%; height: 15;" colspan="6"></td>
                </tr>
            </table>

            <table style="width: 700px; text-align: justify; border-collapse: collapse;">
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">KEDUA</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Pemegang Serat Kekancingan mempunyai hak Ngindung untuk memanfaatkan Tanah Kasultanan seluas {{ $berkas->luas_ukur }} M2 ({{ ucwords(NumberUtils::terbilang($berkas->luas_ukur)) . ' Meter Persegi' }}) terletak di {{ ucwords(strtolower($berkas->kalkel->type)) }} {{ ucwords(strtolower($berkas->kalkel->nama)) }}, {{ ucwords(strtolower($berkas->kapkem->type)) }} {{ ucwords(strtolower($berkas->kapkem->nama)) }}, {{ ucwords(strtolower($berkas->kabkota->type)) }} {{ ucwords(strtolower($berkas->kabkota->nama)) }}, sebagaimana terlampir dalam Lampiran I Serat Kekancingan ini dengan peruntukan {{ $berkas?->penggunaan->nama }} {{ $berkas?->ket }}.</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 100%; height: 15;" colspan="6"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">KETIGA</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Serat Kekancingan ini berlaku selama {{ $berkas->jangka_waktu }} ({{ NumberUtils::terbilang($berkas->jangka_waktu) }}) tahun, terhitung sejak tanggal {{ DateUtils::tgl_indo($berkas->tgl_serat) }} sampai dengan tanggal {{ DateUtils::tgl_indo($berkas->tgl_akhir) }}.</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 100%; height: 15;" colspan="6"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">KEEMPAT</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Apabila Serat Kekancingan telah berakhir dan Pemegang Serat Kekacingan bermaksud akan  memanfaatkan tanah Kasultanan sebagaimana dimaksud Diktum Kedua, maka Pemegang Serat Kekancingan dapat mengajukan permohonan perpanjangan.</td>
                    <td style="width: 10%;"></td>
                </tr>
            </table>
        </div>

        <div class="section_kanan_1">
            <table style="width: 700px; text-align: justify; border-collapse: collapse;">
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">KELIMA</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Permohonan perpanjangan Serat Kekancingan sebagaimana dimaksud Diktum keempat harus sudah disampaikan kepada KHP. Datu Dana Suyasa Karaton Ngayogyakarta Hadiningrat selambat-lambatnya 3 (tiga) bulan sebelum berakhirnya Serat Kekancingan.</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 100%; height: 15;" colspan="6"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">KEENAM</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Apabila batas waktu sebagaimana dimaksud Diktum Kelima, Pemegang Serat Kekancingan tidak mengajukan permohonan perpanjangan, maka Pemegang Serat Kekancingan dianggap tidak akan memperpanjang pemanfaatan Tanah Kasultanan sebagaimana dimaksud Diktum Kedua.</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 100%; height: 15;" colspan="6"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">KETUJUH</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Pemegang Serat Kekancingan wajib memenuhi kesanggupan persyaratan pemanfaatan tanah Kasultanan.</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 100%; height: 15;" colspan="6"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">KEDELAPAN</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Pemegang Serat Kekancingan bersedia menandatangani Surat Pernyataan Kesanggupan sebagaimana Diktum Ketujuh sebelum Serat Kekancingan diterbitkan, dan surat kesanggupan ini merupakan bagian yang tidak terpisahkan dari Serat Kekancingan ini.</td>
                    <td style="width: 10%;"></td>
                </tr>
                    <td style="width: 100%; height: 15;" colspan="6"></td>
                </tr>
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">KESEMBILAN</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Pemegang Serat Kekancingan wajib:</td>
                    <td style="width: 10%;"></td>
                </tr>
                </tr>
                    <td style="width: 100%; height: 10;" colspan="6"></td>
                </tr>
            </table>

            <table style="width: 700px; text-align: justify; border-collapse: collapse;">
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 3%; vertical-align: top;">a.</td>
                    <td style="width: 50%;">memanfaatkan hak atas tanah di atas Hak Milik Tanah Kasultanan sesuai dengan peruntukannya sebagaimana dimaksud Diktum Kedua;</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 3%; vertical-align: top;">b.</td>
                    <td style="width: 50%;">memelihara keutuhan Tanah Kasultanan;</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 3%; vertical-align: top;">c.</td>
                    <td style="width: 50%;">mengembalikan Tanah Kasultanan yang dimanfaatkan dalam keadaan utuh dan tidak meminta ganti rugi atas bangunan gedung dan tanaman yang berada di atas Tanah Kasultanan;</td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 3%; vertical-align: top;">d.</td>
                    <td style="width: 50%;">mematuhi ketentuan yang ditetapkan oleh Karaton Ngayogyakarta Hadiningrat.</td>
                    <td style="width: 10%;"></td>
                </tr>
                </tr>
                    <td style="width: 100%; height: 15;" colspan="4"></td>
                </tr>
            </table>

            <table style="width: 700px; text-align: justify; border-collapse: collapse;">
                <tr>
                    <td style="width: 10%; vertical-align: top;"></td>
                    <td style="width: 22%; vertical-align: top;">KESEPULUH</td>
                    <td style="width: 5%; vertical-align: top;">:</td>
                    <td style="width: 53%;" colspan="2">Pemegang Serat Kekancingan Ngindung dilarang:</td>
                    <td style="width: 10%;"></td>
                </tr>
                </tr>
                    <td style="width: 100%; height: 10;" colspan="6"></td>
                </tr>
            </table>

            <table style="width: 700px; text-align: justify; border-collapse: collapse;">
                <tr>
                    <td style="width: 37%; vertical-align: top;"></td>
                    <td style="width: 3%; vertical-align: top;">a.</td>
                    <td style="width: 50%;">memanfaatkan Tanah Kasultanan selain untuk peruntukannya sebagaimana dimaksud Diktum Kedua, kecuali dengan persetujuan Karaton Ngayogyakarta Hadiningrat;</td>
                    <td style="width: 10%;"></td>
                </tr>
            </table>

        </div>

    </div>

</body>
</html>
