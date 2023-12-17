<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
    <link rel="icon" href="https://raw.githubusercontent.com/ibnufajar0104/img_statis/main/logo-icon.png"
        type="image/png" />
    <style>
    body {
        margin: 0;
        /* Menghilangkan margin pada body */
        padding: 0;
        /* Menghilangkan padding pada body */
    }

    embed {
        display: block;
        /* Agar elemen embed menempati baris penuh */
        width: 100vw;
        /* Lebar elemen embed sesuai dengan lebar tampilan */
        height: 100vh;
        /* Tinggi elemen embed sesuai dengan tinggi tampilan */
    }
    </style>
</head>

<body>
    <embed src="<?= $embeddedPdf ?>" type="application/pdf" width="100%" height="600px" />
</body>

</html>