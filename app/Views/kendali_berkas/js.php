<script src="<?= base_url() ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>


<script>
$(document).ready(function() {



    $('.filter-select, .single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
            'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });

    // $('.single-select').select2({
    //     theme: 'bootstrap4',
    //     width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
    //     placeholder: $(this).data('placeholder'),
    //     allowClear: Boolean($(this).data('allow-clear')),
    // });

    datatable(true);


});

function datatable(bool) {

    let data = {
        tblizin_id: $('#id_izin').val(),
        tblizinpermohonan_id: $('#id_permohonan').val(),
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
        stateSave: bool,
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        order: [], //Initial no order.

        // Load data for the table's content from an Ajax source
        ajax: {
            url: "<?php echo site_url('kendali_berkas/get_data') ?>",
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


function permohonan_dinamis(id, el) {

    $(el).find('option').not(':first').remove();
    $.ajax({
        url: "<?php echo site_url('pendaftaran/get_permohonan_by_id_izin_json') ?>", // Ganti dengan URL yang sesuai
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


$('.filter-select').change(function() {
    datatable(false);
})

$('#id_izin').change(function() {


    permohonan_dinamis($(this).val(), '#id_permohonan');


});
</script>