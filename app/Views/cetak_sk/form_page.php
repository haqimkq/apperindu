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
            <a href="<?= site_url($url) ?>" class="btn btn-outline-primary">Kembali</a>


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

                <div class="card-footer">


                    <div class="float-end">
                        <button class="btn btn-primary" onclick="update(<?= $request->uri->getSegment(3) ?>)">Edit Data
                            Primer</button>
                        <button class="btn btn-secondary"
                            onclick="lihat_persyaratan(<?= $request->uri->getSegment(3) ?>)">Lihat Persyaratan</button>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <h6 class="mb-0 text-uppercase">Form <?= $page ?></h6>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <form action="<?= site_url($path . '/form') ?>" method="POST" autocomplete="off" class="form">


                <input type="hidden" id="tblizinpendaftaran_id" name="tblizinpendaftaran_id"
                    value="<?= $request->uri->getSegment(3) ?>">
                <input type="hidden" name="table" id="table" value="<?= $table ?>">

                <?= csrf_field() ?>
                <div class="card mb-5">

                    <div class="card-body">
                        <div class="row">
                            <?php foreach ($field as $key =>  $r) : ?>
                            <?php if ($key > 1) : ?>




                            <div class="col-md-6 col-12 mb-4">
                                <div class="form-group">
                                    <label for=""
                                        class="mb-1"><?= strtoupper(str_replace("_", " ", $r->name)) ?></label>

                                    <?php if ($r->type_name == 'date') : ?>
                                    <!-- date -->
                                    <?php $tgl = date('Y-m-d'); ?>
                                    <?php if ($arr[$r->name] != '' && $arr[$r->name] != '0000-00-00') : ?>
                                    <?php $tgl = date('Y-m-d', strtotime($arr[$r->name])) ?>
                                    <?php endif ?>


                                    <input type="date" class="form-control" value="<?= $tgl ?>" name="<?= $r->name ?>"
                                        id="<?= $r->name ?>" required>
                                    <?php else : ?>

                                    <!-- text -->
                                    <!-- jika panjang < 80 -->
                                    <?php $length = $r->length / 3 ?>
                                    <?php if ($length <= 80) : ?>
                                    <input type="text" class="form-control " name="<?= $r->name ?>"
                                        value="<?= $arr[$r->name] ?>" id="<?= $r->name ?>" max="<?= $length ?>"
                                        required>
                                    <!-- jika panjang > 80 -->
                                    <?php else : ?>
                                    <textarea name="<?= $r->name ?>" id="<?= $r->name ?>" rows="2" class="form-control"
                                        required><?= $arr[$r->name] ?></textarea>
                                    <?php endif ?>



                                    <!-- jika no izin/sk -->

                                    <?php if ($r->name == 'no_izin' && $arr[$r->name] == '') : ?>
                                    <em>No. izin terakhir berdasarkan tgl penetapan : <?= $sk_terakhir ?></em>
                                    <?php endif ?>
                                    <?php endif ?>
                                </div>
                            </div>





                            <?php endif ?>

                            <?php endforeach ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="download" id="download"
                                        value="T">
                                    <label class="form-check-label" for="flexCheckDefault">Download File</label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="float-start">
                            <a href="<?= site_url($url) ?>" class="btn btn-outline-danger">Batal</a>
                        </div>
                        <div class="float-end">

                            <button class="btn btn-primary simpan">Simpan</button>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="form-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= site_url('pendaftaran/update_primary') ?>" method="POST" autocomplete="off">
                    <?php $url = $request->uri->getSegment(1) . '/' . $request->uri->getSegment(2) . '/' . $request->uri->getSegment(3) ?>
                    <input type="hidden" name="url" value="<?= $url ?>">
                    <input type="hidden" name="id" id="id-update">
                    <?= csrf_field() ?>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Primer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nama Pemohon</label>
                                    <input type="text" class="form-control" name="tblizinpendaftaran_namapemohon"
                                        id="tblizinpendaftaran_namapemohon" required>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Alamat Pemohon</label>
                                    <input type="text" class="form-control" name="tblizinpendaftaran_almtpemohon"
                                        id="tblizinpendaftaran_almtpemohon" required>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Nama Usaha</label>
                                    <input type="text" class="form-control" name="tblizinpendaftaran_usaha"
                                        id="tblizinpendaftaran_usaha" required>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-group">
                                    <label for="" class="mb-1">Alamat / Lokasi Usaha</label>
                                    <input type="text" class="form-control" name="tblizinpendaftaran_lokasiizin"
                                        id="tblizinpendaftaran_lokasiizin" required>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>


<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<?= $this->include($path . '/js'); ?>
<?= $this->endSection('js'); ?>