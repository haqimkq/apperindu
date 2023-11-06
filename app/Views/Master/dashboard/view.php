<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<main class="page-content">
    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">

    </div>
    <!--end row-->

    <div class="row">

    </div>
    <!--end row-->

    <div class="row row-cols-1 row-cols-lg-4 radial-charts g-4">


    </div>
    <!--end row-->

    <div class="row">

    </div>
    <!--end row-->

    <div class="row row-cols-1 row-cols-lg-3">

    </div>
    <!--end row-->

    <div class="row">

    </div>
    <!--end row-->
</main>
<?= $this->endSection('content'); ?>



<?= $this->section('js'); ?>
<script src="assets/plugins/chartjs/js/Chart.min.js"></script>
<script src="assets/plugins/chartjs/js/Chart.extension.js"></script>
<script src="assets/plugins/apexcharts-bundle/js/apexcharts.min.js"></script>
<!-- Vector map JavaScript -->
<script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="assets/js/index.js"></script>
<?= $this->endSection('js'); ?>