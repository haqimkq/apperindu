<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <p class="font-weight-bold">Tabel primary (diambi dari data pemohon)</p>

</div>
<table class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th width="10">No.</th>
            <th>Nama kolom</th>
            <th>Tipe data</th>
            <th>Panjang</th>


        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1.</td>
            <td>tgl_permohonan</td>
            <td>tanggal</td>
            <td></td>
        </tr>
        <tr>
            <td>2.</td>
            <td>nama_pemohon</td>
            <td>text</td>
            <td>225</td>
        </tr>

        <tr>
            <td>3.</td>
            <td>alamat_pemohon</td>
            <td>text</td>
            <td>225</td>
        </tr>

        <tr>
            <td>4.</td>
            <td>nama_usaha</td>
            <td>text</td>
            <td>225</td>
        </tr>

        <tr>
            <td>5.</td>
            <td>alamat_usaha</td>
            <td>text</td>
            <td>225</td>
        </tr>
        <tr>
            <td>6.</td>
            <td>nik</td>
            <td>text</td>
            <td>16</td>
        </tr>
        <tr>
            <td>7.</td>
            <td>npwp</td>
            <td>text</td>
            <td>15</td>
        </tr>
    </tbody>
</table>
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <p class="font-weight-bold">Tabel <?= $table ?></p>
    <div class="ms-auto">
        <a class="btn btn-primary btn-sm" onclick="add_kolom('<?= $id ?>','<?= $table ?>')" href="#">Tambah Kolom</a>


    </div>
</div>

<table class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th width="10">No.</th>
            <th>Opsi</th>
            <th>Nama kolom</th>
            <th>Tipe data</th>
            <th>Panjang</th>


        </tr>
    </thead>
    <tbody>

        <?php $no = 1 ?>
        <?php foreach ($field as $key => $r) : ?>
        <?php if ($key > 1) : ?>
        <tr>
            <td><?= $no ?>.</td>
            <td>

                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle btn-sm" type="button"
                        data-bs-toggle="dropdown" aria-expanded="false">Opsi</button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#"
                                onclick="edit_kolom('<?= $id ?>','<?= $r['nama_kolom'] ?>')">Edit Kolom</a>
                        </li>

                        <li><a class="dropdown-item" href="#"
                                onclick="hapus_kolom('<?= $id ?>','<?= $r['nama_kolom'] ?>','<?= $table ?>')">Hapus
                                Kolom</a>
                        </li>
                    </ul>
                </div>
            </td>
            <td><?= $r['nama_kolom'] ?></td>
            <td><?= $r['tipe_data'] ?></td>
            <td><?= $r['panjang'] ?></td>
        </tr>
        <?php $no++ ?>
        <?php endif ?>
        <?php endforeach ?>
    </tbody>

</table>