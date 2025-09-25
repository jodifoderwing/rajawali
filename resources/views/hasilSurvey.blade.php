<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulir Hasil Survey</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0px 10px 0 20px;
        }
        .header {
            text-align: center;
            margin-top: 10px;
        }
        .content {
            margin-top: 10px;
            line-height: 1.5;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        /* table, td {
            border: 1px solid black;
        } */
        td {
            padding: 1px;
        }
        .section-title {
            text-align: left;
            font-weight: bold;
            /* margin-top: 20px; */
        }
        .page-break {
            page-break-before: always;
        }
        .logo-table {
            width: 100%;
            border: none;
        }
        .logo-table td {
            border: none;
        }

        .foto-td {
        width: 50%;
        height: 200px;
        padding: 10px; /* <- padding cantik */
        box-sizing: border-box;
        border: 1px solid black;
        }
        .foto-img {
            width: 100%;
            height: 20%;
            object-fit: cover;
            border-radius: 4px; /* sudut sedikit membulat biar elegan */
            display: block;
            box-shadow: 0 0 4px rgba(0,0,0,0.1); /* opsional: efek bayangan */
        }
        .foto-placeholder {
            width: 100%;
            height: 20%;
            background: #eee;
            color: #777;
            font-style: italic;
            text-align: center;
            line-height: 180px; /* disesuaikan biar rata tengah vertikal */
            border-radius: 4px;
        }

        .tabel-data {
        border-collapse: collapse;
        }
        .tabel-data td {
            border: 1px solid black;
        }

        .tabel-penutup {
        border-collapse: collapse;
        }
        .tabel-penutup td {
            border: none;
        }
    </style>
</head>
<body>

    <!-- Halaman Pertama -->
    <table class="logo-table">
        <tr>
            <td><img src="images/logo.jpg" width="80" height="80"></td>
            <td style="text-align: center;">
                <div style="font-size: 24px;">KARATON NGAYOGYAKARTA HADININGRAT</div>
                <div style="font-size: 20px; font-weight: bold;">KAWEDANAN HAGENG PUNOKAWAN DATU DANA SUYASA</div>
                <div style="font-size: 14px;">Alamat : Alun-alun Utara Komplek Pracimasana Karaton Ngayogyakarta Hadiningrat</div>
            </td>
        </tr>
    </table>
    <hr style="border: 1px solid black;">

    <div class="header">
        <u><strong style="font-size: 16px;">FORMULIR HASIL SURVEY LAPANGAN</strong></u><br>
        <span style="font-size: 16px;">No. Berkas : {{ $berkas->noberkas }}</span>
    </div>

    <div class="content">
        <div class="section-title">A. IDENTITAS PEMOHON</div>
        <table class="tabel-data">
            <tr><td style="width:5%; text-align: center;">1.</td><td style="width:30%;">NAMA</td><td style="width:65%;">{{ $berkas->nama }}</td></tr>
            <tr><td style="text-align: center;">2.</td><td>NIK</td><td>{{ $berkas->nik }}</td></tr>
            <tr><td style="text-align: center;">3.</td><td>NOMOR HP</td><td>{{ $berkas->nohp }}</td></tr>
            <tr><td style="text-align: center;">4.</td><td>ALAMAT</td><td>{{ $berkas->alamat }}</td></tr>
        </table>

        <div class="section-title">B. DATA TANAH KASULTANAN</div>
        <table class="tabel-data">

            @if ($berkas->statshm_id === 1)
                @php
                    $shmsgId = $berkas->shmsg_id;
                    $shmsg = \App\Models\Shmsg::find($shmsgId); // pastikan pakai namespace jika di luar controller
                    $noshm = ' / NOMOR : ' . $shmsg?->nohak ?? '-';
                    $luas = number_format($shmsg?->luassu, 0, ",", ".") . ' M²';
                @endphp
                <tr><td style="width:5%; text-align: center;">1.</td><td style="width:30%;">STATUS SHM</td><td style="width:65%;">{{ $berkas?->statshm?->nama }} {{ $noshm }} </td></tr>
                <tr><td style="text-align: center;">2.</td><td>LUAS</td><td>{{ $luas }}</td></tr>
            @else
                <tr><td style="width:5%; text-align: center;">1.</td><td style="width:30%;">STATUS SHM</td><td style="width:65%;">{{ $berkas?->statshm?->nama }} </td></tr>
                <tr><td style="text-align: center;">2.</td><td>ALAS HAK</td><td>{{ $berkas->alashak_sg }}</td></tr>
            @endif

            {{-- Alternatif Lebih Aman (Tanpa @php) : Gunakan optional() helper --}}
            {{-- <tr><td style="width:5%; text-align: center;">1.</td><td style="width:30%;">STATUS SHM</td><td style="width:65%;">{{ $berkas->is_shm }} / {{ optional(\App\Models\Shmsg::find($berkas->shmsg_id))->nohak ?? '-' }}</td></tr> --}}

            <tr><td style="text-align: center;">3.</td><td>{{ $berkas->padkam->type }}</td><td>{{ $berkas->padkam->nama }}</td></tr>
            <tr><td style="text-align: center;">4.</td><td>{{ $berkas->kalkel->type }}</td><td>{{ $berkas->kalkel->nama }}</td></tr>
            <tr><td style="text-align: center;">5.</td><td>{{ $berkas->kapkem->type }}</td><td>{{ $berkas->kapkem->nama }}</td></tr>
            <tr><td style="text-align: center;">6.</td><td>{{ $berkas->kabkota->type }}</td><td>{{ $berkas->kabkota->nama }}</td></tr>
        </table>

        <div class="section-title">C. PENGGUNAAN TANAH DIMOHON</div>
        <table class="tabel-data">
            <tr><td style="width:5%; text-align: center;">1.</td><td style="width:30%;">LUAS PERMOHONAN</td><td style="width:65%;">{{ number_format($berkas->luas,0,',','.') }} M²</td></tr>
            <tr><td style="text-align: center;">2.</td><td>ALAMAT LETAK TANAH</td><td>{{ $berkas->alamat_tanah }}</td></tr>
            <tr><td style="text-align: center;">3.</td><td>TANAH DIMOHON</td><td>{{ $berkas?->utuhseb?->nama }}</td></tr>
            <tr><td style="text-align: center;">4.</td><td>POSISI TANAH</td><td>{{ $berkas?->posisi?->nama }}</td></tr>
            <tr><td style="text-align: center;">5.</td><td>BANGUNAN</td><td>{{ $berkas?->adabangunan?->nama }}</td></tr>
            <tr><td style="text-align: center;">6.</td><td>KONDISI BANGUNAN</td><td>{{ $berkas?->kondbangunan?->nama }}</td></tr>
            <tr><td style="text-align: center;">7.</td><td>PENGGUNAAN</td><td>{{ $berkas?->penggunaan?->nama }}</td></tr>
            <tr><td style="text-align: center;">8.</td><td>KETERANGAN</td><td>{{ $berkas?->ket }}</td></tr>
        </table>

        <div class="section-title">D. KONDISI SOSIAL EKONOMI</div>
        <table class="tabel-data">
            <tr><td style="width:5%; text-align: center;">1.</td><td style="width:30%;">PEKERJAAN</td><td style="width:65%;">{{ $berkas->pekerjaan }}</td></tr>
            <tr><td style="text-align: center;">2.</td><td>PENGHASILAN</td><td>{{ $berkas?->umr?->nama }}</td></tr>
            <tr><td style="text-align: center;">3.</td><td>STATUS ABDI DALEM</td><td>{{ $berkas?->abdi?->nama }}</td></tr>
        </table>

        <div class="section-title">E. PENGUKURAN DAN PEMETAAN</div>
        <table class="tabel-data">
            <tr><td style="width:5%; text-align: center;">1.</td><td style="width:30%;">NO. PERSIL (NPK)</td><td style="width:65%;">{{ str_pad($berkas?->npk, '5', '0', STR_PAD_LEFT) . '/' . Str::upper($berkas->kalkel->nama) }}</td></tr>
            <tr><td style="text-align: center;">2.</td><td>KOORDINAT</td><td>({{ $berkas?->koordinat }})</td></tr>
            <tr><td style="text-align: center;">3.</td><td>LUAS HASIL UKUR</td><td>{{ number_format($berkas?->luas_ukur,0,',','.') }} M²</td></tr>
        </table>

    </div>

    <!-- Halaman Kedua -->
    <div class="page-break"></div>
    <div class="content">
        <div class="section-title">F. FOTO-FOTO</div>
        {{-- <table>
            <tr><td style="width: 50%; height: 200px; text-align: center;"><img src="{{ storage_path('app/public/') . $berkas->upload_fotolap[0] }}" style="width: 100%; height: 20%; object-fit: cover;"></td><td style="width: 50%;"><img src="{{ storage_path('app/public/') . $berkas->upload_fotolap[1] }}" style="width: 100%; height: 20%; object-fit: cover;"></td></tr>
            <tr><td style="width: 50%; height: 20%;"><img src="{{ storage_path('app/public/') . $berkas->upload_fotolap[2] }}" style="width: 100%; height: 20%; object-fit: cover;"></td><td style="width: 50%;"><img src="{{ storage_path('app/public/') . $berkas->upload_fotolap[3] }}" style="width: 100%; height: 20%; object-fit: cover;"></td></tr>
        </table> --}}

        <table>
            {{-- Baris pertama --}}
            <tr>
                <td class="foto-td">
                    @if (!empty($berkas->upload_fotolap[0]))
                        <img src="{{ storage_path('app/public/') . $berkas->upload_fotolap[0] }}" class="foto-img">
                    @else
                        <div class="foto-placeholder">Foto tidak tersedia</div>
                    @endif
                </td>
                <td class="foto-td">
                    @if (!empty($berkas->upload_fotolap[1]))
                        <img src="{{ storage_path('app/public/') . $berkas->upload_fotolap[1] }}" class="foto-img">
                    @else
                        <div class="foto-placeholder">Foto tidak tersedia</div>
                    @endif
                </td>
            </tr>

            {{-- Baris kedua --}}
            <tr>
                <td class="foto-td">
                    @if (!empty($berkas->upload_fotolap[2]))
                        <img src="{{ storage_path('app/public/') . $berkas->upload_fotolap[2] }}" class="foto-img">
                    @else
                        <div class="foto-placeholder">Foto tidak tersedia</div>
                    @endif
                </td>
                <td class="foto-td">
                    @if (!empty($berkas->upload_fotolap[3]))
                        <img src="{{ storage_path('app/public/') . $berkas->upload_fotolap[3] }}" class="foto-img">
                    @else
                        <div class="foto-placeholder">Foto tidak tersedia</div>
                    @endif
                </td>
            </tr>
        </table>

    </div>

    <div>

        <br>

        <table style="tabel-penutup">
            <tr>
                <td style="width: 50%"></td>
                <td style="width: 50%">Tanggal : .......... - .......... - ....................</td>
            </tr>
            <br>
            <tr>
                <td style="width: 50%; text-align: center">PETUGAS SURVEY</td>
                <td style="width: 50%; text-align: center">KOORDINATOR SURVEY</td>
            </tr>
            <br>
            <tr>
                <td style="width: 50%">1.</td>
                <td style="width: 50%"></td>
            </tr>
            <br><br><br><br>
            <tr>
                <td style="width: 50%; text-align: center">{{ Auth::user()->name }}</td>
                <td style="width: 50%; text-align: center">KRT. YOSOHUTOMO</td>
            </tr>
            <br><br>

            <tr>
                <td style="width: 50%">2.</td>
                <td style="width: 50%"></td>
            </tr>

            <br><br><br><br>

            <tr>
                <td style="width: 50%; text-align: center">...................................................</td>
                <td style="width: 50%"></td>
            </tr>
        </table>
    </div>



</body>
</html>
