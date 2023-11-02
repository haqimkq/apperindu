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

    <h6 class=" mb-0 text-uppercase">Form Tabel</h6>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <form action="" method="POST" autocomplete="off" class="form" enctype="multipart/form-data">

                <?= csrf_field() ?>
                <div class="card mb-5">

                    <div class="card-body">

                        <div class="row ">
                            <div class="col-md-4 md-4 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nama Tabel</label>
                                    <input type="text" class="form-control" name="nama_tabel" id="nama_tabel" required>
                                </div>
                            </div>
                        </div>

                        <div class="box-table">
                            <div class="row ">
                                <div class="col-md-4 md-4 mb-3">
                                    <div class="form-group">
                                        <label for="" class="mb-1">Nama kolom</label>
                                        <input type="text" class="form-control" name="nama_kolom[]" id="nama_kolom"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-3 md-4 mb-3">
                                    <div class="form-group">
                                        <label for="" class="mb-1">Tipe data</label>
                                        <select name="tipe_data[]" class="form-control" required>
                                            <option value="">pilih</option>
                                            <?php foreach (data_type_arr() as $key => $row) : ?>
                                            <option value="<?= $key ?>">
                                                <?= $row ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 md-4 mb-3">
                                    <div class="form-group">
                                        <label for="" class="mb-1">Panjang</label>
                                        <input type="number" class="form-control" name="panjang[]" max="225">
                                    </div>
                                </div>
                                <div class="col-md-2 md-4 mb-3">

                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-sm btn-outline-primary mt-4" id="add">
                            Tambah
                            Baris</button>

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

</main>


<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<?= $this->include($path . '/table/js'); ?>
<?= $this->endSection('js'); ?>