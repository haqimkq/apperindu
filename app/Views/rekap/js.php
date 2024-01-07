<script src="<?= base_url() ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<!-- <script src="assets/js/form-select2.js"></script> -->
<script>
$(document).ready(function() {

    $('.hide').hide();
    $('.filter-select, .single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
            'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });


});

function downloadFile(url, name) {

    var xhr = new XMLHttpRequest();
    xhr.open('GET', url, true);
    xhr.responseType = 'blob';

    xhr.onload = function() {
        if (xhr.status === 200) {
            // Membuat URL objek dari respon blob
            var url = window.URL.createObjectURL(xhr.response);

            // Membuat elemen anchor untuk mengunduh file
            var link = document.createElement('a');
            link.href = url;
            link.download = name;
            link.style.display = 'none';
            document.body.appendChild(link);

            // Mengklik elemen anchor untuk memulai unduhan
            link.click();

            // Menghapus elemen anchor dari dokumen
            document.body.removeChild(link);

            // Merevokasi URL objek setelah selesai diunduh
            window.URL.revokeObjectURL(url);
        }
    };

    xhr.send();
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

function kelurahan_dinamis(id, el, select) {

    $(el).find('option').not(':first').remove();
    $.ajax({
        url: "<?php echo site_url('pendaftaran/get_kelurahan_by_id_kecamatan_json') ?>", // Ganti dengan URL yang sesuai
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




$('#id_izin').change(function() {


    permohonan_dinamis($(this).val(), '#id_permohonan');


});

$('#tblkecamatan_id').change(function() {
    kelurahan_dinamis($(this).val(), '#tblkelurahan_id');
});

function loading_button2(status) {
    if (status) {
        $('.tte').prop('disabled', true);
        html =
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Tunggu sebentar...'
        $('.tte').html(html);
    } else {

        $('.tte').prop('disabled', false);
        html = '<i class="bi bi-pencil-square"></i> Tanda Tangani'
        $('.tte').html(html);

    }
}
</script>