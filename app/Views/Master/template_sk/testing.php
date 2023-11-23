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

    </div>
    <!--end breadcrumb-->


    <hr />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <p><?= $r['tblizin_nama'] ?> > <?= $r['tblizinpermohonan_nama'] ?></p>
                            <p>Fitur ini hanya untuk uji coba template, data dan qr code yang digunakan bersifat uji
                                coba
                            </p>
                        </div>
                        <div class="col-md-12">
                            <embed src="data:application/pdf;base64,<?= $base64 ?>" type="application/pdf" width="100%" height="600px" />
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="col-md-8">
            <form action="<?= site_url($path . '/update_template') ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= $request->uri->getSegment(3) ?>">

                <?= csrf_field() ?>
                <div class="card mb-5">

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <p> Template yang berjalan
                                    saat
                                    ini dapat dilihat <a href="<?= site_url('doc/template/' . $template) ?>"> disini
                                    </a></p>
                            </div>
                            <div class="col-md-12">
                                <p>Anda juga dapat mengubah templatenya </p>
                            </div>
                            <div class="col-md-6 col-12 mb-4">
                                <div class="form-group">
                                    <label for="" class="mb-1">Template baru (dengan format rtf) </label>
                                    <input type="file" class="form-control" name="tblskizin_sktemplate" id="tblskizin_sktemplate">
                                    <input type="hidden" value="<?= $template ?>" name="tblskizin_sktemplate_old" id="tblskizin_sktemplate_old">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="float-start">
                            <a href="<?= site_url($url) ?>" class="btn btn-outline-danger">Batal</a>
                        </div>
                        <div class="float-end">
                            <button class="btn btn-primary">Ubah</button>
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