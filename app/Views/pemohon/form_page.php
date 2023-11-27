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
        <div class="col-md-12">
            <form action="<?= site_url($path . '/form') ?>" method="POST" autocomplete="off" class="form">
                <input type="hidden" name="id" id="id" value="<?= $request->uri->getSegment(3) ?>">
                <?= csrf_field() ?>
                <div class="card mb-5">

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nama Pemohon</label>
                                    <input type="text" class="form-control" name="tblpemohon_nama" id="tblpemohon_nama"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Alamat</label>
                                    <textarea name="tblpemohon_alamat" id="tblpemohon_alamat" class="form-control"
                                        rows="2" required></textarea>
                                </div>
                            </div>


                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">KTP</label>
                                    <input type="number" class="form-control" name="tblpemohon_noidentitas"
                                        id="tblpemohon_noidentitas" required>
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nomor NPWP</label>
                                    <input type="number" class="form-control" name="tblpemohon_npwp"
                                        id="tblpemohon_npwp" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nomor Telepon</label>
                                    <input type="tel" class="form-control" name="tblpemohon_telpon"
                                        id="tblpemohon_telpon" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Email</label>
                                    <input type="email" class="form-control" name="tblpemohon_email"
                                        id="tblpemohon_email" required>
                                </div>
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