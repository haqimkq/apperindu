<script src="<?= base_url() ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<!-- <script src="assets/js/form-select2.js"></script> -->
<script>
$(document).ready(function() {

    datatable();



});

function datatable() {

    let data = {
        'str': '<?= isset($str) ? $str  : '' ?>',
        '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
    }

    $('.table').DataTable({
        responsive: false,
        autoWidth: false,
        searching: true,
        info: true,
        paginate: true,
        bDestroy: true,
        ordering: false,
        language: {
            lengthMenu: "_MENU_  data per halaman",
            zeroRecords: "Data tidak tersedia",
            search: "Pencarian ",
            info: "Menampilkan halaman _PAGE_ dari _PAGES_ halaman",
            infoEmpty: "Data tidak tersedia",
            infoFiltered: "(hasil pencarian/filter dari _MAX_ total data)",
            paginate: {
                "previous": "<",
                "next": ">",
            }
        },
        stateSave: false,
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        order: [], //Initial no order.

        // Load data for the table's content from an Ajax source
        ajax: {
            url: "<?php echo site_url($path . '/get_data') ?>",
            data: data,
            type: "POST",

        },


        //Set column definition initialisation properties.
        columnDefs: [{
            targets: [0], //first column / numbering column
            orderable: false, //set not orderable
        }, ],
    });
}

function loading_button(status) {
    if (status) {
        $('.simpan').prop('disabled', true);
        html =
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Tunggu sebentar...'
        $('.simpan').html(html);
    } else {

        $('.simpan').prop('disabled', false);
        html = '<i class="bi bi-pencil-square"></i> Tanda Tangani'
        $('.simpan').html(html);

    }
}


// Listen for the form's submit event
$('.form').submit(function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the form data
    const formData = $(this).serialize();
    $.ajax({
        data: formData,
        type: "POST",
        dataType: 'json',
        url: "<?= site_url($path . '/form') ?>",
        beforeSend: function() {
            // Menampilkan elemen loading
            loading_button(true);
        },
        success: function(response) {
            if (response.status) {

                success(response.msg);
                setTimeout(function() {
                    history.back()
                }, 1000);

            } else {


                error(response.msg);
                loading_button(false);
            }

        },
        error: function() {
            // Menyembunyikan elemen loading jika terjadi kesalahan
            error('Terjadi kesalahan');
            loading_button(false);
            // setTimeout(function() {
            //     history.back()
            // }, 1000);
        }
    });

});
</script>