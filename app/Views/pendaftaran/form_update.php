<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<main class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><?= $page ?></div>
        <div class="ps-3 ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page"><a href="/dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Form <?= $page ?></li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="<?= site_url($url) ?>" class="btn btn-outline-primary">Kembali</a>


        </div>
    </div>
    <!--end breadcrumb-->

    <h6 class="mb-0 text-uppercase">Form <?= $page ?></h6>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <form action="" method="POST" autocomplete="off" class="form-update" enctype="multipart/form-data">
                <input type="hidden" name="tblpemohon_id" id="tblpemohon_id">
                <input type="hidden" name="tblizinpendaftaran_id" id="tblizinpendaftaran_id"
                    value="<?= isset($id) ? $id : '' ?>">
                <?= csrf_field() ?>
                <div class="card mb-5">

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nomor Identitas</label>
                                    <input type="number" class="form-control" name="tblizinpendaftaran_idpemohon"
                                        id="tblizinpendaftaran_idpemohon" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nama Pemohon</label>
                                    <input type="text" class="form-control" name="tblizinpendaftaran_namapemohon"
                                        id="tblizinpendaftaran_namapemohon" required>
                                </div>
                            </div>


                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Alamat</label>
                                    <textarea name="tblizinpendaftaran_almtpemohon" id="tblizinpendaftaran_almtpemohon"
                                        class="form-control" rows="2" required></textarea>
                                </div>
                            </div>



                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nomor NPWP</label>
                                    <input type="text" class="form-control" name="tblizinpendaftaran_npwp"
                                        id="tblizinpendaftaran_npwp" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nomor Telepon</label>
                                    <input type="tel" class="form-control" name="tblizinpendaftaran_telponpemohon"
                                        id="tblizinpendaftaran_telponpemohon" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nama Izin</label>
                                    <select name="tblizin_id" id="tblizin_id" class="form-control single-select"
                                        required>
                                        <option value="">Pilih</option>
                                        <?php foreach ($izin as $r) : ?>
                                        <option value="<?= $r['tblizin_id'] ?>"><?= $r['tblizin_nama'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nama Permohonan</label>
                                    <select name="tblizinpermohonan_id" id="tblizinpermohonan_id"
                                        class="form-control single-select" required>
                                        <option value="">Pilih</option>

                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nama Usaha</label>
                                    <input type="text" class="form-control" name="tblizinpendaftaran_usaha"
                                        id="tblizinpendaftaran_usaha" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Lokasi Usaha / Bangunan</label>
                                    <input type="text" class="form-control" name="tblizinpendaftaran_lokasiizin"
                                        id="tblizinpendaftaran_lokasiizin" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nama Kecamatan</label>
                                    <select name="tblkecamatan_id" id="tblkecamatan_id"
                                        class="form-control single-select" required>
                                        <option value=""></option>
                                        <?php foreach ($kecamatan as $r) : ?>
                                        <option value="<?= $r['tblkecamatan_id'] ?>"><?= $r['tblkecamatan_nama'] ?>
                                        </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nama Kelurahan / Desa</label>
                                    <select name="tblkelurahan_id" id="tblkelurahan_id"
                                        class="form-control single-select" required>
                                        <option value=""></option>

                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Keterangan</label>
                                    <textarea name="tblizinpendaftaran_keterangan" id="tblizinpendaftaran_keterangan"
                                        class="form-control" rows="2" required></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row persyaratan">

                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="float-start">
                            <a href="<?= site_url($url) ?>" class="btn btn-outline-danger">Batal</a>
                        </div>
                        <div class="float-end">
                            <button class="btn btn-primary simpan">Simpan</button>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>
    <?= $this->include($path . '/form'); ?>
</main>


<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<?= $this->include($path . '/js'); ?>
<?= $this->endSection('js'); ?>