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
    <h6 class="mb-0 text-uppercase">Filter</h6>
    <hr />
    <div class="card mb-5">
        <div class="card-body">
            <form action="">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="mb-1">Nama Kecamatan</label>
                            <select name="id_kecamatan" id="id_kecamatan" class="form-control filter-select">
                                <option value="">Pilih</option>
                                <?php foreach ($kecamatan as $r) : ?>
                                    <option value="<?= $r['tblkecamatan_id'] ?>"><?= $r['tblkecamatan_nama'] ?></option>
                                <?php endforeach ?>
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
    <h6 class="mb-0 text-uppercase">Tabel Data <?= $page ?></h6>
    <hr />
    <div class="card">
        <div class="card-body">
            <form action="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="5%">No.</th>

                                        <th width="20%">Opsi</th>
                                        <th>Nama Kecamatan</th>
                                        <th>Nama Kelurahan</th>

                                    </tr>
                                </thead>


                            </table>
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