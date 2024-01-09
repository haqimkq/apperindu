<script src="<?= base_url() ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<!-- <script src="assets/js/form-select2.js"></script> -->
<script>
    $(document).ready(function() {

        $('.hide').hide();
        $('.filter-select, .single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });


    });
</script>