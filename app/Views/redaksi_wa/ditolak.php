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

    </div>
    <!--end breadcrumb-->



    <h6 class="mb-0 text-uppercase">Form <?= $page ?></h6>
    <hr />

    <div class="row">


        <div class="col-md-6">


            <form action="" method="POST" class="form" autocomplete="off">
                <input type="hidden" name="id" value="<?= $r['id'] ?>">
                <div class="card mb-5">

                    <?= csrf_field() ?>
                    <div class="card-body">

                        <div class="row">


                            <div class="col-md-12 col-12 mb-4">
                                <div class="form-group">
                                    <label for="">Redaksi</label>

                                    <textarea name="redaksi_ditolak" id="redaksi_ditolak" class="form-control" cols="30" rows="10" required><?= $r['redaksi_ditolak'] ?></textarea>

                                </div>

                            </div>



                            <div class="col-md-12 col-12 mb-4">
                                <div class="form-group">
                                    <label for="">Nomor WA (untuk testing)</label>
                                    <input type="text" class="form-control" name="wa_testing" id="wa_testing" value="<?= $r['wa_testing'] ?>" required>

                                </div>

                            </div>

                        </div>


                    </div>

                    <div class="card-footer">
                        <div class="float-start">
                            <a href="#" onclick="history.back()" class="btn btn-outline-danger"> Batal</a>
                        </div>
                        <div class="float-end">
                            <button type="button" class="btn btn-outline-primary testing"> Testing</button>
                            <button class="btn btn-primary simpan"> Simpan</button>
                        </div>

                    </div>

                </div>

            </form>

        </div>

        <div class="col-md-6">



            <div class="card mb-5">
                <div class="card-header">
                    Variabel yang bisa digunakan
                </div>
                <div class="card-body">

                    <div class="row">


                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="10">No.</th>
                                            <th>Nama kolom</th>
                                            <th>Tipe data</th>
                                            <th>Panjang</th>


                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>tgl_permohonan</td>
                                            <td>tanggal</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>nama_pemohon</td>
                                            <td>text</td>
                                            <td>225</td>
                                        </tr>

                                        <tr>
                                            <td>3.</td>
                                            <td>alamat_pemohon</td>
                                            <td>text</td>
                                            <td>225</td>
                                        </tr>

                                        <tr>
                                            <td>4.</td>
                                            <td>nama_usaha</td>
                                            <td>text</td>
                                            <td>225</td>
                                        </tr>

                                        <tr>
                                            <td>5.</td>
                                            <td>alamat_usaha</td>
                                            <td>text</td>
                                            <td>225</td>
                                        </tr>
                                        <tr>
                                            <td>6.</td>
                                            <td>nik</td>
                                            <td>text</td>
                                            <td>16</td>
                                        </tr>
                                        <tr>
                                            <td>7.</td>
                                            <td>npwp</td>
                                            <td>text</td>
                                            <td>15</td>
                                        </tr>
                                        <tr>
                                            <td>8.</td>
                                            <td>no_pendaftaran</td>
                                            <td>text</td>
                                            <td>225</td>
                                        </tr>
                                        <tr>
                                            <td>9.</td>
                                            <td>alasan</td>
                                            <td>text</td>
                                            <td>15</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

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