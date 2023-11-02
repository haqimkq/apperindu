<script src="<?= base_url() ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<!-- <script src="assets/js/form-select2.js"></script> -->
<script>
$(document).ready(function() {
    datatable(true);
});



function datatable(bool) {

    let data = {
        tblizin_id: $('#id_izin').val(),
        tblizinpermohonan_id: $('#id_permohonan').val(),
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

function edit_kolom(id, kolom) {
    $('.form').trigger('reset');
    $('#form-update').modal('show');
    $('#id-update').val(id);
    var input = ['table', 'nama_kolom', 'tipe_data', 'panjang'];

    $.ajax({
        data: {
            id: id,
            kolom: kolom,
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'

        },
        type: "POST",
        dataType: 'json',
        url: "<?= site_url($path . '/get_row_kolom') ?>",
        success: function(response) {

            console.log(response);
            if (response.status) {
                let data = response.data;
                input.forEach(element => {
                    $('#' + element).val(data[element]);
                });

                $('#nama_kolom_lama').val(data['nama_kolom'])
            }
        }
    });
}

function add_kolom(id, table) {
    $('.form-add').trigger('reset');
    $('#form-add').modal('show');
    $('#id-add').val(id);
    $('#table-add').val(table);

}

function hapus_kolom(id, kolom, table) {
    $('.form-delete').trigger('reset');
    $('#form-delete-modal').modal('show');
    $('#id-delete').val(id);
    $('#kolom-delete').val(kolom);
    $('#table-delete').val(table);
}

function hapus(id, table) {
    $('.form-delete-table').trigger('reset');
    $('#form-delete-table-modal').modal('show');
    $('#id-table-delete').val(id);
    $('#table-delete-delete').val(table);

    $('.val-form-delete-table').text('Yakin ingin menghapus tabel ' + table + ' ?')


}

function update(id, table) {
    $('.form-update-table').trigger('reset');
    $('#form-update-table-modal').modal('show');
    $('#id-table-update').val(id);
    $('.table-update').val(table);



}

$('.form-update-table').submit(function(event) {


    event.preventDefault();

    var formData = new FormData(this);


    $.ajax({
        url: '<?php echo site_url($path . '/update_table') ?>', // Ganti dengan URL endpoint pengunggahan file dan data POST di server Anda
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
            // Menampilkan elemen loading
            loading_button2(true);
        },
        success: function(response) {

            loading_button2(false);

            if (response.status) {
                success(response.msg);

            } else {
                error(response.msg);
            }

            $('#form-update-table-modal').modal('hide');
            datatable(true);

        },
        error: function(xhr, status, error) {
            loading_button2(false);
            error('Terjadi kesalahan');
            $('#form-update-table-modal').modal('hide');
        }
    });
});

$('.form-delete-table').submit(function(event) {


    event.preventDefault();

    var formData = new FormData(this);


    $.ajax({
        url: '<?php echo site_url($path . '/delete_table') ?>', // Ganti dengan URL endpoint pengunggahan file dan data POST di server Anda
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
            // Menampilkan elemen loading
            loading_button2(true);
        },
        success: function(response) {

            loading_button2(false);

            if (response.status) {
                success(response.msg);

            } else {
                error(response.msg);
            }

            $('#form-delete-table-modal').modal('hide');
            datatable(true);

        },
        error: function(xhr, status, error) {
            loading_button2(false);
            error('Terjadi kesalahan');
            $('#form-delete-table-modal').modal('hide');
        }
    });
});


$('.form').submit(function(event) {


    event.preventDefault();

    var formData = new FormData(this);


    $.ajax({
        url: '<?php echo site_url($path . '/form_update_kolom') ?>', // Ganti dengan URL endpoint pengunggahan file dan data POST di server Anda
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
            // Menampilkan elemen loading
            loading_button(true);
        },
        success: function(response) {

            loading_button(false);

            if (response.status) {
                success(response.msg);
                get_info(response.id);
            } else {
                error(response.msg);
            }

            $('#form-update').modal('hide');

        },
        error: function(xhr, status, error) {
            loading_button(false);
            error('Terjadi kesalahan');
            $('#form-update').modal('hide');
        }
    });
});

$('.form-add').submit(function(event) {


    event.preventDefault();

    var formData = new FormData(this);


    $.ajax({
        url: '<?php echo site_url($path . '/form_add_kolom') ?>', // Ganti dengan URL endpoint pengunggahan file dan data POST di server Anda
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
            // Menampilkan elemen loading
            loading_button(true);
        },
        success: function(response) {

            loading_button(false);

            if (response.status) {
                success(response.msg);
                get_info(response.id);
            } else {
                error(response.msg);
            }

            $('#form-add').modal('hide');

        },
        error: function(xhr, status, error) {
            loading_button(false);
            error('Terjadi kesalahan');
            $('#form-add').modal('hide');
        }
    });
});

$('.form-delete').submit(function(event) {


    event.preventDefault();

    var formData = new FormData(this);


    $.ajax({
        url: '<?php echo site_url($path . '/delete_kolom') ?>', // Ganti dengan URL endpoint pengunggahan file dan data POST di server Anda
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function() {
            // Menampilkan elemen loading
            loading_button2(true);
        },
        success: function(response) {

            loading_button2(false);

            if (response.status) {
                success(response.msg);
                get_info(response.id);
            } else {
                error(response.msg);
            }

            $('#form-delete-modal').modal('hide');

        },
        error: function(xhr, status, error) {
            loading_button2(false);
            error('Terjadi kesalahan');
            $('#form-delete-modal').modal('hide');
        }
    });
});

$('#nama_kolom').on('input', function() {
    var inputValue = $(this).val(); // Mendapatkan nilai input

    // Mengganti spasi dengan underscore
    var modifiedValue = inputValue.replace(/ /g, '_');

    // Menetapkan kembali nilai input yang telah dimodifikasi
    $(this).val(modifiedValue);
});

function loading_button(status) {
    if (status) {
        $('.simpan').prop('disabled', true);
        html =
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Tunggu sebentar...'
        $('.simpan').html(html);
    } else {

        $('.simpan').prop('disabled', false);
        html = 'Simpan'
        $('.simpan').html(html);

    }
}


function loading_button2(status) {
    if (status) {
        $('.hapus').prop('disabled', true);
        html =
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Tunggu sebentar...'
        $('.hapus').html(html);
    } else {

        $('.hapus').prop('disabled', false);
        html = 'Yakin'
        $('.hapus').html(html);

    }
}
</script>