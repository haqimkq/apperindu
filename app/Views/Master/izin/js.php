<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    datatable();
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
}

function update(id) {
    $('.form').trigger('reset');
    $('#form-modal').modal('show');
    $('#id-update').val(id);


    var input = ['tblizin_nama', 'tblizin_isaktif'];

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
        }
    });
}

function hapus(id) {
    $('.form-delete').trigger('reset');
    $('#form-delete-modal').modal('show');
    $('#id-delete').val(id);
}

function lihat_permohonan(id) {
    $('#permohonan-modal').modal('show');

    $.ajax({
        data: {
            id: id,
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        },
        type: "POST",
        dataType: 'html',
        url: "<?= site_url($path . '/get_permohonan') ?>",
        success: function(response) {
            $('.content').html(response)
        }
    });
}





function confirm_label(i) {
    let l = [];
    l[1] = 'Yakin ingin mengaktifkan data yang dipilih ?';
    l[2] = 'Yakin ingin menonaktifkan data yang dipilih ?';
    l[3] = 'Yakin ingin menghapus data yang dipilih ?';

    return l[i];
}

function dismiss() {
    datatable();
    $('#bulk_opsi').val(0);
    $('#bulk').prop('checked', false);

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

$('#save-button').click(function() {
    $('.form-bulk').submit();
});
</script>