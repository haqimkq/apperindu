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
            <td>Nama Izin</td>
            <?php foreach ($kec as $k) : ?>
            <?php $total[$k['tblkecamatan_id']] = 0; ?>
            <td><?= $k['tblkecamatan_nama'] ?></td>
            <?php endforeach ?>
        </tr>
        <?php foreach ($rows as $r) : ?>
        <tr>
            <td><?= $r['nama_izin'] ?></td>
            <?php foreach ($kec as $k) : ?>
            <?php $total[$k['tblkecamatan_id']] = $total[$k['tblkecamatan_id']] +  $r[$k['tblkecamatan_id']] ?>
            <td><?= $r[$k['tblkecamatan_id']] ?></td>
            <?php endforeach ?>

        </tr>
        <?php endforeach ?>
        <tr>
        <tr>
            <td>Total</td>
            <?php foreach ($kec as $k) : ?>

            <td><?= $total[$k['tblkecamatan_id']] ?></td>
            <?php endforeach ?>

        </tr>

        </tr>
    </table>
</body>

</html>