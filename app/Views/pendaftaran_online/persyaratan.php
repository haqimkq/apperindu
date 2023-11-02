<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table" style="width:100%">
                <thead>
                    <tr>
                        <th width="5%">No.</th>

                        <!-- <th width="15%">Opsi</th> -->
                        <th width="40%">Nama Persyaratan</th>
                        <th width="40%">File</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($p) : ?>
                    <?php $no = 1 ?>
                    <?php foreach ($p as $row) : ?>
                    <tr>
                        <td><?= $no ?>.</td>
                        <!-- <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Opsi</button>
                                <ul class="dropdown-menu">

                                    <li><a class="dropdown-item" href="">Edit</a>
                                    </li>
                                    <li><a class="dropdown-item" href="#">Hapus</a>
                                    </li>
                                </ul>
                            </div>

                        </td> -->
                        <td>
                            <div class="text-wrap">
                                <?= $row['tblpersyaratan_nama'] ?>
                            </div>
                        </td>
                        <td>
                            <?php $url =  site_url('doc/persyaratan/' . $row['tblpemohonpersyaratan_file']) ?>
                            <?php if (!file_exists('doc/persyaratan/' . $row['tblpemohonpersyaratan_file'])) : ?>
                            <?php $url =  path_online() . $row['tblpemohonpersyaratan_file'] ?>
                            <?php endif ?>

                            <a target="_blank" href="<?= $url ?>"><?= $row['tblpemohonpersyaratan_file'] ?> </a>
                        </td>
                    </tr>
                    <?php $no++ ?>
                    <?php endforeach ?>
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