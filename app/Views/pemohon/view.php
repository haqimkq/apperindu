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
    <!--end breadcrumb-->

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
                                    <th>Nama Pemohon</th>
                                    <th>Alamat Pemohon</th>

                                    <th>NIK</th>
                                    <th>NPWP</th>
                                    <th>No. Telepon</th>

                                    <th>Email</th>
                                    <th>Pendaftaran</th>
                                </tr>
                            </thead>
                            <tbody></tbody>

                        </table>
                    </div>

                </div>

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