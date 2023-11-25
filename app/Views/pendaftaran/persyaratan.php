<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-borderless" style="width:100%">
                <thead>
                    <tr>
                        <th width="5%">No.</th>

                        <!-- <th width="15%">Opsi</th> -->
                        <th>Nama Persyaratan</th>
                        <th>File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($p) : ?>
                        <?php $no = 1 ?>
                        <?php foreach ($p as $row) : ?>

                            <tr>
                                <td><?= $no ?>.</td>

                                <td>
                                    <div class="text-wrap">
                                        <?= $row['tblpersyaratan_nama'] ?>
                                    </div>
                                </td>
                                <td>



                                    <button type="button" onclick="review('<?= base_url('doc/persyaratan/' . $row['tblpemohonpersyaratan_file']) ?>')" class="btn btn-block btn-outline-secondary btn-sm review  mb-2"><i class="fadeIn animated bx bx-file"></i>
                                        Lihat file</button>
                                </td>
                            </tr>
                            <?php $no++ ?>
                        <?php endforeach ?>
                        <?php $rekom = 'doc/sign/rekomendasi_' . $id . '.pdf' ?>

                        <?php if (file_exists($rekom)) : ?>
                            <tr>
                                <td><?= $no ?>.</td>
                                <td><b>Rekomendasi Dinas Terkait</b></td>
                                <td>

                                    <button type="button" onclick="review('<?= base_url($rekom) ?>')" class="btn btn-block btn-outline-secondary btn-sm review  mb-2"><i class="fadeIn animated bx bx-file"></i>
                                        Lihat file</button>

                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php else : ?>
                        <tr>
                            <td class="text-center" colspan="4">Tidak ada data</td>
                        </tr>
                    <?php endif ?>
                </tbody>

            </table>
        </div>

    </div>

</div>