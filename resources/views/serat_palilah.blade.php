<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serat Palilah</title>
    <style>
        body {
            /* font-family: Bookman Old Style; */
            font-family: 'Times New Roman', Times, serif;
            margin-top: 40px;
            margin-bottom:10px;
            margin-left: 45px;
            margin-right: 55px;
            box-sizing: border-box;
        }
        .header {
            margin-top: 90px;
            text-align: center;
        }

        .title {
            margin-top: 15px;
            margin-bottom: 5px;
            text-align: center;
        }
        .content {
            margin-top:20px;
            margin-bottom:30px;
            line-height: 1.5;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>
<body>
    {{-- <div class="header">
        <u><font size="3"><strong>KARATON NGAYOGYAKARTA HADININGRAT<strong></font></u><br>
        <font size="3"><strong>KAWEDANAN HAGENG PUNOKAWAN DATU DANA SUYASA<strong></font><br>
    </div> --}}

    <div class="header">
        <font size="3">SERAT PALILAH</font><br>
        <font size="3">KARATON NGAYOGYAKARTA HADININGRAT</font><br>
        <font size="3">KAWEDANAN HAGENG PUNOKAWAN DATU DANA SUYASA</font><br>
        @php
            $no_serat = $berkas->no_serat;
        @endphp

        @if ($no_serat)
            <font size="3">Nomor : {{ $berkas->no_serat }}</font>
        @else
            <font size="3">Nomor : .................................................</font>
        @endif

    </div>

    <div class="title">
        <font size="3">TENTANG</font>
    </div>

    <div class="title">
        <font size="3">PEMBERIAN IZIN SEMENTARA PEMANFAATAN TANAH KASULTANAN </font><br>
        <font size="3">KEPADA {{ $berkas->nama_pemegang }}</font>
    </div>

    <br>
    <div class="title">
        <font size="3">PENGHAGENG KAWEDANAN HAGENG PUNOKAWAN</font><br>
        <font size="3">DATU DANA SUYASA</font><br>
    </div>

    <div class="content">
        {{-- <font size="3">Telah terima Berkas Permohonan Ijin Pemanfaatan Tanah Kasultanan dari :</font><br> --}}
        <table style="width: 100%">
            <tr>
                <td style="width: 15%; vertical-align: top;">Menimbang</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 3%; vertical-align: top;">a.</td>
                <td style="width: 80%; text-align: justify;">bahwa Pemohon telah mengajukan permohonan pemanfaatan Tanah Kasultanan;</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;"></td>
                <td style="width: 2%; vertical-align: top;"></td>
                <td style="width: 3%; vertical-align: top;">b.</td>
                <td style="width: 80%; text-align: justify;">bahwa setelah dilakukan verifikasi atas permohonan yang diajukan oleh Pemohon dan Pemohon menyetujui persyaratan pemanfaatan Tanah Kasultanan, Karaton Ngayogyakarta Hadiningrat menilai permohonan dapat disetujui;</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;"></td>
                <td style="width: 2%; vertical-align: top;"></td>
                <td style="width: 3%; vertical-align: top;">c.</td>
                <td style="width: 80%; text-align: justify;">bahwa dengan disetujuinya permohonan pemanfaatan Tanah Kasultanan, maka untuk melaksanakan ketentuan Pasal 15 ayat (3) Peraturan Menteri Agraria dan Tata Ruang/Kepala Badan Pertanahan Nasional Nomor 2 Tahun 2022 tentang Pendaftaran Tanah Kasultanan dan Tanah Kadipaten, Karaton Ngayogyakarta Hadiningrat perlu menerbitkan Serat Palilah sebagai izin sementara pemanfaatan Tanah Kasultanan sebelum diterbitkannya Serat Kekancingan;</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;">Mengingat</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 3%; vertical-align: top;">1.</td>
                <td style="width: 80%; text-align: justify;">Pasal 18B ayat (1) Undang-Undang Dasar Republik Indonesia Tahun 1945;</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;"></td>
                <td style="width: 2%; vertical-align: top;"></td>
                <td style="width: 3%; vertical-align: top;">2.</td>
                <td style="width: 80%; text-align: justify;">Undang-Undang Nomor 13 Tahun 2012 tentang Keistimewaan Daerah Istimewa Yogyakarta (Lembaran Negara Republik Indonesia Tahun 2012 Nomor 170, Tambahan Lembaran Negara Republik Indonesia Nomor 5339);</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;"></td>
                <td style="width: 2%; vertical-align: top;"></td>
                <td style="width: 3%; vertical-align: top;">3.</td>
                <td style="width: 80%; text-align: justify;">Peraturan Pemerintah Nomor 18 Tahun 2021 tentang Hak Pengelolaan, Hak Atas Tanah, Satuan Rumah Susun, dan Pendaftaran Tanah (Lembaran Negara Republik Indonesia Tahun 2021 Nomor 28, Tambahan Lembaran Negara Republik Indonesia Nomor 6630);</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;"></td>
                <td style="width: 2%; vertical-align: top;"></td>
                <td style="width: 3%; vertical-align: top;">4.</td>
                <td style="width: 80%; text-align: justify;">Peraturan Menteri Agraria dan Tata Ruang/ Kepala Badan Pertanahan Nasional Nomor 2 Tahun 2022 tentang Pendaftaran Tanah Kasultanan dan Tanah Kadipaten di Daerah Istimewa Yogyakarta (Berita Negara Republik Indonesia Tahun 2022 Nomor 246);</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;"></td>
                <td style="width: 2%; vertical-align: top;"></td>
                <td style="width: 3%; vertical-align: top;">5.</td>
                <td style="width: 80%; text-align: justify;">Peraturan Daerah Istimewa Daerah Istimewa Yogyakarta Nomor 1 Tahun 2017 tentang Pengelolaan dan Pemanfaatan Tanah Kasultanan dan Tanah Kadipaten (Lembaran Daerah Daerah Istimewa Yogyakarta Tahun 2017 Nomor 1, Tambahan Lembaran Daerah Daerah Istimewa Yogyakarta Nomor 1);</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;"></td>
                <td style="width: 2%; vertical-align: top;"></td>
                <td style="width: 3%; vertical-align: top;">6.</td>
                <td style="width: 80%; text-align: justify;">Peraturan Gubernur Daerah Istimewa Yogyakarta Nomor 33 Tahun 2017 tentang Tata Cara Pengelolaan dan Pemanfaatan Tanah Kasultanan dan Tanah Kadipaten (Berita Daerah Daerah Istimewa Yogyakarta Tahun 2017 Nomor 34);</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;"></td>
                <td style="width: 2%; vertical-align: top;"></td>
                <td style="width: 3%; vertical-align: top;">7.</td>
                <td style="width: 80%; text-align: justify;">Peraturan Gubernur Daerah Istimewa Yogyakarta Nomor 49 Tahun 2018 tentang Prosedur Permohonan Pemanfaatan Tanah Kasultanan dan Tanah Kadipaten (Berita Daerah Daerah Istimewa Yogyakarta Tahun 2018 Nomor 49);</td>
            </tr>
        </table>

        <div class="title">
            <font size="3">MEMUTUSKAN</font><br>
        </div>

        <table style="width: 100%">
            <tr>
                <td style="width: 15%; vertical-align: top;">Menetapkan</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 83%; text-align: justify;">SERAT PALILAH KARATON NGAYOGYAKARTA HADININGRAT KAWEDANAN HAGENG PUNOKAWAN DATU DANA SUYASA TENTANG PEMBERIAN IZIN  SEMENTARA PEMANFAATAN TANAH KASULTANAN KEPADA {{ Str::upper($berkas->nama_pemegang) }}</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;">PERTAMA</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 83%; text-align: justify;">Memberikan izin sementara untuk memanfaatkan Tanah Kasultanan sebagai Pemegang Serat Palilah dengan {{ Str::upper($berkas->hak->nama) }} kepada:</td>
            </tr>
        </table>

        <table style="width: 100%">
            <tr>
                <td style="width: 20%;"></td>
                <td style="width: 30%;">NAMA</td>
                <td style="width: 2%;">:</td>
                <td style="width: 48%;">{{ Str::upper($berkas->nama_pemegang) }}</td>
            </tr>
            <tr>
                <td style="width: 20%;"></td>
                <td style="width: 30%;">TEMPAT / TGL. LAHIR</td>
                <td style="width: 2%;">:</td>
                <td style="width: 48%;">{{ Str::upper($berkas->tmplahir_Pemegang) . ' / ' . date('d-m-Y',strtotime($berkas->tgllahir_pemegang)) }}</td>
            </tr>
            <tr>
                <td style="width: 20%;"></td>
                <td style="width: 30%;">NIK</td>
                <td style="width: 2%;">:</td>
                <td style="width: 48%;">{{ Str::upper($berkas->nik_pemegang) }}</td>
            </tr>
            <tr>
                <td style="width: 20%; vertical-align: top;"></td>
                <td style="width: 30%; vertical-align: top;">ALAMAT</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 48%;">{{ Str::upper($berkas->alamat_pemegang) }}</td>
            </tr>
        </table>

        <table style="width: 100%">
            <tr>
                <td style="width: 15%; vertical-align: top;"></td>
                <td style="width: 2%; vertical-align: top;"></td>
                <td style="width: 83%;">Atas sebidang Tanah Kasultanan terletak di :</td>
            </tr>
        </table>

        <table style="width: 100%">
            <tr>
                <td style="width: 20%;"></td>
                <td style="width: 30%;">{{ Str::upper($berkas->padkam->type) }}</td>
                <td style="width: 2%;">:</td>
                <td style="width: 48%;">{{ Str::upper($berkas->padkam->nama) }}</td>
            </tr>
            <tr>
                <td style="width: 20%;"></td>
                <td style="width: 30%;">{{ Str::upper($berkas->kalkel->type) }}</td>
                <td style="width: 2%;">:</td>
                <td style="width: 48%;">{{ Str::upper($berkas->kalkel->nama) }}</td>
            </tr>
            <tr>
                <td style="width: 20%;"></td>
                <td style="width: 30%;">{{ Str::upper($berkas->kapkem->type) }}</td>
                <td style="width: 2%;">:</td>
                <td style="width: 48%;">{{ Str::upper($berkas->kapkem->nama) }}</td>
            </tr>
            <tr>
                <td style="width: 20%;"></td>
                <td style="width: 30%;">{{ Str::upper($berkas->kabkota->type) }}</td>
                <td style="width: 2%;">:</td>
                <td style="width: 48%;">{{ Str::upper($berkas->kabkota->nama) }}</td>
            </tr>
            <tr>
                <td style="width: 20%;"></td>
                <td style="width: 30%;">LUAS</td>
                <td style="width: 2%;">:</td>
                <td style="width: 48%;">{{ number_format($berkas->luas_ukur,0,',','.') }} M2</td>
            </tr>
            <tr>
                <td style="width: 20%; vertical-align: top;"></td>
                <td style="width: 30%; vertical-align: top;">NPK</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 48%;">{{ str_pad($berkas->npk, '5', '0', STR_PAD_LEFT) . '/' . Str::upper($berkas->kalkel->nama) }}</td>
            </tr>
            <tr>
                <td style="width: 20%; vertical-align: top;"></td>
                <td style="width: 30%; vertical-align: top;">GAMBAR SITUASI</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 48%;">{{ $berkas->no_gs }}</td>
            </tr>
        </table>

        <table style="width: 100%">
            <tr>
                <td style="width: 15%; vertical-align: top;"></td>
                <td style="width: 2%; vertical-align: top;"></td>
                @php
                    $ket = $berkas->ket;
                @endphp

                @if ($ket)
                    <td style="width: 83%; text-align: justify;">Dimanfaatkan untuk {{ $berkas->penggunaan->nama }} : {{ $berkas->ket }} </td>
                @else
                    <td style="width: 83%; text-align: justify;">Dimanfaatkan untuk {{ $berkas->penggunaan->nama }}</td>
                @endif

            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;">KEDUA</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 83%; text-align: justify;">Serat Palilah ini bersifat sementara dan sebagai syarat dalam pengurusan Serat Kekancingan.</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;">KETIGA</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 83%; text-align: justify;">Serat Palilah ini berakhir dalam hal telah diterbitkan Serat Kekancingan atas nama Pemegang Serat Palilah dengan obyek sebagaimana disebutkan dalam Diktum Pertama.</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;">KEEMPAT</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 83%; text-align: justify;">Serat Palilah berlaku dalam jangka waktu 1 (satu) tahun, serta dapat ditinjau kembali.</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;">KELIMA</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 83%; text-align: justify;">Dalam hal sertipikat hak milik Kasultanan telah terbit sebelum 1 (satu) tahun, Kasultanan menerbitkan Serat Kekancingan dan Serat Palilah dinyatakan tidak berlaku.</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;">KEENAM</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 83%; text-align: justify;">Dalam hal Serat Palilah telah mencapai jangka waktu 1 (satu) tahun, namun Sertipikat Hak Milik Kasultanan belum terbit, Pemegang Serat Palilah wajib mengajukan perpanjangan Serat Palilah.</td>
            </tr>
            <tr>
                <td style="width: 15%; vertical-align: top;">KETUJUH</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 83%; text-align: justify;">Kawedanan Hageng Punokawan Datu Dana Suyasa dapat mencabut Serat Palilah secara sepihak dalam hal Pemegang Serat Palilah melanggar ketentuan hukum yang berlaku.</td>
            </tr>
        </table>



        <br>
        <table style="width: 100%">
            <tr>
                <td style="width: 35%"></td>
                <td style="width: 65%; text-align: left ">Ditetapkan di : Karaton Ngayogyakarta Hadiningrat</td>
            </tr>
            <tr>
                <td style="width: 35%"></td>
                @php
                    use App\Utils\DateUtils;
                    $tgl_serat = DateUtils::tgl_indo($berkas->tgl_serat);
                @endphp
                <td style="width: 65%; text-align: left ">Pada tanggal : {{ $tgl_serat }}</td>
            </tr>
            <tr>
                <td style="width: 35%"></td>
                <td style="width: 65%; text-align: left ">---------------------------------------------------------------
            </tr>
            <tr>
                <td style="width: 35%"></td>
                <td style="width: 65%; text-align: left ">PENGHAGENG KAWEDANAN HAGENG PUNOKAWAN DATU DANA SUYASA</td>
            </tr>
            <tr>
                <td style="width: 35%"></td>
                <td style="width: 65%; text-align: left ">KARATON NGAYOGYAKARTA HADININGRAT,</td>
            </tr>
            <br><br><br>
            <tr>
                <td style="width: 35%"></td>
                <td style="width: 65%; text-align: left ">GUSTI KANGJENG RATU MANGKUBUMI</td>
            </tr>
        </table>

    </div>
</div>
</body>
</html>
