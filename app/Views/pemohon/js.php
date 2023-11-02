<script src="<?= base_url() ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<!-- <script src="assets/js/form-select2.js"></script> -->
<script>
$(document).ready(function() {

    datatable();

    // $('.filter-select').select2({
    //     theme: 'bootstrap4',
    //     width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
    //         'style',
    //     placeholder: $(this).data('placeholder'),
    //     allowClear: Boolean($(this).data('allow-clear')),
    // });

    var id = $('#id').val();

    if (id) {
        update(id)
    }
});

function datatable() {
    let data = {

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
        stateSave: true,
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        order: [], //Initial no order.

        // Load data for the table's content from an Ajax source
        ajax: {
            url: "<?php echo site_url($url . '/get_data') ?>",
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


function update(id) {


    var input = ['tblpemohon_finger', 'tblpemohon_nama', 'tblpemohon_alamat', 'refjenisidentitas_id',
        'tblpemohon_noidentitas', 'tblpemohon_npwp', 'tblpemohon_telpon', 'tblpemohon_email'
    ];

    $.ajax({
        data: {
            id: id,
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        },
        type: "POST",
        dataType: 'json',
        url: "<?= site_url($path . '/get_row') ?>",
        success: function(response) {
            if (response.status) {
                let data = response.data;
                input.forEach(element => {
                    $('#' + element).val(data[element]);
                });

            }

            // $('.single-select').select2({
            //     theme: 'bootstrap4',
            //     width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
            //         '100%' : 'style',
            //     placeholder: $(this).data('placeholder'),
            //     allowClear: Boolean($(this).data('allow-clear')),
            // });

        }
    });



}

function hapus(id) {
    $('.form-delete').trigger('reset');
    $('#form-delete-modal').modal('show');
    $('#id-delete').val(id);
}
</script>