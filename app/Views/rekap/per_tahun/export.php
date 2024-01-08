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
            <?php foreach (bulan() as $key => $b) : ?>
            <?php $total[$key] = 0; ?>
            <td><?= $b ?></td>
            <?php endforeach ?>
        </tr>
        <?php foreach ($rows as $r) : ?>
        <tr>
            <td><?= $r['nama_izin'] ?></td>
            <?php foreach (bulan() as $key => $b) : ?>
            <?php $total[$key] = $total[$key] +  $r[$key] ?>
            <td><?= $r[$key] ?></td>
            <?php endforeach ?>

        </tr>
        <?php endforeach ?>
        <tr>
        <tr>
            <td>Total</td>
            <?php foreach (bulan() as $key => $b) : ?>

            <td><?= $total[$key] ?></td>
            <?php endforeach ?>

        </tr>

        </tr>
    </table>
</body>

</html>