<script src="<?= base_url() ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>



<script>
$(document).ready(function() {
    $('.detail').hide();
})

function loading_button(status) {
    if (status) {
        $('.verifikasi').prop('disabled', true);
        html =
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Tunggu sebentar...'
        $('.verifikasi').html(html);
    } else {

        $('.verifikasi').prop('disabled', false);
        html =
            'Verifikasi'
        $('.verifikasi').html(html);

    }
}
// Listen for the form's submit event
$('.form').submit(function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the form data
    var formData = new FormData(this);

    var value = ['tgl_verifikasi', 'tgl_penandatanganan', 'alasan', 'penandatangan', 'summary',
        'tblizinpendaftaran_nomor', 'tblizin_nama', 'tblizinpermohonan_nama',
        'tblizinpendaftaran_namapemohon', 'no_izin', 'dokumen'
    ];

    $.ajax({
        data: formData,
        type: "POST",
        dataType: 'json',
        contentType: false,
        processData: false,
        url: "<?= site_url($path . '/form') ?>",
        beforeSend: function() {

            loading_button(true);
        },
        success: function(response) {

            if (response.status) {

                $('.detail').show();
                value.forEach(element => {
                    $('.' + element).html(response[element]);
                });

            } else {
                error(response.msg);
                $('.detail').hide();
            }

            loading_button(false);

        },
        error: function() {
            // Menyembunyikan elemen loading jika terjadi kesalahan
            error('Terjadi kesalahan');
            loading_button(false);
            $('.detail').hide();

        }
    });




});
</script>