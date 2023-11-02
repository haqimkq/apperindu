<div class="modal fade" id="form-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form <?= $page ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Nama Izin</label>
                                <select name="id_izin" id="id_izin" class="form-control single-select">
                                    <option value="">Pilih</option>
                                    <option value="">A</option>
                                    <option value="">B</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Nama Permohonan</label>
                                <select name="id_izin" id="" class="form-control single-select">
                                    <option value="">Pilih</option>
                                    <option value="">A</option>
                                    <option value="">B</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">No. Urut</label>
                                <input type="number" class="form-control" name="izin" id="izin">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-group">
                                <label for="" class="mb-1">Nama Persyaratan</label>
                                <select name="id_izin" id="persyaratan" class="form-control single-select">
                                    <option value="">Pilih</option>
                                    <option value="">A</option>
                                    <option value="">B</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpan-button">Simpan</button>
            </div>
        </div>
    </div>
</div>