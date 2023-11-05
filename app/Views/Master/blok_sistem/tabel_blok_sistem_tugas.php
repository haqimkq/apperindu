<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>

                        <th>Blok Sistem Tugas</th>
                        <th>Status Aktif</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><?= $no ?>.</td>

                        <td>
                            <div class="text-wrap"><?= $r['tblkendalibloksistemtugas_nama'] ?></div>
                        </td>

                        <td><?= status_aktif($r['tblkendalibloksistemtugas_isaktif']) ?></td>
                    </tr>
                    <?php $no++ ?>
                    <?php endforeach ?>
                </tbody>


            </table>
        </div>

    </div>

</div>