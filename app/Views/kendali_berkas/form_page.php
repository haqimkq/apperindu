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
            <a href="#" onclick="history.back()" class="btn btn-outline-primary">Kembali</a>


        </div>
    </div>
    <!--end breadcrumb-->

    <h6 class="mb-0 text-uppercase">Detail Pendaftaran</h6>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">

                <div class="card-body">

                    <?= $this->include('pendaftaran/detail'); ?>


                </div>


            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Form <?= $page ?></h6>
    <hr />
    <div class="row">
        <div class="col-md-6">
            <form action="<?= site_url($path . '/form') ?>" method="POST" autocomplete="off" class="form">
                <input type="hidden" name="tblizinpendaftaran_id" value="<?= $r['tblizinpendaftaran_id'] ?>">
                <input type="hidden" name="tblkendaliproses_tglmulai_sys" value="<?= $r['tblkendaliproses_tglterima'] ?>">
                <input type="hidden" name="tblkendaliproses_id" value="<?= $r['tblkendaliproses_id'] ?>">

                <?= csrf_field() ?>
                <div class="card mb-5">

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12 col-12 mb-4">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nama Proses</label>
                                    <select name="tblkendalibloksistemtugas_id" id="tblkendalibloksistemtugas_id" class="form-control" required>


                                        <?php foreach ($p as $row) : ?>
                                            <option value="<?= $row['tblkendalibloksistemtugas_id'] ?>">
                                                <?= $row['tblkendalibloksistemtugas_nama'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-12 mb-4">
                                <div class="form-group">
                                    <label for="" class="mb-1">Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="tblkendaliproses_tglmulai" value="<?= date('Y-m-d', strtotime($r['tblkendaliproses_tglterima'])) ?>" id="tblkendaliproses_tglmulai" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-12 mb-4">
                                <div class="form-group">
                                    <label for="" class="mb-1">Tanggal Selesai</label>
                                    <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tblkendaliproses_tglselesai" id="tblkendaliproses_tglselesai" required>
                                </div>
                            </div>
                            <div class="col-md-12 col-12 mb-4">
                                <div class="form-group">
                                    <label for="" class="mb-1">Catatan</label>
                                    <textarea name="tblkendaliproses_catatan" id="tblkendaliproses_catatan" rows="4" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 col-12 mb-4">
                                <div class="form-group">
                                    <label for="" class="mb-1">Kirim Berkas ke </label>
                                    <select name="tblkendalibloksistem_idkirim" id="tblkendalibloksistem_idkirim" class="form-control single-select" required>
                                        <option value="">Pilih</option>

                                        <?php foreach ($bs as $r) : ?>
                                            <option <?= selected($nb, $r['tblkendalibloksistem_id']) ?> value="<?= $r['tblkendalibloksistem_id'] ?>">
                                                <?= $r['tblkendalibloksistem_nama'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tblkendaliproses_isparaf" value="T" required>
                                    <label class="form-check-label" for="flexCheckDefault">Telah Diparaf</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tblkendaliproses_isberkasfisikdikirim" value="T" required>
                                    <label class="form-check-label" for="flexCheckDefault">Berkas Fisik Dikirim</label>
                                </div>
                            </div>

                            <div class="col-md-12 col-12 mb-4">
                                <div class="form-group">
                                    <label for="" class="mb-1">Berkas Fisik Dikirim Tanggal</label>
                                    <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tblkendaliproses_tglberkasfisikdikirim" id="tblkendaliproses_tglberkasfisikdikirim" required>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="float-start">
                            <a href="#" onclick="history.back()" class="btn btn-outline-danger">Batal</a>
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