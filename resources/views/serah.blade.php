<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Terima</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin-top: 1px;
            margin-left: 30px;
            margin-right: 20px;
        }
        .header {
            margin-top: 20px;
            text-align: center;
        }
        .content {
            margin-top:20px;
            line-height: 1.6;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
        }
    </style>
</head>
<body>
<div style="width: auto; height: auto; position :absolute">
    <div>

        <center>
            <table>
                <tr>
                    <td><img src="images/logo.jpg" width="80" height="80"></td>
                    <td>
                        <center>
                            <font size="5">KARATON NGAYOGYAKARTA HADININGRAT</font><br>
                            <font size="4"><strong>KAWEDANAN HAGENG PUNOKAWAN DATU DANA SUYASA</strong></font><br>
                            <font size="2">Alamat : Alun-alun Utara Komplek Pracimasana Karaton Ngayogyakarta Hadiningrat</font><br>
                            <font size="2"></font>
                        </center>
                    </td>
                </tr>
            </table>
            <hr style="border: 1px solid black;">
        </center>

    </div>

    @php
        use App\Models\Warkah;
        $warkah = Warkah::where('berkas_id', $berkas->id)->first();
        $noWarkah = $warkah->no_warkah;
    @endphp

    <div style="text-align: right">{{ $noWarkah }}</div>

    <div class="header">
        <u><font size="3"><strong>TANDA TERIMA {{ Str::upper($berkas->jenis_serat) }}<strong></font></u><br>
        <font size="3">Nomor : {{ $berkas->no_di301a }}</font><br><br>
    </div>

    <div class="content">
        <font size="3">Telah terima {{ $berkas->jenis_serat }}</font><br>
        <table style="width: 100%">
            <tr>
                <td style="width: 8%"></td>
                <td style="width: 30%; vertical-align: top;">Nomor</td>
                <td style="width: 2%";>:</td>
                <td style="width: 70%;">{{ $berkas->no_serat }}</td>
            </tr>
            <tr>
                <td style="width: 8%"></td>
                <td style="width: 30%; vertical-align: top;">Tanggal</td>
                <td style="width: 2%";>:</td>
                <td style="width: 70%;">{{ date('d-m-Y',strtotime($berkas->tgl_serat)) }}</td>
            </tr>
            <tr>
                <td style="width: 8%"></td>
                <td style="width: 30%; vertical-align: top;">Atas Nama</td>
                <td style="width: 2%";>:</td>
                <td style="width: 70%;">{{ $berkas->nama_pemegang }}</td>
            </tr>
            <tr>
                <td style="width: 8%"></td>
                <td style="width: 30%; vertical-align: top;">Alamat</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 70%;">{{ $berkas->alamat_pemegang }}</td>
            </tr>
            <tr>
                <td style="width: 8%"></td>
                <td style="width: 30%; vertical-align: top;">No. Berkas</td>
                <td style="width: 2%";>:</td>
                <td style="width: 70%;">{{ $berkas->noberkas }}</td>
            </tr>
        </table>

        <font size="3">Atas sebidang Tanah Kasultanan :</font><br>
        <table style="width: 100%">
            <tr>
                <td style="width: 8%"></td>
                <td style="width: 30%;">Luas</td>
                <td style="width: 2%";>:</td>
                <td style="width: 70%;">{{ number_format($berkas->luas_ukur,0,',','.') }} M2</td>
            </tr>
            <tr>
                <td style="width: 8%"></td>
                <td style="width: 30%; vertical-align: top;">Nomor Persil (NPK)</td>
                <td style="width: 2%; vertical-align: top;">:</td>
                <td style="width: 70%;">{{ str_pad($berkas->npk, '5', '0', STR_PAD_LEFT)}}/{{ ucwords(strtolower($berkas->kalkel->nama)) }}</td>
            </tr>
            <tr>
                <td style="width: 8%"></td>
                <td style="width: 30%;">No. Gambar Situasi</td>
                <td style="width: 2%";>:</td>
                <td style="width: 70%;">{{ $berkas->no_gs }}</td>
            </tr>
        </table>

        <font size="3">Terletak di :</font><br>
        <table style="width: 100%">
            <tr>
                <td style="width: 8%"></td>
                <td style="width: 30%;">{{ ucwords(strtolower($berkas->padkam->type)) }}</td>
                <td style="width: 2%";>:</td>
                <td style="width: 70%;">{{ ucwords(strtolower($berkas->padkam->nama)) }}</td>
            </tr>
            <tr>
                <td style="width: 8%"></td>
                <td style="width: 30%;">{{ ucwords(strtolower($berkas->kalkel->type)) }}</td>
                <td style="width: 2%";>:</td>
                <td style="width: 70%;">{{ ucwords(strtolower($berkas->kalkel->nama)) }}</td>
            </tr>
            <tr>
                <td style="width: 8%"></td>
                <td style="width: 30%;">{{ ucwords(strtolower($berkas->kapkem->type)) }}</td>
                <td style="width: 2%";>:</td>
                <td style="width: 70%;">{{ ucwords(strtolower($berkas->kapkem->nama)) }}</td>
            </tr>
            <tr>
                <td style="width: 8%"></td>
                <td style="width: 30%;">{{ ucwords(strtolower($berkas->kabkota->type)) }}</td>
                <td style="width: 2%";>:</td>
                <td style="width: 70%;">{{ ucwords(strtolower($berkas->kabkota->nama)) }}</td>
            </tr>
        </table>

        <br>
        <br>

        <table style="width: 100%">
            <tr>
                <td style="width: 40%"></td>
                @php
                    $tgl_serah = $berkas->tgl_serah;
                @endphp

                @if ($tgl_serah)
                    <td style="width: 60%; text-align: center">Yogyakarta, {{ date('d-m-Y',strtotime($berkas->tgl_serah)) }}</td>
                @else
                    <td style="width: 60%; text-align: center">Yogyakarta, ............-............-................</td>
                @endif
            </tr>

            <tr>
                <td style="width: 40%; text-align: center">Petugas,</td>
                <td style="width: 60%; text-align: center">Penerima,</td>
            </tr>

            <br><br><br>

            <tr>
                <td style="width: 40%; text-align: center">{{ Auth::user()->name }}</td>
                <td style="width: 60%; text-align: center">{{ $berkas->nama }}</td>
            </tr>
        </table>

    </div>
</div>
</body>
</html>
