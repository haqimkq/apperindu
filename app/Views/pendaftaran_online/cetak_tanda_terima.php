<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>

    <style>
    body {
        font-family: "Times New Roman", Times, serif;
    }

    .header {
        display: table;


    }

    .logo {
        float: left;
        width: 100px;
    }

    .identity {
        float: left;
        width: 500px;
        text-align: center;
    }

    .pemkab {
        font-weight: bold;
        font-size: 16px;

    }

    .dinas {
        font-weight: bold;
        font-size: 20px;

    }

    .alamat {
        font-size: 12px;
    }

    .text-center {
        text-align: center;
    }

    table td,
    table td * {
        vertical-align: top;
    }

    .hr {
        margin-top: 90px;

    }

    /* 
        @page {
            margin-top: 3pt;
        }

        body {
            margin-top: 3pt;
        } */
    </style>
</head>

<body>

    <div class="header">
        <div class="logo">
            <img width="65" src="<?= base_url('assets/images/tala.png') ?>">
        </div>
        <div class="identity">
            <div class="pemkab">PEMERINTAH KABUPATEN TANAH LAUT</div>
            <div class="dinas">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU</div>
            <div class="alamat">Jalan A. Syairani No. 36 Pelaihari
                Telp. (0512) 22323</div>
        </div>

    </div>
    <hr class="hr">
    <div class="text-center">
        <b><u>TANDA TERIMA</u></b>

    </div>

    <div class="text-center"> <b><u><?= $r['tblizinpendaftaran_nomor'] ?></u></b></div>

    <div style="margin-top: 20px;margin-bottom: 20px;">Telah terima berkas permohonan izin :</div>

    <table cellpadding="2" cellspacing="2">
        <tr>
            <td>Nama Izin</td>
            <td>:</td>
            <td><?= $r['tblizin_nama']  ?></td>
        </tr>
        <tr>
            <td>Permohonan</td>
            <td>:</td>
            <td><?= $r['tblizinpermohonan_nama']  ?></td>
        </tr>
        <tr>
            <td>Nama Pemohon</td>
            <td>:</td>
            <td><?= $r['tblizinpendaftaran_namapemohon']  ?></td>
        </tr>
        <tr>
            <td>Nomor Identitas</td>
            <td>:</td>
            <td><?= $r['tblizinpendaftaran_idpemohon']  ?></td>
        </tr>

        <tr>
            <td>NPWP</td>
            <td>:</td>
            <td><?= $r['tblizinpendaftaran_npwp'] ?></td>
        </tr>

        <tr>
            <td>No Telp</td>
            <td>:</td>
            <td><?= $r['tblizinpendaftaran_telponpemohon'] ?></td>
        </tr>

        <tr>
            <td>Alamat Pemohon</td>
            <td>:</td>
            <td><?= $r['tblizinpendaftaran_almtpemohon'] ?></td>
        </tr>
        <tr>
            <td>Nama Usaha</td>
            <td>:</td>
            <td><?= $r['tblizinpendaftaran_usaha'] ?></td>
        </tr>

        <tr>
            <td>Alamat Lokasi / Usaha / Bangunan</td>
            <td>:</td>
            <td><?= $r['tblizinpendaftaran_lokasiizin'] ?></td>
        </tr>

        <tr>
            <td>Kelurahan</td>
            <td>:</td>
            <td><?= $r['tblkelurahan_nama'] ?></td>
        </tr>

        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td><?= $r['tblkecamatan_nama'] ?></td>
        </tr>
    </table>

    <div style="margin-top: 20px;margin-bottom: 20px;"><b>Berkas syarat yang diajukan sudah lengkap.
        </b></div>

    <table width="100%">
        <tr>
            <td width="50%"></td>
            <td align="center" width="50%"><?= tanggalhari($r['tblizinpendaftaran_tgljam']) ?></td>
        </tr>
        <tr>
            <td align="center" height="100"> Yang Mengajukan </td>
            <td align="center" height="100">Petugas Penerima</td>
        </tr>
        <tr>
            <td align="center"><?= $r['tblizinpendaftaran_namapemohon']  ?> </td>
            <td align="center"> <?= session()->nama ?>
            </td>
        </tr>
    </table>

    <div style="margin-top: 20px;">Catatan : <?= $r['tblizinpendaftaran_keterangan'] ?></div>
    <div style="margin-bottom: 20px;">Contact Person (pada Jam Kerja) :</div>
    <div>"BUKTI TANDA TERIMA PENDAFTARAN IZIN INI BUKAN MERUPAKAN TANDA BUKTI IZIN"</div>
</body>

</html>