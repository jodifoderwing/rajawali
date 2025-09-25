<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warkah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin-top: 1px;
            margin-left: 30px;
            margin-right: 20px;
        }
        .header {
            margin-top: 1px;
            text-align: center;
        }

        .title {
            margin-top: 10px;
            text-align: center;
        }
        .content {
            margin-top:10px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 90px;
            text-align: center;
        }
    </style>
</head>
<body>
<div style="width: auto; height: auto; position :absolute">
    <div class="header">
        <img src="images/logo.jpg" width="80" height="80">
    </div>

    @php
        use App\Models\Warkah;
        $id = $berkas->id;
        $warkah = Warkah::where('berkas_id', $id)->first();
    @endphp

    <div class="title">
        <font size="7"><strong>{{ $warkah->no_warkah }}<strong></font><br>
            <font size="3"><strong>TANGGAL {{ date('d/m/Y',strtotime($warkah->tgl_warkah)) }}<strong></font><br>
    </div>

    <div class="header">
        <u><font size="5"><strong>_________________________________________________<strong></font></u><br>
    </div>

    <div class="content">

        <div class="title">
            <u><font size="3"><strong>{{ strtoupper($berkas->jenis_serat) }}<strong></font></u><br>
        <div>

        <table style="width: 100%">
            <tr>
                <td style="width: 3%"></td>
                <td style="width: 30%; vertical-align: top;">NOMOR</td>
                <td style="width: 2%";>:</td>
                <td style="width: 65%;">{{ $berkas->no_serat }}</td>
            </tr>
            <tr>
                <td style="width: 3%"></td>
                <td style="width: 30%;">TANGGAL</td>
                <td style="width: 2%";>:</td>
                <td style="width: 65%;">{{ date('d-m-Y',strtotime($berkas->tgl_serat)) }}</td>
            </tr>
            <tr>
                <td style="width: 3%"></td>
                <td style="width: 30%; vertical-align: top;">JANGKA WAKTU</td>
                <td style="width: 2%";>:</td>
                <td style="width: 65%;">{{ $berkas->jangka_waktu }} Tahun</td>
            </tr>
            <tr>
                <td style="width: 3%"></td>
                <td style="width: 30%; vertical-align: top;">TGL. BERAKHIR HAK</td>
                <td style="width: 2%";>:</td>
                <td style="width: 65%;">{{ date('d-m-Y',strtotime($berkas->tgl_akhir)) }}</td>
            </tr>
            <tr>
                <td style="width: 3%"></td>
                <td style="width: 30%; vertical-align: top;">NOMOR BERKAS</td>
                <td style="width: 2%";>:</td>
                <td style="width: 65%;">{{ $berkas->noberkas }}</td>
            </tr>
        </table>

        <font size="3">_________________________________________________________________________</font><br>

        <div class="title">
            <u><font size="3"><strong>PEMEGANG {{ strtoupper($berkas->serat->nama) }}<strong></font></u><br>
        <div>

        <table style="width: 100%">
            <tr>
                <td style="width: 3%"></td>
                <td style="width: 30%; vertical-align: top;">NAMA</td>
                <td style="width: 2%";>:</td>
                <td style="width: 65%;">{{ $berkas->nama_pemegang }}</td>
            </tr>
            <tr>
                <td style="width: 3%"></td>
                <td style="width: 30%;">NIK</td>
                <td style="width: 2%";>:</td>
                <td style="width: 65%;">{{ $berkas->nik_pemegang }}</td>
            </tr>
            <tr>
                <td style="width: 3%"></td>
                <td style="width: 30%; vertical-align: top;">ALAMAT</td>
                <td style="width: 2%";>:</td>
                <td style="width: 65%;">{{ $berkas->alamat_pemegang }}</td>
            </tr>
        </table>

        <font size="3">_________________________________________________________________________</font><br>

        <div class="title">
            <u><font size="3"><strong>BIDANG TANAH<strong></font></u><br>
        <div>


        <table style="width: 100%">
            <tr>
                <td style="width: 3%"></td>
                <td style="width: 30%;">NOMOR PERSIL (NPK)</td>
                <td style="width: 2%";>:</td>
                <td style="width: 65%;">{{ str_pad($berkas->npk, '5', '0', STR_PAD_LEFT)}}/{{ ucwords(strtolower($berkas->kalkel->nama)) }}</td>
            </tr>
            <tr>
                <td style="width: 3%"></td>
                <td style="width: 30%;">LUAS</td>
                <td style="width: 2%";>:</td>
                <td style="width: 65%;">{{ number_format($berkas->luas_ukur,0,',','.') }} M2</td>
            </tr>
            <tr>
                <td style="width: 3%"></td>
                <td style="width: 30%;">GAMBAR SITUASI</td>
                <td style="width: 2%";>:</td>
                <td style="width: 65%;">{{ $berkas->no_gs }}</td>
            </tr>
            <tr>
                <td style="width: 3%"></td>
                <td style="width: 30%;">{{ Str::upper($berkas->kalkel->type) }}</td>
                <td style="width: 2%";>:</td>
                <td style="width: 65%;">{{ $berkas->kalkel->nama }}</td>
            </tr>
            <tr>
                <td style="width: 3%"></td>
                <td style="width: 30%;">{{ Str::upper($berkas->kapkem->type) }}</td>
                <td style="width: 2%";>:</td>
                <td style="width: 65%;">{{ $berkas->kapkem->nama }}</td>
            </tr>
            <tr>
                <td style="width: 3%"></td>
                <td style="width: 30%;">{{ Str::upper($berkas->kabkota->type) }}</td>
                <td style="width: 2%";>:</td>
                <td style="width: 65%;">{{ $berkas->kabkota->nama }}</td>
            </tr>
        </table>

    </div>

    <div class="header">
        <u><font size="5"><strong>_________________________________________________<strong></font></u><br>
    </div>

    <div class="footer">
        <center>
            <font size="3">KARATON NGAYOGYAKARTA HADININGRAT</font><br>
            <font size="3">KAWEDANAN HAGENG PUNOKAWAN DATU DANA SUYASA</font><br>
            <font size="3"><strong>ALBUM WARKAH {{ $warkah->album->nama }}</strong></font><br>
        </center>
    </div>

</div>
</body>
</html>
