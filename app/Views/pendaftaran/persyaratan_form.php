<div class="col-md-12 col-12 mb-3">
    <h6 class="text-uppercase"> Persyaratan </h6>
    <hr>
</div>
<!-- <div class="row">
    <?php foreach ($row as $r) : ?>

        <div class="mb-4 col-md-6 col-12 mb-3">
            <div class="form-group">
                <label for="" class="mb-1"><?= $r['tblpersyaratan_nama'] ?></label>
                <input type="file" name="<?= $r['tblpersyaratan_id'] ?>" id="<?= $r['tblpersyaratan_id'] ?>" class="form-control">
                <?php if (isset($r['file'])) : ?>
                    <a target="_blank" href="<?= site_url('doc/persyaratan/' . $r['file']) ?>">Lihat file
                        sebelumnya</a>
                <?php endif ?>
            </div>
        </div>

    <?php endforeach ?>
</div> -->

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-persyaratan table-borderless">

                <?php foreach ($row as $r) : ?>
                <tr>

                    <td width="50%">
                        <div class="text-wrap mb-2">
                            <?= $r['tblpersyaratan_nama'] ?>
                        </div>
                        <input type="file" name="<?= $r['tblpersyaratan_id'] ?>" id="<?= $r['tblpersyaratan_id'] ?>"
                            class="form-control form-control-sm mb-2">
                    </td>

                    <td> <?php if (isset($r['file'])) : ?>
                        <?php $file =  path_persyaratan($r['file']) ?>

                        <button type="button" onclick="review('<?= $file ?>')"
                            class="btn btn-block btn-outline-secondary btn-sm review  mb-2"><i
                                class="fadeIn animated bx bx-file"></i>
                            Lihat file
                            sebelumnya</button>
                        <?php endif ?>
                    </td>


                </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</div>