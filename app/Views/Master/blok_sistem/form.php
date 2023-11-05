<div class="modal fade" id="form-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= $path ?>/form" method="POST" class="form">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="id-update">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form <?= $page ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Nama Blok Sistem</label>
                                <input type="text" class="form-control" name="tblkendalibloksistem_nama"
                                    id="tblkendalibloksistem_nama" required>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Status Aktif</label>
                                <select name="tblkendalibloksistem_isaktif" id="tblkendalibloksistem_isaktif"
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
    <?= csrf_field() ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= $path ?>/delete" method="POST" class="form-delete">
                <input type="hidden" name="id" id="id-delete">
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


<div class="modal fade" id="bloksistemtugas-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Blok Sistem Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body content">



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>

            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="pengguna-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body content">



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>

            </div>

        </div>
    </div>
</div>