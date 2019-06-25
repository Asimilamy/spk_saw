<?php
$view = isset($view)? $view : 'home' ;
?>

<div class="table-responsive">
    <table id="dataTable" class="table table-bordered table-striped table-hover" style="width: 100%;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Options</th>
                <th>Kode</th>
                <th>Name</th>
                <th>Attribute</th>
                <th>Type</th>
                <th>Weight (%)</th>
            </tr>
        </thead>
    </table>
</div>

<script>
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };
    var table = $('#dataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ordering" : true,
        "ajax": {
            "url" : "controllers/<?php echo $view; ?>.php",
            "type" : "GET",
            "data" : {'act' : 'get_table_data'},
        },
        "language" : {
            "lengthMenu" : "Tampilkan _MENU_ data",
            "zeroRecords" : "Maaf tidak ada data yang ditampilkan",
            "info" : "Menampilkan data _START_ - _END_",
            "infoEmpty" : "Tidak ada data yang ditampilkan",
            "search" : "Cari :",
            "loadingRecords": "Memuat Data...",
            "processing":     "Sedang Memproses...",
            "infoFiltered": "(Difilter dari _MAX_ total data)",
            "paginate": {
                "first":      '<span class="glyphicon glyphicon-fast-backward"></span>',
                "last":       '<span class="glyphicon glyphicon-fast-forward"></span>',
                "next":       '<span class="glyphicon glyphicon-forward"></span>',
                "previous":   '<span class="glyphicon glyphicon-backward"></span>'
            }
        },
        "columnDefs": [
            {"targets": 0, "searchable": false, "orderable": false, "data": null},
            {"targets": 1, "searchable": false, "orderable": false},
            {"targets": 2, "searchable": false, "visible": false},
        ],
        "order": [2, 'asc'],
        "rowCallback": function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });
</script>
