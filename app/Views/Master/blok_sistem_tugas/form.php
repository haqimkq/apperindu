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
                                <label for="" class="mb-1">Nama Blok Sistem</label>
                                <select name="tblkendalibloksistem_id" id="tblkendalibloksistem_id"
                                    class="form-control single-select" required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($blok_sistem as $r) : ?>
                                    <option value="<?= $r['tblkendalibloksistem_id'] ?>">
                                        <?= $r['tblkendalibloksistem_nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Nama Tugas</label>
                                <input type="text" class="form-control" name="tblkendalibloksistemtugas_nama"
                                    id="tblkendalibloksistemtugas_nama" required>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Status Aktif</label>
                                <select name="tblkendalibloksistemtugas_isaktif" id="tblkendalibloksistemtugas_isaktif"
                                    class="form-control" required>
                                    <?php foreach (status_aktif_ar() as $r) : ?>
                                    <option value="<?= $r['val'] ?>"><?= $r['cap'] ?></option>
                                    <?php endforeach ?>
                                </select>
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
                <input type="hidden" name="id" id="id-delete">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p>Yakin ingin menghapus data ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-outline-danger">Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="form-bulk-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body confirm-label">



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" onclick="dismiss()"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="save-button">Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>