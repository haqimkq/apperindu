<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/plugins/select2/js/select2.min.js"></script>
<!-- <script src="assets/js/form-select2.js"></script> -->
<script>
$(document).ready(function() {
    datatable(true);

    $('.filter-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
            'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
});

function datatable(bool) {

    let data = {
        tblkecamatan_id: $('#id_kecamatan').val(),
        '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
    }




    console.log(data);

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
        stateSave: bool,
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        order: [], //Initial no order.

        // Load data for the table's content from an Ajax source
        ajax: {
            url: "<?php echo site_url($path . '/get_data') ?>",
            type: "POST",
            data: data

        },


        //Set column definition initialisation properties.
        columnDefs: [{
            targets: [0], //first column / numbering column
            orderable: false, //set not orderable
        }, ],
    });
}

function tambah() {
    $('.form').trigger('reset');
    $('#form-modal').modal('show');


    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        dropdownParent: $("#form-modal"),
        allowClear: Boolean($(this).data('allow-clear')),
    });
}

function update(id) {
    $('.form').trigger('reset');
    $('#form-modal').modal('show');;
    $('#id-update').val(id);

    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        dropdownParent: $("#form-modal"),
        allowClear: Boolean($(this).data('allow-clear')),
    });


    var input = ['tblkelurahan_nama'];
    let select = ['tblkecamatan_id'];
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

                select.forEach(element => {
                    $('#' + element).val(data[element]).trigger('change');
                });
            }
        }
    });
}

function hapus(id) {
    $('.form-delete').trigger('reset');
    $('#form-delete-modal').modal('show');
    $('#id-delete').val(id);
}


$('.filter-select').change(function() {
    datatable(false);
})
</script>