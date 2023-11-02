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




                            <div class="col-md-6 col-12 mb-4 px-4">
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
                        <!-- <div class="float-start">
                            <a href="<?= site_url($url) ?>" class="btn btn-outline-danger">Batal</a>
                        </div> -->
                        <div class="float-end">

                            <button class="btn btn-primary simpan"><i class="fadeIn animated bx bx-file"></i> Cetak
                                Rekomendasi</button>
                        </div>

                    </div>

                </div>
            </form>
        </div>
    </div>


    <hr />
    <div class="row review-card hide">

        <div class="col-md-12">
            <form action="" method="POST" class="form-tte" autocomplete="off">
                <input type="hidden" name="tblizinpendaftaran_id" id="tblizinpendaftaran_id"
                    value="<?= $request->uri->getSegment(3) ?>">

                <?= csrf_field() ?>
                <div class="card mb-5">

                    <div class="card-body">
                        <div id="review" class="px-4 py-4"></div>
                        <div class="row">


                            <div class="col-md-4 col-12 mb-4">
                                <div class="form-group">
                                    <label for="">Masukkan Passphrase</label>
                                    <input type="password" class="form-control" name="passphrase" id="passphrase"
                                        required>

                                </div>

                            </div>

                        </div>


                    </div>

                    <div class="card-footer">
                        <!-- <div class="float-start">
                            <a href="#" onclick="history.back()" class="btn btn-outline-danger"> Batal</a>
                        </div> -->
                        <div class="float-end">
                            <button class="btn btn-primary tte"><i class="bi bi-pencil-square"></i> Tanda
                                Tangani</button>
                        </div>

                    </div>
            </form>
        </div>
    </div>



</main>


<?= $this->endSection('content'); ?>

<?= $this->section('js'); ?>
<?= $this->include($path . '/js'); ?>
<?= $this->endSection('js'); ?>