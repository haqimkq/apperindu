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
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">Filter</h6>
    <hr />
    <div class="card mb-5">
        <div class="card-body">
            <form action="">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="" class="mb-1">Nama Izin</label>
                            <select name="id_izin" id="id_izin" class="form-control filter-select">
                                <option value="">Pilih</option>
                                <?php foreach ($izin as $r) : ?>
                                <option value="<?= $r['tblizin_id'] ?>"><?= $r['tblizin_nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="form-group">
                            <label for="" class="mb-1">Nama Permohonan</label>
                            <select name="id_permohonan" id="id_permohonan" class="form-control filter-select">
                                <option value="">Pilih</option>
                                <?php foreach ($permohonan as $r) : ?>
                                <option value="<?= $r['tblizinpermohonan_id'] ?>"><?= $r['tblizinpermohonan_nama'] ?>
                                </option>
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

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-pendaftaran table-striped table-bordered table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>

                                    <th>Opsi</th>
                                    <th>Nomor Daftar</th>
                                    <th>Nama Izin</th>
                                    <th>Nama Permohonan</th>
                                    <th>Nama Pemohon</th>
                                    <th>Nama Usaha</th>
                                    <th>Pendaftaran</th>
                                    <th>Status</th>
                                    <th>Waktu Daftar</th>


                                </tr>
                            </thead>
                            <tbody></tbody>

                        </table>
                    </div>

                </div>
                <!-- <div class="col-md-4 mt-5">
                    <div class="form-group">
                        <label class="form-label">Opsi Sekaligus</label>
                        <select name="bulk_opsi" id="bulk_opsi" class="form-control">
                            <option value="0">Pilih</option>
                            <option value="1">Aktifkan</option>
                            <option value="2">Non Aktifkan</option>
                            <option value="3">Hapus</option>
                        </select>
                    </div>

                </div> -->
            </div>

        </div>
    </div>
    <!-- modal -->
    <?= $this->include($path . '/form'); ?>
</main>


<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<?= $this->include($url . '/js'); ?>
<?= $this->endSection('js'); ?>