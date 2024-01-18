<script src="<?= base_url() ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<!-- <script src="assets/js/form-select2.js"></script> -->
<script>
$(document).ready(function() {


    var id_pemohon = $('#tblpemohon_id').val();
    var id_pendaftaran = $('#tblizinpendaftaran_id').val();

    if (id_pemohon) {
        load_pemohon(id_pemohon);
    } else if (id_pendaftaran) {
        update(id_pendaftaran);
    } else {
        datatable(true);
    }


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
        tblizinpermohonan_id: $('#id_permohonan').val(),
        '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
    }
    $('.table-pendaftaran').DataTable({
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


function load_pemohon(id) {

    $.ajax({
        data: {
            id: id,
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        },
        type: "POST",
        dataType: 'json',
        url: "<?= site_url($path . '/get_pemohon') ?>",
        success: function(response) {
            if (response.status) {
                let data = response.data;

                $('#tblizinpendaftaran_idpemohon').val(data['tblpemohon_noidentitas']);
                $('#tblizinpendaftaran_namapemohon').val(data['tblpemohon_nama']);
                $('#tblizinpendaftaran_almtpemohon').val(data['tblpemohon_alamat']);
                $('#tblizinpendaftaran_npwp').val(data['tblpemohon_npwp']);
                $('#tblizinpendaftaran_telponpemohon').val(data['tblpemohon_telpon']);

                $('.single-select').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass(
                        'w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            }



        }
    });



}

function update(id) {


    var input = ['tblizinpendaftaran_idpemohon', 'tblizinpendaftaran_namapemohon', 'tblizinpendaftaran_almtpemohon',
        'tblizinpendaftaran_npwp', 'tblizinpendaftaran_telponpemohon', 'tblizin_id', 'tblizinpendaftaran_usaha',
        'tblkecamatan_id', 'tblizinpendaftaran_lokasiizin', 'tblizinpendaftaran_keterangan', 'tblpemohon_id'
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

                permohonan_dinamis(data['tblizin_id'], '#tblizinpermohonan_id', data[
                    'tblizinpermohonan_id']);

                kelurahan_dinamis(data['tblkecamatan_id'], '#tblkelurahan_id', data[
                    'tblkelurahan_id']);

                persyaratan_dinamis(data['tblizinpermohonan_id'], id);

                $('.single-select').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass(
                        'w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
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

function loading_button(status) {
    if (status) {
        $('.simpan').prop('disabled', true);
        html =
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Tunggu sebentar...'
        $('.simpan').html(html);
    } else {

        $('.simpan').prop('disabled', false);
        html =
            'Simpan'
        $('.simpan').html(html);

    }
}

function permohonan_dinamis(id, el, select = null) {

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

                if (select) {
                    $(el).val(select);
                }
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function kelurahan_dinamis(id, el, select) {

    $(el).find('option').not(':first').remove();
    $.ajax({
        url: "<?php echo site_url($path . '/get_kelurahan_by_id_kecamatan_json') ?>", // Ganti dengan URL yang sesuai
        type: 'POST',
        data: {
            id_kecamatan: id,
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            if (response.status) {
                // Tambahkan opsi subkategori berdasarkan respons dari server
                $.each(response.data, function(key, value) {

                    $(el).append('<option value="' + value
                        .tblkelurahan_id + '">' + value.tblkelurahan_nama +
                        '</option>');
                });

                if (select) {
                    $(el).val(select);
                }
            }
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

$('#tblizin_id').change(function() {
    permohonan_dinamis($(this).val(), '#tblizinpermohonan_id');
});


$('#tblkecamatan_id').change(function() {
    kelurahan_dinamis($(this).val(), '#tblkelurahan_id');
});


// Listen for the form's submit event
$('.form').submit(function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the form data
    var formData = new FormData(this);
    var url = '<?php echo site_url($path . '/form') ?>';
    form(formData, url);

});


$('.form-update').submit(function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the form data
    var formData = new FormData(this);
    var url = '<?php echo site_url($path . '/form_update') ?>';
    form(formData, url);

});

$('.filter-select').change(function() {
    datatable(false);

});

$('#id_izin').change(function() {
    permohonan_dinamis($(this).val(), '#id_permohonan');
});

$('#tblizinpermohonan_id').change(function() {

    persyaratan_dinamis($(this).val());
});


function persyaratan_dinamis(id) {

    var id_pendaftaran = $('#tblizinpendaftaran_id').val();
    var tblpemohon_id = $('#tblpemohon_id').val();


    $.ajax({
        url: "<?php echo site_url($path . '/get_persyaratan_form') ?>", // Ganti dengan URL yang sesuai
        type: 'POST',
        data: {
            id: id,
            id_pemohon: tblpemohon_id,
            id_pendaftaran: id_pendaftaran,
            '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
        },
        dataType: 'html',
        success: function(response) {

            $('.persyaratan').html(response);

        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

function form(data, url) {
    $.ajax({

        url: url, // Ganti dengan URL endpoint pengunggahan file dan data POST di server Anda
        type: 'POST',
        data: data,
        contentType: false,
        processData: false,
        beforeSend: function() {
            // Menampilkan elemen loading
            loading_button(true);
        },
        success: function(response) {
            if (response.status) {


                success(response.msg);

                var url = '<?= site_url('pendaftaran') ?>';
                if (response.url) {
                    url = response.url;
                }

                setTimeout(function() {
                    window.location.href = url;
                }, 2000);

            } else {
                error(response.msg);
                loading_button(false);
                // setTimeout(function() {
                //     history.back();
                // }, 2000);
            }

        },
        error: function() {
            // Menyembunyikan elemen loading jika terjadi kesalahan
            error('Terjadi kesalahan');
            loading_button(false);
            // setTimeout(function() {
            //     history.back();
            // }, 2000);
        }
    });

}
</script>