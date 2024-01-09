<!DOCTYPE html>
<html lang="en" class="">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="https://raw.githubusercontent.com/ibnufajar0104/img_statis/main/logo-icon.png"
        type="image/png" />
    <!--plugins-->

    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/notifications/css/lobibox.min.css" />
    <link href="<?= base_url() ?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/bootstrap-extended.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/icons.css" rel="stylesheet" />
    <!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />

    <!-- loader-->
    <link href="<?= base_url() ?>assets/css/pace.min.css" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="<?= base_url() ?>assets/css/dark-theme.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/light-theme.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/semi-dark.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/header-colors.css" rel="stylesheet" />


    <link href="<?= base_url() ?>assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/plugins/select2/css/select2-bootstrap4.css" rel="stylesheet" />


    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <style>
    #loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #ffffff;
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #loader {
        border: 16px solid #f3f3f3;
        /* Light gray */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    table,
    td {
        vertical-align: middle;
        font-size: 12px;
    }

    .table-persyaratan td {
        vertical-align: bottom;
    }

    label {
        font-size: 12px;
        /* font-weight: 600; */
    }

    body {
        font-family: 'Roboto';

    }
    </style>
    <title><?= $title ?></title>
</head>

<body>

    <div id="loader-overlay">
        <div id="loader"></div>
    </div>
    <!--start wrapper-->
    <div class="wrapper">
        <!--start top header-->
        <?= $this->include('layout/header'); ?>
        <!--end top header-->

        <!--start sidebar -->
        <?= $this->include('layout/menu'); ?>
        <!--end sidebar -->

        <!--start content-->
        <?= $this->renderSection('content'); ?>

        <!--end page main-->

        <!--start overlay-->
        <div class="overlay nav-toggle-icon"></div>
        <!--end overlay-->

        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class="bx bxs-up-arrow-alt"></i></a>
        <!--End Back To Top Button-->

        <!--start switcher-->
        <div class="switcher-body">
            <button class="btn btn-primary btn-switcher shadow-sm" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                <i class="bi bi-paint-bucket me-0"></i>
            </button>
            <div class="offcanvas offcanvas-end shadow border-start-0 p-2" data-bs-scroll="true"
                data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
                <div class="offcanvas-header border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">
                        Theme Customizer
                    </h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <h6 class="mb-0">Theme Variation</h6>
                    <hr />
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="LightTheme"
                            value="option1" />
                        <label class="form-check-label" for="LightTheme">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="DarkTheme"
                            value="option2" />
                        <label class="form-check-label" for="DarkTheme">Dark</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="SemiDarkTheme"
                            value="option3" checked />
                        <label class="form-check-label" for="SemiDarkTheme">Semi Dark</label>
                    </div>
                    <hr />
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="MinimalTheme"
                            value="option3" />
                        <label class="form-check-label" for="MinimalTheme">Minimal Theme</label>
                    </div>
                    <hr />
                    <!-- <h6 class="mb-0">Header Colors</h6>
                    <hr />
                    <div class="header-colors-indigators">
                        <div class="row row-cols-auto g-3">
                            <div class="col">
                                <div class="indigator headercolor1" id="headercolor1"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor2" id="headercolor2"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor3" id="headercolor3"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor4" id="headercolor4"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor5" id="headercolor5"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor6" id="headercolor6"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor7" id="headercolor7"></div>
                            </div>
                            <div class="col">
                                <div class="indigator headercolor8" id="headercolor8"></div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
        <!--end switcher-->

        <div class="modal fade" id="log-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">


                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Log</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body content">



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>

                    </div>

                </div>
            </div>
        </div>


        <div class="modal fade" id="persyaratan-modal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">


                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Persyaratan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body content">



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Tutup</button>

                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="fileModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 class="modal-title">Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center" id="fileContent">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end wrapper-->

    <!-- Bootstrap bundle JS -->
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/notifications/js/lobibox.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/notifications/js/notifications.min.js"></script>
    <script src="<?= base_url() ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="<?= base_url() ?>assets/js/pace.min.js"></script>

    <!--app-->
    <script src="<?= base_url() ?>assets/js/app.js"></script>


    <!-- <script>
    new PerfectScrollbar('.review-list');
    new PerfectScrollbar('.chat-talk');
    </script> -->

    <script>
    $(document).ready(function() {

        var loader = document.getElementById("loader-overlay");
        setTimeout(function() {
            loader.style.display = "none";
            theme();
        }, 200);


        var menu_pendaftaran_online = $('#menu-pendaftaran-online').hasClass('jml-pendaftaran-online');

        if (menu_pendaftaran_online) {

            jml_pendaftaran_online();
        }


        var menu_validasi_berkas = $('#menu-validasi-berkas').hasClass('jml-validasi-berkas');

        if (menu_validasi_berkas) {


            jml_validasi_berkas();
        }


        <?php if (session()->getFlashdata('success')) : ?>
        Lobibox.notify('success', {
            pauseDelayOnHover: true,
            size: 'mini',
            rounded: true,
            icon: 'bx bx-check-circle',
            delayIndicator: false,
            continueDelayOnInactiveTab: false,
            position: 'top right',
            msg: '<?= session()->getFlashdata('success') ?>'
        });
        <?php endif ?>


        <?php if (session()->getFlashdata('error')) : ?>
        Lobibox.notify('error', {
            pauseDelayOnHover: true,
            size: 'mini',
            rounded: true,
            icon: 'bx bx-x-circle',
            delayIndicator: false,
            continueDelayOnInactiveTab: false,
            position: 'top right',
            msg: '<?= session()->getFlashdata('error') ?>'
        });
        <?php endif ?>
    })



    $("#LightTheme").on("click", function() {

        localStorage.setItem("theme", "light-theme");
        theme();
    });

    $("#DarkTheme").on("click", function() {

        localStorage.setItem("theme", "dark-theme");
        theme();
    });

    $("#SemiDarkTheme").on("click", function() {

        localStorage.setItem("theme", "semi-dark");
        theme();

    });

    $("#MinimalTheme").on("click", function() {

        localStorage.setItem("theme", "minimal-theme");
        theme();
    });

    $('#bulk').change(function() {

        if (this.checked) {

            $('.bulk').prop('checked', true);

        } else {
            $('.bulk').prop('checked', false);
        }
    });

    function theme() {

        var t = localStorage.getItem("theme");

        if (t) {
            $("html").attr("class", t)
        } else {
            $("html").attr("class", "light-theme")
        }
    }


    function reset_filter() {

        $('.form-filter').trigger('reset');
        $('.filter-select').val(null).trigger('change');
    }



    function log(id) {
        $('#log-modal').modal('show');

        $.ajax({
            data: {
                id: id,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            type: "POST",
            dataType: 'html',
            url: "<?= site_url('pendaftaran/log') ?>",
            success: function(response) {
                $('.content').html(response)
            }
        });
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

    function info(id) {

        $('#info-modal').modal('show');
        get_info(id);

    }

    function get_info(id) {
        $.ajax({
            data: {
                id: id,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            type: "POST",
            dataType: 'html',
            url: "<?= site_url('Master/variabel_sk/get_info') ?>",
            beforeSend: function() {
                var html =
                    '<div class="text-center"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Tunggu sebentar...</div>';
                $('.content').html(html)
                console.log(html);
            },
            success: function(response) {
                $('.content').html(response);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                error('Tabel sudah dihapus dari database');
            }
        });
    }





    function lihat_persyaratan(id) {


        $('#persyaratan-modal').modal('show');

        $.ajax({
            data: {
                id: id,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            type: "POST",
            dataType: 'html',
            url: "<?= site_url('pendaftaran/persyaratan') ?>",
            success: function(response) {


                $('.content').html(response)
            }
        });
    }


    function review(path) {
        console.log('path')
        var fileExt = path.split('.').pop().toLowerCase();

        if (fileExt === "pdf") {
            $("#fileContent").html(`<iframe src="${path}" width="100%" height="500px"></iframe>`);
        } else if (fileExt === "jpg" || fileExt === "jpeg" || fileExt === "png" || fileExt === "gif") {
            $("#fileContent").html(`<img src="${path}" alt="Image" width="50%">`);
        } else {
            $("#fileContent").html("Jenis file tidak didukung.");
        }

        $("#fileModal").modal("show");
    }


    function reviewCetak(path) {

        $("#review").html(`<iframe src="${path}" width="100%" height="600px"></iframe>`);
        $('.review-card').show();
        // $("#reviewCetak").show()
    }

    function jml_pendaftaran_online() {

        $.ajax({

            type: "GET",
            dataType: 'html',
            url: "<?= site_url('pendaftaran_online/jml_pendaftaran') ?>",
            success: function(response) {


                $('.jml-pendaftaran-online').html(response)
            }
        });
    }

    function jml_validasi_berkas() {

        $.ajax({

            type: "GET",
            dataType: 'html',
            url: "<?= site_url('kendali_berkas/jml_validasi_berkas') ?>",
            success: function(response) {


                $('.jml-validasi-berkas').html(response)
            }
        });
    }
    </script>

    <?= $this->renderSection('js'); ?>
</body>

</html>