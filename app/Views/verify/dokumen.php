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



        </div>
    </div>
    <!--end breadcrumb-->

    <h6 class=" mb-0 text-uppercase">Form <?= $page ?></h6>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <form action="" method="POST" autocomplete="off" class="form" enctype="multipart/form-data">

                <?= csrf_field() ?>
                <div class="card mb-5">

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Upload Dokumen</label>
                                    <input type="file" class="form-control" name="file" id="file" required>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer">

                        <div class="float-end">
                            <button class="btn btn-primary verifikasi">Verifikasi</button>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>


    <div class="detail">
        <h6 class=" mb-0 text-uppercase">Detail Dokumen</h6>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-5">

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <b>Informasi Izin</b>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12"><b>Nomor Pendaftaran</b></div>
                                    <div class="col-md-12 tblizinpendaftaran_nomor">-</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12"><b>Nomor Izin</b></div>
                                    <div class="col-md-12 no_izin">-</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12"><b>Nama Pemohon</b></div>
                                    <div class="col-md-12 tblizinpendaftaran_namapemohon">-</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12"><b>Nama Izin</b></div>
                                    <div class="col-md-12 tblizin_nama">-</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12"><b>Nama Permohonan</b></div>
                                    <div class="col-md-12 tblizinpermohonan_nama">
                                        -
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <b>Informasi Dokumen</b>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12"><b>Tanggal Verifikasi</b></div>
                                    <div class="col-md-12 tgl_verifikasi">-</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12"><b>Tanggal Penandatanganan</b></div>
                                    <div class="col-md-12 tgl_penandatanganan">-</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12"><b>Alasan</b></div>
                                    <div class="col-md-12 alasan">-</div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12"><b>Penandatangan</b></div>
                                    <div class="col-md-12 penandatangan">-</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12"><b>Dokumen</b></div>
                                    <div class="col-md-12 dokumen">-</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12"><b>Summary</b></div>
                                    <div class="col-md-12 summary">-</div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</main>


<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<?= $this->include($path . '/js'); ?>
<?= $this->endSection('js'); ?>