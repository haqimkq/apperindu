<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
            <td>NO.</td>
            <td>NAMA</td>
            <td>ALAMAT</td>
            <td>NAMA USAHA</td>
            <td>ALAMAT USAHA</td>
            <td>NIK</td>
            <td>NPWP</td>
            <?php foreach ($tabel as $key => $t) : ?>
            <?php if ($key > 1) : ?>
            <td>
                <?= strtoupper(str_replace("_", " ", $t->name)) ?>
            </td>
            <?php endif ?>
            <?php endforeach ?>


        </tr>
        <?php foreach ($rows as $r) : ?>
        <tr>
            <td><?= $r['no'] ?></td>
            <td><?= $r['nama'] ?></td>
            <td><?= $r['alamat'] ?></td>
            <td><?= $r['nama_usaha'] ?></td>
            <td><?= $r['alamat_usaha'] ?></td>
            <td><?= $r['nik'] ?></td>
            <td><?= $r['npwp'] ?></td>
            <?php foreach ($tabel as $key => $t) : ?>
            <?php if ($key > 1) : ?>
            <td>
                <?= $r[$t->name] ?>
            </td>
            <?php endif ?>
            <?php endforeach ?>
        </tr>
        <?php endforeach ?>
    </table>
</body>

</html>