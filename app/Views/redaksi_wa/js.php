<script src="<?= base_url() ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>

<script>
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
        $('.testing').prop('disabled', true);
        html =
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Tunggu sebentar...'
        $('.testing').html(html);
    } else {

        $('.testing').prop('disabled', false);
        html = 'Testing'
        $('.testing').html(html);

    }
}


// Listen for the form's submit event
$('.form').submit(function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the form data
    const formData = $(this).serialize();
    $.ajax({
        data: formData,
        type: "POST",
        dataType: 'json',
        url: "<?= site_url($path . '/form') ?>",
        beforeSend: function() {

            loading_button(true);
        },
        success: function(response) {
            if (response.status) {

                success(response.msg);
                loading_button(false);

            } else {
                error(response.msg);
                loading_button(false);
            }

        },
        error: function() {
            // Menyembunyikan elemen loading jika terjadi kesalahan
            error('Terjadi kesalahan');
            loading_button(false);
        }
    });

});

$('.testing').click(function() {
    const formData = $('.form').serialize();

    $.ajax({
        data: formData,
        type: "POST",
        dataType: 'json',
        url: "<?= site_url($path . '/form_testing') ?>",
        beforeSend: function() {

            loading_button2(true);
        },
        success: function(response) {
            if (response.status) {

                success(response.msg);
                loading_button2(false);

            } else {
                error(response.msg);
                loading_button2(false);
            }

        },
        error: function() {
            // Menyembunyikan elemen loading jika terjadi kesalahan
            error('Terjadi kesalahan');
            loading_button(false);
        }
    });
})
</script>