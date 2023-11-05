<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://raw.githubusercontent.com/ibnufajar0104/img_statis/main/logo%20tala.png"
        type="image/png" />
    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/notifications/css/lobibox.min.css" />

    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />

    <title><?= $title ?></title>
</head>

<body class="bg-login">

    <!--start wrapper-->
    <div class="wrapper">

        <!--start content-->
        <main class="authentication-content">
            <div class="container-fluid">
                <div class="authentication-card">
                    <div class="card shadow rounded-5 overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6 d-flex align-items-center justify-content-center border-end">
                                <img src="https://raw.githubusercontent.com/ibnufajar0104/img_statis/main/fotopns123-1.png"
                                    class="img-fluid" alt="" width="300">
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body p-4 p-sm-5">
                                    <h5 class="card-title"><?= nama_aplkasi() ?>
                                    </h5>
                                    <p class="card-text mb-5">Silahkan login untuk memulai sesi</p>
                                    <form action="" method="POST" class="form" autocomplete="off">
                                        <?= csrf_field() ?>
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label for="inputEmailid" class="form-label">Username</label>
                                                <input type="text" name="username" class="form-control  radius-30"
                                                    id="username" required>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailid" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control  radius-30"
                                                    id="password" required>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid gap-3">
                                                    <button type="submit"
                                                        class="btn  btn-primary radius-30 login">Login</button>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!--end page main-->

    </div>
    <!--end wrapper-->


    <!--plugins-->
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/pace.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/notifications/js/lobibox.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/notifications/js/notifications.min.js"></script>

    <script>
    $('.form').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        const formData = $(this).serialize();

        $.ajax({
            data: formData,
            type: "POST",
            dataType: 'json',
            url: "<?= site_url($url . '/form') ?>",

            beforeSend: function() {
                // Menampilkan elemen loading
                loading_button(true);
            },


            success: function(response) {

                if (response.status) {
                    success(response.msg);
                    loading_button(false);
                    setTimeout(function() {

                        window.location.href = response.url;
                    }, 1000)
                } else {
                    error(response.msg);
                    loading_button(false);
                }

            },
            error: function() {
                // Menyembunyikan elemen loading jika terjadi kesalahan
                error('Terjadi kesalahan');
                loading_button(false);

            }
        });


    });


    function loading_button(status) {
        if (status) {
            $('.login').prop('disabled', true);
            html =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Tunggu sebentar...'
            $('.login').html(html);
        } else {

            $('.login').prop('disabled', false);
            html =
                'Login'
            $('.login').html(html);

        }
    }


    function error(msg) {
        Lobibox.notify('error', {
            pauseDelayOnHover: true,
            size: 'mini',
            rounded: true,
            icon: 'bx bx-x-circle',
            delayIndicator: false,
            continueDelayOnInactiveTab: false,
            position: 'top right',
            msg: msg
        });
    }

    function success(msg) {
        Lobibox.notify('success', {
            pauseDelayOnHover: true,
            size: 'mini',
            rounded: true,
            icon: 'bx bx-check-circle',
            delayIndicator: false,
            continueDelayOnInactiveTab: false,
            position: 'top right',
            msg: msg
        });
    }
    </script>


</body>

</html>