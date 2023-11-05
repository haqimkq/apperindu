<div class="modal fade" id="form-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= $path ?>/form" method="POST" class="form">
                <input type="hidden" name="id" id="id-update">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form <?= $page ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Nama Kecamatan</label>
                                <select name="tblkecamatan_id" id="tblkecamatan_id" class="form-control single-select"
                                    required>
                                    <option value=""></option>
                                    <?php foreach ($kecamatan as $r) : ?>
                                    <option value="<?= $r['tblkecamatan_id'] ?>"><?= $r['tblkecamatan_nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Nama Kelurahan</label>
                                <input type="text" class="form-control" name="tblkelurahan_nama" id="tblkelurahan_nama"
                                    required>
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

<div class="modal fade" id="form-delete-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= $path ?>/delete" method="POST" class="form-delete">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="id-delete">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p>Yakin ingin menghapus data ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>