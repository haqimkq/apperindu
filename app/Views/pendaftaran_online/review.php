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
            <a href="#" onclick="history.back()" class="btn btn-outline-primary">Kembali</a>


        </div>
    </div>
    <!--end breadcrumb-->

    <h6 class="mb-0 text-uppercase">Detail Pendaftaran</h6>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">

                <div class="card-body">

                    <?= $this->include('pendaftaran/detail'); ?>


                </div>


            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Persyaratan</h6>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Persyaratan</th>
                                        <th>File</th>
                                    </tr>
                                    <?php $no = 1 ?>
                                    <?php foreach ($persyaratan as $p) : ?>
                                    <tr>
                                        <td><?= $no ?>.</td>
                                        <td>
                                            <div class="text-wrap"><?= $p['tblpersyaratan_nama'] ?></div>
                                        </td>
                                        <td>
                                            <?php if ($p['file']) : ?>
                                            <button type="button"
                                                onclick="review('<?= base_url('doc/persyaratan/' . $p['file']) ?>')"
                                                class="btn btn-block btn-outline-secondary btn-sm review  mb-2"><i
                                                    class="fadeIn animated bx bx-file"></i>
                                                Lihat file</button>
                                            <?php else : ?>
                                            Tidak ada
                                            <?php endif ?>

                                        </td>
                                    </tr>
                                    <?php $no++ ?>
                                    <?php endforeach ?>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>


                <div class="card-footer">
                    <!-- <div class="float-start">
                        <a href="#" onclick="history.back()" class="btn btn-outline-danger"> Kembali</a>
                    </div> -->
                    <div class="float-end">
                        <button class="btn btn-danger" onclick="tolak(<?= $r['tblizinpendaftaran_id'] ?>)"><i
                                class="bi bi-x"></i> Tolak</button>
                        <button class="btn btn-primary" onclick="terima(<?= $r['tblizinpendaftaran_id'] ?>)"><i
                                class=" bi bi-check"></i> Terima</button>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <?= $this->include($path . '/form'); ?>
</main>


<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<?= $this->include($path . '/js'); ?>
<?= $this->endSection('js'); ?>