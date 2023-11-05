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
            <a class="btn btn-primary" href="<?= site_url($url . '/form_page') ?>">Tambah</a>


        </div>
    </div>
    <h6 class="mb-0 text-uppercase">Filter</h6>
    <hr />
    <div class="card mb-5">
        <div class="card-body">
            <form action="">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="" class="mb-1">Jenis</label>
                            <select name="tblskizin_tabelvariabel_isrekom" id="tblskizin_tabelvariabel_isrekom"
                                class="form-control filter-select">
                                <option value="">Pilih</option>
                                <option value="F">Surat Keterangan</option>
                                <option value="T">Rekomendasi</option>
                            </select>
                        </div>

                    </div>


                </div>


            </form>


        </div>
        <div class="card-footer">
            <div class="float-end">
                <button class="btn btn-outline-primary" onclick="reset_filter()">Reset</button>
            </div>

        </div>
    </div>
    <h6 class="mb-0 text-uppercase">Data <?= $page ?></h6>
    <hr />
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="10">No.</th>
                                                <th width="30">Opsi</th>
                                                <th>Nama Tabel</th>
                                                <th>Jenis</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>

                                    </table>
                                </div>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <?= $this->include($path . '/form'); ?>
</main>


<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<?= $this->include($path . '/js'); ?>
<?= $this->endSection('js'); ?>