<script src="<?= base_url() ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.min.js"></script>
<!-- <script src="assets/js/form-select2.js"></script> -->
<script>
$(document).ready(function() {
    datatable(true);


    $('.hide').hide();


    $('.filter-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
            'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });

    var id = $('#id').val();

    if (id) {
        update(id)
    }

    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
            'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });


});

function datatable(bool) {

    let data = {
        tblkendalibloksistem_id: $('#id_blok_sistem').val(),
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
            orderable: true, //set not orderable
        }, ],
    });
}



function update(id) {


    var input = ['tblpengguna_nama', 'tblpengguna_unitkerja', 'tblkendalibloksistem_id', 'username',
        'tblpengguna_isaktif'
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


function edit_password(id) {


    $('.form-edit-password').trigger('reset');
    $('#id-edit-password').val(id);
    $('#form-modal').modal('show');

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

function username_check(id, username) {

    return new Promise(function(resolve, reject) {
        $.ajax({
            data: {
                id: id,
                username: username,
                '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
            },
            type: "POST",
            dataType: 'json',
            url: "<?= site_url($path . '/username_check') ?>",
            success: function(response) {

                if (response.status) {
                    resolve(true);
                } else {
                    resolve(false);
                }

            }
        });
    });

}




function validatePassword(password) {
    // Define the regular expressions for each password rule
    const minLengthRegex = /.{6,}/; // Minimum 6 characters
    const uppercaseRegex = /[A-Z]/; // At least one uppercase letter
    const digitRegex = /[0-9]/; // At least one digit
    const specialCharRegex = /[$@$!%*?&]/; // At least one special character

    // Check if the password satisfies all the rules
    const isMinLengthValid = minLengthRegex.test(password);
    const isUppercaseValid = uppercaseRegex.test(password);
    const isDigitValid = digitRegex.test(password);
    const isSpecialCharValid = specialCharRegex.test(password);

    // Return true if all rules are satisfied, false otherwise
    return (
        isMinLengthValid &&
        isUppercaseValid &&
        isDigitValid &&
        isSpecialCharValid
    );
}

function locations() {
    window.location.href = '<?= site_url('pengguna') ?>';

}




// Listen for the form's submit event
$('.form').submit(function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the form data
    const formData = $(this).serialize();



    var el = 'username';
    var username = $('#' + el).val();

    username_check(null, username).then(function(status) {
            if (!status) {

                $('.' + el + '_validation').show();
                return false;
            } else {
                $('.' + el + '_validation').hide();
                var el2 = 'tblpengguna_password';
                var password = $('#' + el2).val();
                if (!validatePassword(password)) {

                    $('.' + el2 + '_validation').show();
                    return false;
                } else {
                    $('.' + el2 + '_validation').hide();
                }

                var el3 = 'pwconfirm';
                var password_confirm = $('#' + el3).val();
                if (password != password_confirm) {

                    $('.' + el3 + '_validation').show();
                    return false;
                } else {
                    $('.' + el3 + '_validation').hide();
                }

                $.ajax({
                    data: formData,
                    type: "POST",
                    dataType: 'json',
                    url: "<?= site_url($path . '/form') ?>",
                    success: function(response) {
                        if (response.status) {

                            success(response.msg);
                            setTimeout(locations, 1000);

                        }

                    }
                });
            }
        })
        .catch(function(error) {

        });


});

$('.form_update').submit(function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the form data
    const formData = $(this).serialize();


    var id = $('#id').val();
    var el = 'username';
    var username = $('#' + el).val();

    username_check(id, username).then(function(status) {
            if (!status) {

                $('.' + el + '_validation').show();
                return false;
            } else {
                $('.' + el + '_validation').hide();

                $.ajax({
                    data: formData,
                    type: "POST",
                    dataType: 'json',
                    url: "<?= site_url($path . '/form_update') ?>",
                    success: function(response) {
                        if (response.status) {

                            success(response.msg);
                            setTimeout(locations, 1000);

                        }

                    }
                })
            }
        })
        .catch(function(error) {

        });


    ;
});


$('.form-edit-password').submit(function(event) {
    event.preventDefault(); // Prevent the default form submission
    const formData = $(this).serialize();
    var el2 = 'tblpengguna_password';
    var password = $('#' + el2).val();
    if (!validatePassword(password)) {

        $('.' + el2 + '_validation').show();
        return false;
    } else {
        $('.' + el2 + '_validation').hide();
    }

    var el3 = 'pwconfirm';
    var password_confirm = $('#' + el3).val();
    if (password != password_confirm) {

        $('.' + el3 + '_validation').show();
        return false;
    } else {
        $('.' + el3 + '_validation').hide();
    }

    $.ajax({
        data: formData,
        type: "POST",
        dataType: 'json',
        url: "<?= site_url($path . '/form_update_password') ?>",
        success: function(response) {
            if (response.status) {
                $('#form-modal').modal('hide');
                success(response.msg);
                datatable(true);

            } else {
                $('#form-modal').modal('hide');
                error(response.msg);
                datatable(true);
            }

        }
    });


});



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