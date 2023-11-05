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
        tblizin_id: $('#id_izin').val(),
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


    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        dropdownParent: $("#form-modal"),
        allowClear: Boolean($(this).data('allow-clear')),
    });

    $('#form-modal').modal('show');
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


    let input = ['tblizinpermohonan_nama', 'tblizinpermohonan_isaktif', 'tblizinpermohonan_register'];
    let select = ['tblizin_id']
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


function confirm_label(i) {
    let l = [];
    l[1] = 'Yakin ingin mengaktifkan data yang dipilih ?';
    l[2] = 'Yakin ingin menonaktifkan data yang dipilih ?';
    l[3] = 'Yakin ingin menghapus data yang dipilih ?';

    return l[i];
}

function dismiss() {
    datatable(true);
    $('#bulk_opsi').val(0);
    $('#bulk').prop('checked', false);

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
        url: "<?= site_url($path . '/get_persyaratan') ?>",
        success: function(response) {
            $('.content').html(response)
        }
    });
}

function lihat_kendali_alur(id) {
    $('#kendalialur-modal').modal('show');

    $.ajax({
        data: {
            id: id,
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        },
        type: "POST",
        dataType: 'html',
        url: "<?= site_url($path . '/get_kendali_alur') ?>",
        success: function(response) {
            $('.content').html(response)
        }
    });
}




$('#bulk_opsi').change(function() {
    let checked = false;
    $('.bulk').each(function() {

        if (this.checked) {
            checked = true;

        }

    });

    if (checked) {
        let i = $(this).val();
        let html = confirm_label(i)

        $('.confirm-label').html(html);
        $('#form-bulk-modal').modal('show');
    } else {
        error('Tidak ada data yang dipilih');
        dismiss();
    }




})

$('.filter-select').change(function() {
    datatable(false);
})

$('#save-button').click(function() {
    $('.form-bulk').submit();
});
</script>