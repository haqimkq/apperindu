<div class="modal fade" id="form-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" class="form-edit-password" autocomplete="off">
                <input type="hidden" name="id" id="id-edit-password">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">


                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Password Baru</label>
                                <input type="text" class="form-control" name="tblpengguna_password"
                                    id="tblpengguna_password" required>

                            </div>
                            <p class="hide tblpengguna_password_validation text-danger">Password minimal
                                8 karakter,
                                paling tidak meliputi 1 huruf kapital, 1 angka dan 1 simbol</p>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Konfirmasi Password</label>
                                <input type="text" class="form-control" name="pwconfirm" id="pwconfirm" required>
                            </div>
                            <p class="hide pwconfirm_validation text-danger">Konfirmasi password harus
                                sama</p>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
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