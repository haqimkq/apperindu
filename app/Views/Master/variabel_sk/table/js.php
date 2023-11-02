<script>
$('#add').click(function() {
    var html = form_table();

    var box = $('.box-table');
    $(html).appendTo(box);
})

$("body").on("click", ".remove", function() {
    $(this).parents(".control-group").remove();
});

function form_table() {
    var html = '';
    html += ' <div class="row control-group">';
    html += '     <div class="col-md-4 md-4 mb-3">';
    html += '         <div class="form-group">';
    html += '             <label for="" class="mb-1">Nama kolom</label>';
    html +=
        '             <input type="text" class="form-control" oninput="replaceSpacesWithUnderscores(this)" name="nama_kolom[]" required> ';
    html += '         </div>';
    html += '       </div>';
    html += '        <div class="col-md-3 md-4 mb-3">';
    html += '            <div class="form-group">';
    html += '                <label for="" class="mb-1">Tipe data</label>';
    html += '                <select name="tipe_data[]" class="form-control" required>';
    html += '                     <option value="">pilih</option>';
    <?php foreach (data_type_arr() as $key => $row) : ?>
    html += '                     <option value="<?= $key ?>">';
    html += '<?= $row ?>';
    html += '  </option>';
    <?php endforeach ?>
    html += '            </select>';
    html += '         </div>';
    html += '        </div>';
    html += '            <div class="col-md-3 md-4 mb-3">';
    html += '            <div class="form-group">';
    html += '                <label for="" class="mb-1">Panjang</label>';
    html += '                <input type="number" class="form-control" name="panjang[]" max="225"> ';
    html += '             </div>';
    html += '          </div>';
    html += '           <div class="col-md-2 md-4 mb-3">';
    html +=
        ' <button type="button" class="btn btn-sm btn-outline-danger remove mt-4"> Hapus</button>';
    html += '               </div>';
    html += '            </div>';
    return html;
}

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

            console.log(response);
            loading_button(false);
            if (response.status) {
                success(response.msg);
                setTimeout(function() {
                    history.back()
                }, 1000);
            } else {
                error(response.msg);
            }
        },
        error: function() {
            loading_button(false);
            error('Terjadi kesalahan');

        }
    });

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


$('#nama_tabel').on('input', function() {
    var inputValue = $(this).val(); // Mendapatkan nilai input

    // Mengganti spasi dengan underscore
    var modifiedValue = inputValue.replace(/ /g, '_');

    // Menetapkan kembali nilai input yang telah dimodifikasi
    $(this).val(modifiedValue);
});


$('#nama_kolom').on('input', function() {
    var inputValue = $(this).val(); // Mendapatkan nilai input

    // Mengganti spasi dengan underscore
    var modifiedValue = inputValue.replace(/ /g, '_');

    // Menetapkan kembali nilai input yang telah dimodifikasi
    $(this).val(modifiedValue);
});

function replaceSpacesWithUnderscores(inputElement) {

    var inputValue = inputElement.value;
    var modifiedValue = inputValue.replace(/ /g, '_');
    inputElement.value = modifiedValue;
}
</script>