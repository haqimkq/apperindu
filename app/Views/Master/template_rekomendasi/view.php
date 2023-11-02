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
                <button type="button"
                    class="btn btn-outline-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
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
                            <label for="" class="mb-1">Nama Izin</label>
                            <select name="id_izin" id="a" class="form-control filter-select">
                                <option value="">Pilih</option>
                                <option value="">A</option>
                                <option value="">B</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="" class="mb-1">Nama Permohonan</label>
                            <select name="id_izin" id="b" class="form-control filter-select">
                                <option value="">Pilih</option>
                                <option value="">A</option>
                                <option value="">B</option>
                            </select>
                        </div>

                    </div>

                </div>


            </form>


        </div>
        <div class="card-footer">
            <div class="float-end">
                <button class="btn btn-outline-primary">Reset</button>
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
                                        <th>No.</th>
                                        <th>
                                            <input type="checkbox">
                                        </th>
                                        <th>Opsi</th>
                                        <th>Nama Izin</th>
                                        <th>Nama Permohonan</th>



                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td><input type="checkbox"></td>
                                        <td>

                                            <div class="btn-group">
                                                <button type="submit"
                                                    class="btn  btn-sm btn-outline-primary">Hapus</button>
                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-primary">Edit</button>
                                            </div>
                                        </td>
                                        <td>Izin Usaha Pertambangan Batuan</td>
                                        <td> Izin Usaha Pertambangan (IUP) Eksplorasi Batuan</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                    </div>
                    <div class="col-md-4 mt-5">
                        <div class="form-group">
                            <label class="form-label">Opsi Sekaligus</label>
                            <select name="opsi" id="opsi" class="form-control">
                                <option value="">Pilih</option>
                                <option value="">Aktifkan</option>
                                <option value="">Non Aktifkan</option>
                                <option value="">Hapus</option>
                            </select>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- modal -->
    <?= $this->include($url . '/form'); ?>
</main>


<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<?= $this->include($url . '/js'); ?>
<?= $this->endSection('js'); ?>