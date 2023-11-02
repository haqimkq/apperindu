<script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/plugins/select2/js/select2.min.js"></script>
<!-- <script src="assets/js/form-select2.js"></script> -->
<script>
$(document).ready(function() {
    datatable();

    $('.filter-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
            'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
});

function datatable() {
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
        // stateSave: bool,
        // processing: true, //Feature control the processing indicator.
        // serverSide: true, //Feature control DataTables' server-side processing mode.
        // order: [], //Initial no order.

        // // Load data for the table's content from an Ajax source
        // ajax: {
        //     url: "<?php echo site_url($url . '/get_data') ?>",
        //     data: data,
        //     type: "POST",

        // },


        // //Set column definition initialisation properties.
        // columnDefs: [{
        //     targets: [0], //first column / numbering column
        //     orderable: false, //set not orderable
        // }, ],
    });
}

function tambah() {

    $('.single-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        dropdownParent: $("#form-modal"),
        allowClear: Boolean($(this).data('allow-clear')),
    });

    $('#form-modal').modal('show');
}

function edit() {

}

function hapus() {

}

function confirm(i) {

}

function confirm_label() {
    let l;
    l[0] = 'Yakin';
    l[1] = '';

    return l[i];
}
</script>