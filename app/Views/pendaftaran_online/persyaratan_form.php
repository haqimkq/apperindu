<div class="col-md-12 col-12 mb-3">
    <h6 class="text-uppercase"> Persyaratan </h6>
    <hr>
</div>
<?php foreach ($row as $r) : ?>
    <div class="row">
        <div class="mb-4 col-md-6 col-12 mb-3">
            <div class="form-group">
                <label for="" class="mb-1"><?= $r['tblpersyaratan_nama'] ?></label>
                <input type="file" name="<?= $r['tblpersyaratan_id'] ?>" id="<?= $r['tblpersyaratan_id'] ?>" class="form-control">
                <?php if (isset($r['tblpemohonpersyaratan_file'])) : ?>
                    <a target="_blank" href="<?= site_url('doc/persyaratan/' . $r['tblpemohonpersyaratan_file']) ?>">Lihat file
                        sebelumnya</a>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php endforeach ?>