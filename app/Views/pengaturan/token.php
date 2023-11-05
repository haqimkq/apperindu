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


        <div class="col-md-9">
            <form action="" method="POST" class="form-token" autocomplete="off">

                <input type="hidden" name="id" value="<?= $r['id'] ?>">
                <?= csrf_field() ?>
                <div class="card mb-5">

                    <div class="card-body">

                        <div class="row">


                            <div class="col-md-12 col-12 mb-4">
                                <div class="form-group">
                                    <label for="">Token TTE</label>
                                    <input type="text" class="form-control" name="token_tte" id="token_tte" value="<?= $r['token_tte'] ?>" required>

                                </div>

                            </div>
                            <div class="col-md-12 col-12 mb-4">
                                <div class="form-group">
                                    <label for="">Token WA</label>
                                    <input type="text" class="form-control" name="token_wa" id="token_wa" value="<?= $r['token_wa'] ?>" required>

                                </div>

                            </div>


                        </div>


                    </div>

                    <div class="card-footer">
                        <div class="float-start">
                            <a href="#" onclick="history.back()" class="btn btn-outline-danger"> Batal</a>
                        </div>
                        <div class="float-end">
                            <button class="btn btn-primary simpan"> Simpan</button>
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