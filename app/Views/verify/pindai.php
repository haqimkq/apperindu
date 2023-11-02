<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Kantor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <style>
    body {
        background-image: url('<?= base_url('assets/images/alesia-kazantceva-VWcPlbHglYc-unsplash.jpg') ?>');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
    }



    .card-container {
        text-align: center;
        width: 80%;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.9);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 20px;
        position: relative;
        z-index: 1;
        margin: 10px auto;

    }

    .logo {
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .card-footer {
        margin-top: 10px;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 10px;
        border-radius: 0 0 20px 20px;
        text-align: left;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .card-footer img {
        width: 100%;
        max-width: 200px;
        object-fit: cover;
        margin: 10px auto;
        margin-top: 10px;

    }

    @media (max-width: 576px) {
        .card-container {
            width: 100%;
        }


    }
    </style>
</head>

<body>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="logo">
                    <img src="<?= base_url('assets/images/1625154378.png') ?>" alt="Logo Perusahaan" width="60"
                        height="60" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="card-container">
                    <div class="row">
                        <div class="col-md-12">
                            <b>Informasi Izin</b>
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12"><b>Nomor Pendaftaran</b></div>
                                <div class="col-md-12"><?= $r['tblizinpendaftaran_nomor'] ?></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12"><b>Nomor Izin</b></div>
                                <div class="col-md-12"><?= $r['no_izin'] ?></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12"><b>Nama Pemohon</b></div>
                                <div class="col-md-12"><?= $r['tblizinpendaftaran_namapemohon'] ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12"><b>Nama Izin</b></div>
                                <div class="col-md-12"><?= $r['tblizin_nama'] ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12"><b>Nama Permohonan</b></div>
                                <div class="col-md-12">
                                    <?= $r['tblizinpermohonan_nama'] ?>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row row mt-5">
                        <div class="col-md-12">
                            <b>Informasi Dokumen</b>
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12"><b>Tanggal Pindai</b></div>
                                <div class="col-md-12"><?= $r['tgl_pindai'] ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12"><b>Tanggal Penandatanganan</b></div>
                                <div class="col-md-12"><?= $r['tgl_penandatanganan'] ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12"><b>Alasan</b></div>
                                <div class="col-md-12 alasan"> <?= $r['alasan'] ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12"><b>Penandatangan</b></div>
                                <div class="col-md-12 penandatangan"><?= $r['penandatangan'] ?></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12"><b>Dokumen</b></div>
                                <div class="col-md-12"><?= $r['dokumen']?></div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12"><b>Summary</b></div>
                                <div class="col-md-12"><?= $r['summary'] ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <p>
                            Dokumen ini telah ditandatangani secara elektronik menggunakan
                            sertifikat elektronik yang diterbitkan oleh Balai Sertifikasi
                            Elektronik (BSrE)
                        </p>
                        <img src="<?= base_url('assets/images/bsre-logo-full.aa4caa4d.png') ?>" alt="Logo BSSN" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>