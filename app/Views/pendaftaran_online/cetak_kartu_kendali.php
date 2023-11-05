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

    .table {
        font-size: 12px;

    }

    .hr {
        margin-top: 90px;

    }
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
        <b><u>Kartu Kendali</u></b>

    </div>

    <div class="text-center"> <b><u><?= $r['tblizinpermohonan_nama'] ?></u></b></div>
    <div class="text-center" style="margin-bottom: 20px;"> <b><?= $r['tblizinpendaftaran_nomor'] ?></b>
    </div>

    <table class="table" cellpadding="2" cellspacing="2" width="100%">
        <tr>
            <td>Nama Pemohon</td>
            <td>:</td>
            <td width="250"> <?= $r['tblizinpendaftaran_namapemohon'] ?></td>
            <td> No Telp / HP</td>
            <td>:</td>
            <td><?= $r['tblizinpendaftaran_telponpemohon'] ?></td>
        </tr>
        <tr>
            <td>Alamat Pemohon</td>
            <td>:</td>
            <td> <?= $r['tblizinpendaftaran_almtpemohon'] ?></td>
            <td>Tanggal Permohonan</td>
            <td>:</td>
            <td><?= $r['tblizinpendaftaran_tgljam'] ?></td>
        </tr>
        <tr>
            <td>Nama Usaha</td>
            <td>:</td>
            <td><?= $r['tblizinpendaftaran_usaha'] ?></td>
            <td>Lokasi</td>
            <td>:</td>
            <td><?= $r['tblizinpendaftaran_lokasiizin'] ?></td>
        </tr>


    </table>

    <table class="table" border="1" style="border-collapse: collapse;margin-bottom: 20px;margin-top: 20px;" width="100%"
        cellpadding="2" cellspacing="2">
        <tr>
            <th>No.</th>
            <th>Syarat - Syarat</th>
            <th>Ada</th>
            <th>Tidak Ada</th>
            <th>Keterangan</th>
        </tr>
        <?php $no = 1; ?>
        <?php foreach ($p as $row) : ?>
        <tr>
            <td><?= $no ?>.</td>
            <td><?= $row['tblpersyaratan_nama'] ?></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <?php $no++ ?>
        <?php endforeach ?>
    </table>

    <table class="table" width="100%" cellpadding="2" cellspacing="4">
        <tr>
            <td align="center" colspan="3" width="100%"><b>1. Staff Loket Pelayanan</b></td>
            <td align="center" colspan="3" width="100%"><b>2. Pengetikan</b></td>
        </tr>
        <tr>
            <td>Diterima</td>
            <td>:</td>
            <td>.....................................................</td>
            <td>Diterima</td>
            <td>:</td>
            <td>.....................................................</td>
        </tr>
        <tr>
            <td>Nomor Agenda</td>
            <td>:</td>
            <td>.....................................................</td>
            <td>Nomor Agenda</td>
            <td>:</td>
            <td>.....................................................</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>.....................................................</td>
            <td>Nama</td>
            <td>:</td>
            <td>.....................................................</td>
        </tr>
        <tr>
            <td>Paraf</td>
            <td>:</td>
            <td>.....................................................</td>
            <td>Paraf</td>
            <td>:</td>
            <td>.....................................................</td>
        </tr>


        <tr>
            <td align="center" colspan="3" width="100%"><b>3. Kabid PM/ Kabid Perizinan Tertentu/ Kabid Perizinan Jasa
                    Usaha</b></td>
            <td align="center" colspan="3" width="100%"><b>4. Sekretaris</b></td>
        </tr>
        <tr>
            <td>Diterima</td>
            <td>:</td>
            <td>.....................................................</td>
            <td>Diterima</td>
            <td>:</td>
            <td>.....................................................</td>
        </tr>
        <tr>
            <td>Nomor Agenda</td>
            <td>:</td>
            <td>.....................................................</td>
            <td>Nomor Agenda</td>
            <td>:</td>
            <td>.....................................................</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>.....................................................</td>
            <td>Nama</td>
            <td>:</td>
            <td>.....................................................</td>
        </tr>
        <tr>
            <td>Paraf</td>
            <td>:</td>
            <td>.....................................................</td>
            <td>Paraf</td>
            <td>:</td>
            <td>.....................................................</td>
        </tr>




        <tr>
            <td align="center" colspan="3" width="100%"><b>5. Penandatangan Kepala DPM&PTSP </b></td>
            <td align="center" colspan="3" width="100%"><b>6. Loket Pengambilan</b></td>
        </tr>
        <tr>
            <td>Diterima</td>
            <td>:</td>
            <td>.....................................................</td>
            <td>Diterima</td>
            <td>:</td>
            <td>.....................................................</td>
        </tr>
        <tr>
            <td>Nomor Agenda</td>
            <td>:</td>
            <td>.....................................................</td>
            <td>Nomor Agenda</td>
            <td>:</td>
            <td>.....................................................</td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td>.....................................................</td>
            <td>Nama</td>
            <td>:</td>
            <td>.....................................................</td>
        </tr>
        <tr>
            <td>Paraf</td>
            <td>:</td>
            <td>.....................................................</td>
            <td>Paraf</td>
            <td>:</td>
            <td>.....................................................</td>
        </tr>
    </table>
</body>

</html>