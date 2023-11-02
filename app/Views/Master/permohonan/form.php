<div class="modal fade" id="form-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= $path ?>/form" method="POST" class="form" autocomplete="off">
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
                                <label for="" class="mb-1">Nama Izin</label>
                                <select name="tblizin_id" id="tblizin_id" class="form-control single-select" required>
                                    <option value="">Pilih</option>
                                    <?php foreach ($izin as $r) : ?>
                                    <option value="<?= $r['tblizin_id'] ?>"><?= $r['tblizin_nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Nama Permohonan</label>
                                <input type="text" class="form-control" name="tblizinpermohonan_nama"
                                    id="tblizinpermohonan_nama" required>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Register Permohonan</label>
                                <input type="text" class="form-control" name="tblizinpermohonan_register"
                                    id="tblizinpermohonan_register" required>
                            </div>
                        </div>


                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Status Aktif</label>
                                <select name="tblizinpermohonan_isaktif" id="tblizinpermohonan_isaktif"
                                    class="form-control">
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
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Yakin</button>
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


<div class="modal fade" id="persyaratan-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Persyaratan</h5>
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


<div class="modal fade" id="kendalialur-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Persyaratan</h5>
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