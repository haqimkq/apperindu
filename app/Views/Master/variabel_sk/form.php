<div class="modal fade" id="info-modal" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">


            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Tabel</h5>
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

<div class="modal fade" id="form-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" method="POST" class="form">
                <input type="hidden" name="id" id="id-update">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kolom</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <table class="table  table-bordered">
                        <tr>
                            <th>Nama kolom</th>
                            <th>Tipe data</th>
                            <th>Panjang</th>
                        </tr>

                        <tr>
                            <td>
                                <input type="hidden" name="table" id="table">
                                <input type="hidden" name="nama_kolom_lama" id="nama_kolom_lama">
                                <input type="text" class="form-control" id="nama_kolom" name="nama_kolom" required>

                            </td>
                            <td>

                                <select id="tipe_data" name="tipe_data" class="form-control" required>
                                    <option value="">pilih</option>
                                    <?php foreach (data_type_arr() as $key => $row) : ?>
                                    <option value="<?= $key ?>">
                                        <?= $row ?></option>
                                    <?php endforeach ?>
                                </select>
                            </td>
                            <td><input type="number" class="form-control" id="panjang" max="225" name="panjang">
                            </td>
                        </tr>

                    </table>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="form-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" method="POST" class="form-add">
                <input type="hidden" name="table" id="table-add">
                <input type="hidden" name="id" id="id-add">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kolom</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Nama kolom</label>
                                <input type="text" class="form-control" id="nama_kolom_add" name="nama_kolom" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Tipe data</label>
                                <select name="tipe_data" class="form-control" required>
                                    <option value="">pilih</option>
                                    <?php foreach (data_type_arr() as $key => $row) : ?>
                                    <option value="<?= $key ?>">
                                        <?= $row ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Panjang</label>
                                <input type="number" class="form-control" max="225" name="panjang">
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary simpan">Simpan</button>
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
                <input type="hidden" name="nama_kolom" id="kolom-delete">
                <input type="hidden" name="table" id="table-delete">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p>Yakin ingin menghapus kolom ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary hapus">Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="form-delete-table-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= $path ?>/delete" method="POST" class="form-delete-table">
                <?= csrf_field() ?>
                <input type="hidden" name="id" id="id-table-delete">
                <input type="hidden" name="table" id="table-delete-delete">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p class="val-form-delete-table"></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary hapus">Yakin</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="form-update-table-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" method="POST" class="form-update-table">
                <input type="hidden" name="id" id="id-table-update">
                <input type="hidden" class="form-control  table-update" name="table_lama" required>
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Tabel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row ">
                        <div class="col-md-4 md-4 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Nama Tabel</label>
                                <input type="text" class="form-control  table-update" name="table" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>