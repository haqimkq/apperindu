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
            <form action="" method="POST" autocomplete="off" class="form-update" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= $request->uri->getSegment(3) ?>">
                <input type="hidden" name="tblizinpermohonan_id_" id="tblizinpermohonan_id_">
                <?= csrf_field() ?>
                <div class="card mb-5">

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 col-12 mb-4">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nama Izin</label>
                                    <select name="tblizin_id" id="tblizin_id" class="form-control single-select" required>
                                        <option value="">Pilih</option>
                                        <?php foreach ($izin as $r) : ?>
                                            <option value="<?= $r['tblizin_id'] ?>"><?= $r['tblizin_nama'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12  mb-4">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nama Permohonan</label>
                                    <select name="tblizinpermohonan_id" id="tblizinpermohonan_id" class="form-control single-select" required>
                                        <option value="">Pilih</option>
                                        <?php foreach ($permohonan as $r) : ?>
                                            <option value="<?= $r['tblizinpermohonan_id'] ?>">
                                                <?= $r['tblizinpermohonan_nama'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>

                            </div>


                            <div class="col-md-6 col-12 mb-4">
                                <div class="form-group">
                                    <label for="" class="mb-1">Template (dengan format word rtf)</label>
                                    <input type="file" class="form-control" name="tblskizin_sktemplate" id="tblskizin_sktemplate">
                                    <input type="hidden" name="tblskizin_sktemplate_old" id="tblskizin_sktemplate_old">
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-4">
                                <div class="form-group">
                                    <label for="" class="mb-1">Tabel SK (jika tidak ada tambahkan <a href="">disini</a>
                                        ,kemudian refresh halaman ini)</label>
                                    <select name="tblskizin_tabelvariabel_id" id="tblskizin_tabelvariabel_id" class="form-control single-select" required>
                                        <option value="">Pilih</option>
                                        <?php foreach ($variabel as $r) : ?>
                                            <option value="<?= $r['tblskizin_tabelvariabel_id'] ?>">
                                                <?= $r['tblskizin_tabelsk'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
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