<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><?= $page ?></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data <?= $page ?></li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <!-- <a class="btn btn-primary" href="<?= site_url($url . '/form_page') ?>">Tambah</a> -->
            <!-- <button class="btn btn-primary" onclick="tambah()">Tambah</button> -->
            <!-- <div class="btn-group">
                <button type="button" class="btn btn-outline-primary">Export</button>
                <button type="button"
                    class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item" href="javascript:;">PDF</a>
                    <a class="dropdown-item" href="javascript:;">Exel</a>
                 
                </div>
            </div>
            <button class="btn btn-outline-primary">Import</button> -->

        </div>
    </div>
    <!--end breadcrumb-->


    <h6 class="mb-0 text-uppercase">Data <?= $page ?></h6>

    <?php foreach ($arsip as $r) : ?>
    <hr />
    <div class="card">
        <div class="card-body">

            <div class="row">


                <div class="col-md-6">
                    <table class="table table-borderless">

                        <tr>
                            <td>Nomor Pendaftaran</td>
                            <td>:</td>
                            <td><?= $r['tblizinpendaftaran_nomor'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Pendaftaran</td>
                            <td>:</td>
                            <td><?= tanggal($r['tblizinpendaftaran_tgljam']) ?></td>
                        </tr>
                        <tr>
                            <td>Nama Izin</td>
                            <td>:</td>
                            <td><?= $r['tblizin_nama'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Permohonan</td>
                            <td>:</td>
                            <td><?= $r['tblizinpermohonan_nama'] ?></td>
                        </tr>

                        <tr>
                            <td>Nama Usaha</td>
                            <td>:</td>
                            <td><?= $r['tblizinpendaftaran_usaha'] ?></td>
                        </tr>
                        <tr>
                            <td>Lokasi Usaha / Bangunan</td>
                            <td>:</td>

                            <td><?= $r['tblizinpendaftaran_lokasiizin'] ?></td>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <td>:</td>
                            <td><?= $r['tblkecamatan_nama'] ?></td>
                        </tr>
                        <tr>
                            <td>Kelurahan</td>
                            <td>:</td>
                            <td><?= $r['tblkelurahan_nama'] ?></td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>:</td>
                            <td><?= $r['tblizinpendaftaran_keterangan'] ?></td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6">
                    <table class="table table-borderless">
                        <tr>
                            <td>Pendaftaran</td>
                            <td>:</td>
                            <td><?= pendaftaran($r['tblizinpendaftaran_idonline']) ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td><?= status_pendaftaran($r['tblizinpendaftaran_issign']) ?></td>
                        </tr>

                        <tr>
                            <td>Tanggal Penetapan</td>
                            <td>:</td>
                            <td>
                                <?php if ($r['tgl_penetapan']) : ?>
                                <?= $r['tgl_penetapan'] ?>
                                <?php else : ?>
                                -
                                <?php endif ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Berlaku Sampai</td>
                            <td>:</td>
                            <td>

                                <?php if ($r['berlaku_sampai']) : ?>
                                <?= $r['berlaku_sampai'] ?>
                                <?php else : ?>
                                -
                                <?php endif ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Persyaratan</td>
                            <td>:</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-secondary"
                                    onclick="lihat_persyaratan('<?= $r['tblizinpendaftaran_id'] ?>')">Lihat</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Log</td>
                            <td>:</td>
                            <td>

                                <a href="#" class="btn btn-sm btn-outline-secondary"
                                    onclick="log('<?= $r['tblizinpendaftaran_id'] ?>')">Lihat</a>
                            </td>
                        </tr>
                        <tr>
                            <td>Dokumen Sebelum TTE</td>
                            <td>:</td>
                            <td>

                                <?php if ($r['sebelum_tte']) : ?>
                                <a href="<?= $r['sebelum_tte'] ?>" class="btn btn-sm btn-outline-secondary"
                                    target="_blank">Lihat</a>
                                <?php else : ?>
                                -
                                <?php endif ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Dokumen Sesudah TTE</td>
                            <td>:</td>
                            <td>

                                <?php if ($r['sesudah_tte']) : ?>
                                <a href="<?= $r['sesudah_tte'] ?>" class="btn btn-sm btn-outline-secondary"
                                    target="_blank">Lihat</a>
                                <?php else : ?>
                                -
                                <?php endif ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <?php endforeach ?>
    <!-- modal -->

</main>


<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<?= $this->include($url . '/arsip/js'); ?>
<?= $this->endSection('js'); ?>