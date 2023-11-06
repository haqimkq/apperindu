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
                                        <th>Permohonan Terkait</th>
                                        <th>Nama Izin</th>
                                        <th>Status Aktif</th>

                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <!-- <tbody>
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
                                        <td><a href="">Lihat (1)</a></td>
                                        <td>Bukti Pencatatan Kapal Perikanan (BPKP)</td>
                                        <td> <span class="badge bg-primary">Aktif</span></td>
                                    </tr>
                                </tbody> -->

                            </table>
                        </div>

                    </div>
                    <div class="col-md-4 mt-5">
                        <div class="form-group">
                            <label class="form-label">Opsi Sekaligus</label>
                            <select name="bulk_opsi" id="bulk_opsi" class="form-control">
                                <option value="0">Pilih</option>
                                <option value="1">Aktifkan</option>
                                <option value="2">Non Aktifkan</option>
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