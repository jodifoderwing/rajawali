<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Survey</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin-top: 1px;
            margin-left: 30px;
            margin-right: 20px;
            box-sizing: border-box;
        }
        .header {
            margin-top: 10px;
            text-align: center;
        }
        .content {
            padding: 5px;
            margin-top:5px;
            line-height: 1.35;
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
    </div>

    <div class="header">
        <u><font size="3"><strong>FORMULIR SURVEY LAPANGAN<strong></font></u><br>
        <font size="3">No. Berkas : {{ $berkas->noberkas }}</font><br>
    </div>

    <div class="content">
        <div style="text-align: left; font-weight: bold">A. IDENTITAS PEMOHON</div>
        <table style="width: 100%; border-collapse: collapse" border="1">
            <tr>
                <td style="width: 5%">1.</td>
                <td style="width: 25%">Nama</td>
                <td style="width: 70%">{{ $berkas->nama }}</td>
            </tr>
            <tr>
                <td style="width: 5%">2.</td>
                <td style="width: 25%">NIK</td>
                <td style="width: 70%">{{ $berkas->nik }}</td>
            </tr>
            <tr>
                <td style="width: 5%">3.</td>
                <td style="width: 25%">No. Handphone</td>
                <td style="width: 70%">{{ $berkas->nohp }}</td>
            </tr>
            <tr>
                <td style="width: 5%">4.</td>
                <td style="width: 25%">Alamat</td>
                <td style="width: 70%">{{ $berkas->alamat }}</td>
            </tr>
        </table>

        <div style="text-align: left; font-weight: bold">B. DATA TANAH KASULTANAN</div>
        <table style="width: 100%; border-collapse: collapse" border="1">
            <tr>
                <td style="width: 5%">1.</td>
                <td style="width: 25%">Status SHM</td>
                <td style="width: 70%">[...]Sudah SHM. [...]Belum SHM</td>
            </tr>
            <tr>
                <td style="width: 5%">2.</td>
                <td style="width: 25%">NIB / Luas</td>
                <td style="width: 70%">NIB : .................................. Luas : ...................................M²</td>
            </tr>
            <tr>
                <td style="width: 5%">3.</td>
                <td style="width: 25%">{{ ucwords(strtolower($berkas->padkam->type)) }}</td>
                <td style="width: 70%">{{ ucwords(strtolower($berkas->padkam->nama)) }}</td>
            </tr>
            <tr>
                <td style="width: 5%">4.</td>
                <td style="width: 25%">{{ ucwords(strtolower($berkas->kalkel->type)) }}</td>
                <td style="width: 70%">{{ ucwords(strtolower($berkas->kalkel->nama)) }}</td>
            </tr>
            <tr>
                <td style="width: 5%">5.</td>
                <td style="width: 25%">{{ ucwords(strtolower($berkas->kapkem->type)) }}</td>
                <td style="width: 70%">{{ ucwords(strtolower($berkas->kapkem->nama)) }}</td>
            </tr>
            <tr>
                <td style="width: 5%">6.</td>
                <td style="width: 25%">{{ ucwords(strtolower($berkas->kabkota->type)) }}</td>
                <td style="width: 70%">{{ ucwords(strtolower($berkas->kabkota->nama)) }}</td>
            </tr>
        </table>

        <div style="text-align: left; font-weight: bold">C. PENGGUNAAN TANAH DIMOHON</div>
        <table style="width: 100%; border-collapse: collapse" border="1">
            <tr>
                <td style="width: 5%">1.</td>
                <td style="width: 25%">Luas permohonan</td>
                <td style="width: 70%">{{ number_format($berkas->luas,0,',','.') }} M²</td>
            </tr>
            <tr>
                <td style="width: 5%">2.</td>
                <td style="width: 25%">Alamat Letak Tanah</td>
                <td style="width: 70%">. <br> .</td>
            </tr>
            <tr>
                <td style="width: 5%">3.</td>
                <td style="width: 25%">Digunakan</td>
                <td style="width: 70%">[...]Sebagian. [...]Seluruhnya. Dari Tanah Kasultanan</td>
            </tr>
            <tr>
                <td style="width: 5%">4.</td>
                <td style="width: 25%">Lokasi Tanah</td>
                <td style="width: 70%">[...]Strategis. [...]Jalan raya. [...]Jalan kampung. [...]................</td>
            </tr>
            <tr>
                <td style="width: 5%">5.</td>
                <td style="width: 25%">Bangunan</td>
                <td style="width: 70%">[...]Ada Bangunan. [...]Tidak ada bangunan.</td>
            </tr>
            <tr>
                <td style="width: 5%">6.</td>
                <td style="width: 25%">Kondisi Bangunan</td>
                <td style="width: 70%">[...]Semi Permanent. [...]Standard. [...]Baik. [...]Mewah.</td>
            </tr>
            <tr>
                <td style="width: 5%">7.</td>
                <td style="width: 25%">Pemanfaatan</td>
                <td style="width: 70%">[...]Tempat tinggal. [...]Usaha. [...]Tempat tinggal dan usaha.</td>
            </tr>
            <tr>
                <td style="width: 5%">8.</td>
                <td style="width: 25%">Keterangan</td>
                <td style="width: 70%"></td>
            </tr>
        </table>

        <div style="text-align: left; font-weight: bold">D. KONDISI SOSIAL EKONOMI</div>
        <table style="width: 100%; border-collapse: collapse" border="1">
            <tr>
                <td style="width: 5%">1.</td>
                <td style="width: 25%">Pekerjaan</td>
                <td style="width: 70%"></td>
            </tr>
            <tr>
                <td style="width: 5%">2.</td>
                <td style="width: 25%">Pengahasilan</td>
                <td style="width: 70%">[...]Di bawah UMR. [...]Sesuai UMR. [...]Di atas UMR.</td>
            </tr>
            <tr>
                <td style="width: 5%">3.</td>
                <td style="width: 25%">Status</td>
                <td style="width: 70%">[...]Abdi dalem. [...]Bukan abdi dalem.</td>
            </tr>
        </table>
        <br>

        <table style="width: 100%; text-align: center; border-collapse: collapse">
            <tr>
                <td style="width: 40%"></td>
                <td style="width: 60%">Tanggal : ........... - ........... - .....................</td>
            </tr>
            <br>
            <tr>
                <td style="width: 40%">PEMOHON</td>
                <td style="width: 60%">PETUGAS SURVEY</td>
            </tr>
            <br>
            <tr>
                <td style="width: 40%"></td>
                <td style="width: 60%">1. .................................................. (....................)</td>
            </tr>
            <br>
            <tr>
                <td style="width: 40%"></td>
                <td style="width: 60%">2. .................................................. (....................)</td>
            </tr>
                <td style="width: 40%">(...................................................)</td>
                <td style="width: 60%"></td>
            </tr>
        </table>

    </div>
</div>
</body>
</html>
