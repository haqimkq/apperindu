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
            <button class="btn btn-primary" onclick="tambah()">Tambah</button>
            <div class="btn-group">
                <button type="button" class="btn btn-outline-primary">Export</button>
                <button type="button" class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item" href="javascript:;">PDF</a>
                    <a class="dropdown-item" href="javascript:;">Exel</a>
                    <!-- <a class="dropdown-item" href="javascript:;">Something else here</a> -->
                    <!-- <div class="dropdown-divider"></div> <a class="dropdown-item" href="javascript:;">Separated link</a> -->
                </div>
            </div>
            <button class="btn btn-outline-primary">Import</button>

        </div>
    </div>
    <!--end breadcrumb-->

    <h6 class="mb-0 text-uppercase">Tabel Data <?= $page ?></h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <form action="<?= $path, '/form_bulk' ?>" class="form-bulk" method="POST">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>
                                            <input type="checkbox" id="bulk">
                                        </th>
                                        <th>Opsi</th>

                                        <th>Nama Persyaratan</th>


                                    </tr>
                                </thead>
                                <tbody></tbody>

                            </table>
                        </div>

                    </div>
                    <div class="col-md-4 mt-5">
                        <div class="form-group">
                            <label class="form-label">Opsi Sekaligus</label>
                            <select name="bulk_opsi" id="bulk_opsi" class="form-control">
                                <option value="0">Pilih</option>

                                <option value="3">Hapus</option>
                            </select>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- modal -->
    <?= $this->include($path . '/form'); ?>
</main>


<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<?= $this->include($path . '/js'); ?>
<?= $this->endSection('js'); ?>