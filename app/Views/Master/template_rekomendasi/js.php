<script src="<?= base_url() ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<!-- <script src="assets/js/form-select2.js"></script> -->
<script>
$(document).ready(function() {
    datatable(true);
    var id = $('#id').val();

    if (id) {
        update(id)
    }

    $('.filter-select,.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
            'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });



});

$('.filter-select').change(function() {
    datatable(false);
})

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

function update(id) {


    var input = ['tblizin_id', 'tblizinpermohonan_id', 'tblizinpermohonan_id_', 'tblskizin_tabelvariabel_idrekom'];

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
                    $('#' + element).val(data[element])
                });


                $('#tblizinpermohonan_id_').val(data['tblizinpermohonan_id']);
                $('#tblskizin_rekomtemplate_old').val(data['tblskizin_rekomtemplate'])

                permohonan_dinamis_2(data['tblizin_id'], '#tblizinpermohonan_id', data[
                    'tblizinpermohonan_id']);

                $("#link").attr("href", "<?= base_url('doc/template/') ?>" + data[
                    'tblskizin_rekomtemplate']);
            }

            $('.single-select').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
                    '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });



        }
    });



}



function permohonan_dinamis(id, el) {


    $(el).find('option').not(':first').remove();
    $.ajax({
        url: "<?php echo site_url($path . '/get_permohonan_by_id_izin_json') ?>", // Ganti dengan URL yang sesuai
        type: 'POST',
        data: {
            id_izin: id,
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.status) {
                // Tambahkan opsi subkategori berdasarkan respons dari server
                $.each(response.data, function(key, value) {

                    $(el).append('<option value="' + value
                        .tblizinpermohonan_id + '">' + value.tblizinpermohonan_nama +
                        '</option>');
                });
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}



function permohonan_dinamis_2(id, el, id_permohonan) {


    $(el).find('option').not(':first').remove();
    $.ajax({
        url: "<?php echo site_url($path . '/get_permohonan_where_not_in') ?>", // Ganti dengan URL yang sesuai
        type: 'POST',
        data: {
            id_izin: id,
            id_permohonan: id_permohonan,
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.status) {
                // Tambahkan opsi subkategori berdasarkan respons dari server
                $.each(response.data, function(key, value) {

                    $(el).append('<option value="' + value
                        .tblizinpermohonan_id + '">' + value.tblizinpermohonan_nama +
                        '</option>');
                });

                if (id_permohonan) {
                    $('#tblizinpermohonan_id').val(id_permohonan);
                }
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function locations() {
    window.location.href = '<?= site_url($url) ?>';

}


$('#id_izin').change(function() {
    permohonan_dinamis($(this).val(), '#id_permohonan');
});

$('#tblizin_id').change(function() {

    permohonan_dinamis_2($(this).val(), '#tblizinpermohonan_id', $('#tblizinpermohonan_id_').val());
});


$('.form').submit(function(event) {


    event.preventDefault();

    var formData = new FormData(this);
    $.ajax({
        url: '<?php echo site_url($path . '/form') ?>', // Ganti dengan URL endpoint pengunggahan file dan data POST di server Anda
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.status) {
                success(response.msg);
                setTimeout(locations, 1000);
            } else {
                error(response.msg)
            }


        },
        error: function(xhr, status, error) {
            // Penanganan kesalahan jika pengunggahan gagal
            console.log(xhr.responseText);
        }
    });
});

$('.form-update').submit(function(event) {


    event.preventDefault();

    var formData = new FormData(this);


    $.ajax({
        url: '<?php echo site_url($path . '/form_update') ?>', // Ganti dengan URL endpoint pengunggahan file dan data POST di server Anda
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.status) {
                success(response.msg);
                setTimeout(locations, 1000);
            } else {
                error(response.msg)
            }
        },
        error: function(xhr, status, error) {
            // Penanganan kesalahan jika pengunggahan gagal
            console.log(xhr.responseText);
        }
    });
});
</script>