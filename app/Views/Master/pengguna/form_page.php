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

    <h6 class=" mb-0 text-uppercase">Form <?= $page ?></h6>
    <hr />
    <div class="row">
        <div class="col-md-6">
            <form action="" method="POST" class="form" autocomplete="off">

                <?= csrf_field() ?>
                <div class="card mb-5">

                    <div class="card-body">

                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nama</label>
                                    <input type="text" class="form-control" name="tblpengguna_nama"
                                        id="tblpengguna_nama" required>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Unit Kerja</label>
                                    <input type="text" class="form-control" name="tblpengguna_unitkerja"
                                        id="tblpengguna_unitkerja">
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Blok Sistem</label>
                                    <select name="tblkendalibloksistem_id" id="tblkendalibloksistem_id"
                                        class="form-control single-select" required>
                                        <option value="">Pilih</option>
                                        <?php foreach ($blok_sistem as $r) : ?>
                                        <option value="<?= $r['tblkendalibloksistem_id'] ?>">
                                            <?= $r['tblkendalibloksistem_nama'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Status Aktif</label>
                                    <select name="tblpengguna_isaktif" id="tblpengguna_isaktif" class="form-control"
                                        required>
                                        <?php foreach (status_aktif_ar() as $r) : ?>
                                        <option value="<?= $r['val'] ?>"><?= $r['cap'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" required>
                                </div>
                                <p class="hide username_validation text-danger">Username sudah terdaftar</p>
                            </div>

                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Password</label>
                                    <input type="password" class="form-control" name="tblpengguna_password"
                                        id="tblpengguna_password" required>

                                </div>
                                <p class="hide tblpengguna_password_validation text-danger">Password minimal
                                    8 karakter,
                                    paling tidak meliputi 1 huruf kapital, 1 angka dan 1 simbol</p>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Konfirmasi Password</label>
                                    <input type="password" class="form-control" name="pwconfirm" id="pwconfirm"
                                        required>
                                </div>
                                <p class="hide pwconfirm_validation text-danger">Konfirmasi password harus
                                    sama</p>
                            </div>


                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="float-start">
                            <a href="<?= site_url($url) ?>" class="btn btn-outline-danger">Batal</a>
                        </div>
                        <div class="float-end">
                            <button class="btn btn-primary">Simpan</button>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>

</main>


<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<?= $this->include($path . '/js'); ?>
<?= $this->endSection('js'); ?>