<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://raw.githubusercontent.com/ibnufajar0104/img_statis/main/logo-icon.png"
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
    <link href="<?= base_url() ?>assets/css/pace.min.css" rel="stylesheet" />

    <title>Login Form</title>
</head>

<body class="bg-login">

    <!--start wrapper-->
    <div class="wrapper">

        <!--start content-->
        <main class="authentication-content mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-4 mx-auto">
                        <div class="card shadow rounded-5 overflow-hidden">
                            <div class="card-body p-4 p-sm-5">
                                <h5 class="card-title text-center" style="font-size : 14px"><?= nama_aplkasi() ?></h5>
                                <p class="card-text mb-5 text-center">Silahkan login untuk memulai sesi</p>
                                <form class="form-body" method="post">
                                    <?= csrf_field() ?>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">Username</label>
                                            <div class="ms-auto position-relative">
                                                <div
                                                    class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                    <i class="bi bi-person-fill"></i>
                                                </div>
                                                <input type="text" name="username" class="form-control radius-30 ps-5"
                                                    id="username" placeholder="Username anda">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">Password</label>
                                            <div class="ms-auto position-relative">
                                                <div
                                                    class="position-absolute top-50 translate-middle-y search-icon px-3">
                                                    <i class="bi bi-lock-fill"></i>
                                                </div>
                                                <input type="password" class="form-control radius-30 ps-5" id="password"
                                                    name="password" placeholder="Password anda">
                                            </div>
                                        </div>
                                        <div class="col-6">

                                        </div>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit"
                                                    class="btn btn-primary radius-30 login">Login</button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
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
    $('.form-body').submit(function(event) {
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