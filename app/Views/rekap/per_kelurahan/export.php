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
            <?php foreach ($kel as $k) : ?>
                <?php $total[$k['tblkelurahan_id']] = 0; ?>
                <td><?= $k['tblkelurahan_nama'] ?></td>
            <?php endforeach ?>
        </tr>
        <?php foreach ($rows as $r) : ?>
            <tr>
                <td><?= $r['nama_izin'] ?></td>
                <?php foreach ($kel as $k) : ?>
                    <?php $total[$k['tblkelurahan_id']] = $total[$k['tblkelurahan_id']] +  $r[$k['tblkelurahan_id']] ?>
                    <td><?= $r[$k['tblkelurahan_id']] ?></td>
                <?php endforeach ?>

            </tr>
        <?php endforeach ?>
        <tr>
        <tr>
            <td>Total</td>
            <?php foreach ($kel as $k) : ?>

                <td><?= $total[$k['tblkelurahan_id']] ?></td>
            <?php endforeach ?>

        </tr>

        </tr>
    </table>
</body>

</html>