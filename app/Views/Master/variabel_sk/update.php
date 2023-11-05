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

    <h6 class=" mb-0 text-uppercase">Form Tabel <?= $table ?></h6>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <form action="" method="POST" autocomplete="off" class="form" enctype="multipart/form-data">

                <?= csrf_field() ?>
                <div class="card mb-5">

                    <div class="card-body">


                        <table class="table  table-bordered">
                            <tr>
                                <th>Nama kolom</th>
                                <th>Tipe data</th>
                                <th>Panjang</th>
                            </tr>
                            <?php foreach ($field as $key => $r) : ?>
                            <?php if ($key > 1) : ?>
                            <tr>
                                <td>
                                    <input type="hidden" name="<?= $r->name ?>" name="kolomlama[]"
                                        value="<?= $r->name ?>">
                                    <input type="text" class="form-control kolom_<?= $r->name ?>" name="kolombaru[]"
                                        value="<?= $r->name ?>">

                                </td>
                                <td>

                                    <select name="tipe_data" class="form-control">
                                        <option value="">pilih</option>
                                        <?php foreach (data_type_arr() as $key => $row) : ?>
                                        <option <?= selected(data_type($r->type_name), $row) ?> value="<?= $key ?>">
                                            <?= $row ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </td>
                                <td><input type="text" class="form-control" name="panjang[]" value="<?= $r->length ?>">
                                </td>
                            </tr>
                            <?php endif ?>
                            <?php endforeach ?>
                        </table>


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