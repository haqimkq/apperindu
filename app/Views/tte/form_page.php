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
                <div class="card-footer">
                    <div class="float-end">
                        <button class="btn btn-secondary"
                            onclick="lihat_persyaratan(<?= $request->uri->getSegment(3) ?>)">Lihat Persyaratan</button>
                    </div>


                </div>

            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Form <?= $page ?></h6>
    <hr />
    <!-- <div class="row">
        <div class="col-md-12">
            <form action="<?= site_url($path . '/form') ?>" method="POST" autocomplete="off" class="form">
                <embed src="data:application/pdf;base64,<?= $base64 ?>" type="application/pdf" width="100%" height="600px" />
            </form>
        </div>
    </div> -->
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <embed src="data:application/pdf;base64,<?= $base64 ?>" type="application/pdf" width="100%"
                        height="600px" />

                </div>
            </div>

        </div>
        <div class="col-md-8">
            <form action="" method="POST" class="form" autocomplete="off">
                <input type="hidden" name="tblizinpendaftaran_id" id="tblizinpendaftaran_id"
                    value="<?= $request->uri->getSegment(3) ?>">

                <?= csrf_field() ?>
                <div class="card mb-5">

                    <div class="card-body">

                        <div class="row">


                            <div class="col-md-6 col-12 mb-4">
                                <div class="form-group">
                                    <label for="">Masukkan Passphrase</label>
                                    <input type="password" class="form-control" name="passphrase" id="passphrase"
                                        required>

                                </div>

                            </div>

                        </div>


                    </div>

                    <div class="card-footer">
                        <div class="float-start">
                            <a href="#" onclick="history.back()" class="btn btn-outline-danger"> Batal</a>
                        </div>
                        <div class="float-end">
                            <button class="btn btn-primary simpan"><i class="bi bi-pencil-square"></i> Tanda
                                Tangani</button>
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