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
            <!-- <a class="btn btn-primary" href="<?= site_url($url . '/form_page') ?>">Tambah</a> -->
            <!-- <button class="btn btn-primary" onclick="tambah()">Tambah</button> -->
            <!-- <div class="btn-group">
                <button type="button" class="btn btn-outline-primary">Export</button>
                <button type="button"
                    class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
                    <a class="dropdown-item" href="javascript:;">PDF</a>
                    <a class="dropdown-item" href="javascript:;">Exel</a>
                 
                </div>
            </div>
            <button class="btn btn-outline-primary">Import</button> -->

        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Filter</h6>
    <hr />
    <form action="<?= site_url('rekap_rekomendasi/export') ?>" method="POST">
        <div class="card mb-5">

            <div class="card-body">

                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="" class="mb-1">Nama Izin</label>
                            <select name="tblizin_id" id="id_izin" class="form-control filter-select" required>
                                <option value="">Pilih</option>
                                <?php foreach ($izin as $r) : ?>
                                    <option value="<?= $r['tblizin_id'] ?>"><?= $r['tblizin_nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="" class="mb-1">Nama Permohonan</label>
                            <select name="tblizinpermohonan_id" id="id_permohonan" class="form-control filter-select" required>
                                <option value="">Pilih</option>

                            </select>
                        </div>

                    </div>

                </div>


                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="" class="mb-1">Dari tanggal</label>
                            <input type="date" name="dari" id="dari" value="<?= date('Y-m-d') ?>" class="form-control filter-date">
                        </div>

                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="" class="mb-1">Sampai tanggal</label>
                            <input type="date" name="sampai" id="sampai" value="<?= date('Y-m-d') ?>" class="form-control filter-date">
                        </div>

                    </div>

                </div>



            </div>
            <div class="card-footer">
                <div class="float-end">
                    <button class="btn btn-primary" type="submit">Export Excel</button>
                    <button class="btn btn-outline-primary" type="button" onclick="reset_filter()">Reset</button>
                </div>

            </div>

        </div>

    </form>


</main>


<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<?= $this->include($url . '/js'); ?>
<?= $this->endSection('js'); ?>