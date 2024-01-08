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


        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Filter</h6>
    <hr />
    <form action="<?= site_url('rekap/export') ?>" method="POST">
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
                            <select name="tblizinpermohonan_id" id="id_permohonan" class="form-control filter-select"
                                required>
                                <option value="">Pilih</option>

                            </select>
                        </div>

                    </div>

                </div>


                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="" class="mb-1">Dari tanggal</label>
                            <input type="date" name="dari" id="dari" value="<?= date('Y-m-d') ?>"
                                class="form-control filter-date">
                        </div>

                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="" class="mb-1">Sampai tanggal</label>
                            <input type="date" name="sampai" id="sampai" value="<?= date('Y-m-d') ?>"
                                class="form-control filter-date">
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
    <h6 class="mb-0 text-uppercase">Tabel Data <?= $page ?></h6>
    <hr />
    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>

                                    <th>Opsi</th>
                                    <!-- <th>Status</th> -->
                                    <th>Nomor Daftar</th>
                                    <th>Nama Izin</th>
                                    <th>Nama Permohonan</th>
                                    <th>Nama Pemohon</th>
                                    <th>Nama Usaha</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Kecamatan</th>
                                    <th>Kelurahan</th>



                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>

                </div>

            </div>

        </div>
    </div>
</main>


<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<?= $this->include($url . '/js'); ?>
<?= $this->endSection('js'); ?>