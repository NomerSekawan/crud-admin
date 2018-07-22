<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CRUD - Tabel</title>
    <?php include '/../../assetCss.php';?>

    <!-- DataTables CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css" rel="stylesheet">
</head>

<style type="text/css">
.dataTables_paginate ul.pagination .active
{
    background: red !important;
}
</style>
<body>
    <div id="wrapper">
        <?php include '/../../navigasi.php';?>
        <div class="notif"></div>

        <div id="page-wrapper">
            <div class="row" style="margin-top: 2.4em">
                <div class="col-lg-12">
                    <h3 class="page-header">Tabel</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            List Data User
                            <div class="float-right" style="margin-top: -4px">
                                <a href="<?php echo site_url('index.php/tabel/tambah')?>">
                                    <button class="btn btn-primary" style="border: none; margin-top: -2px">
                                        <i class="fa fa-fw fa-plus"></i> Tambah
                                    </button>
                                </a>
                            </div>
                        </div>

                        <div class="panel-body">
                            <table width="100%" class="table table-bordered table-hover" id="dataTables-user">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Lengkap</th>
                                        <th>Nama Pengguna</th>
                                        <th>Email</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="konfirm" class="modal fade in" role="form">
        <div class="modal-dialog">
            <div class="modal-content konten-hapus" style="width: 400px; left: -200px; margin-left: 50%;">
                <div class="panel-red">
                    <h4 class="panel-heading">Konfirmasi Hapus Data</h4>
                    <div class="panel-body">
                        <text class="text-muted teks"></text><br>
                        <div class="text-right" style="margin-top: 20px">
                            <button class="btn btn-default btn-sm pl-3 pr-3" type="button" onClick="reset();" data-dismiss="modal">
                                <i class="fa fa-fw fa-remove"></i>  Batal
                            </button>
                            <button class="btn btn-danger btn-sm pl-3 pr-3 iya" type="button">
                                <i class="fa fa-fw fa-check"></i>  Ya
                            </button>
                        </div>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>
        </div>
    </div>

    <?php include '/../../assetJs.php';?>

    <!-- DataTables JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.6/js/dataTables.responsive.min.js"></script>

    
    <?php include '/../../notif.php';?>
</body>
</html>

<script>
$(document).ready(function()
{
    var tb = $("#dataTables-user").DataTable(
    {
        responsive: true,
        "language":
        {
            "emptyTable": "<text class='text-danger'>Tidak terdapat data pada tabel</text>",
            "lengthMenu": "Tampilkan _MENU_ data",
            "search": "Cari :",
            "zeroRecords": "<text class='text-danger'>Tidak ada data yang ditemukan</text>",
            "info": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
            "infoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
            "paginate":
            {
                "sFirst": "<i class='fa fa-angle-double-left'></i>",
                "sLast": "<i class='fa fa-angle-double-right'></i>",
                "sPrevious": "<i class='fa fa-angle-left'></i>",
                "sNext": "<i class='fa fa-angle-right'></i>"
            }
        },
        "paginationType":"full_numbers",
        "ajax":
        {
            "url": "<?php echo site_url('index.php/tabel/tampil/display_pengguna')?>",
            "dataSrc": ""
        },
        "columnDefs": [
        {
            "targets": 0,
            "searchable": false,
            "orderable": false,
            "className": "text-center"
        },
        {
            "targets": -1,
            "searchable": false,
            "orderable": false,
            "className": "text-right",
            "defaultContent":
                '<div class="btn-group">'+ 
                    '<button class="btn btn-danger btn-sm hapus" data-toggle="modal" data-target="#konfirm">'+
                        '<i class="fa fa-fw fa-trash"></i>'+
                    '</button>'+
                    '<button class="btn btn-primary btn-sm ubah">'+
                        '<i class="fa fa-fw fa-edit"></i>'+
                    '</button>'+
                '</div>',
        }],
        "columns": [
            { "data": null },
            { "data": "nama_lengkap" },
            { "data": "nama_pengguna" },
            { "data": "email" },
            { "data": null },
        ],
        "order": [[1, 'asc']]
    });

    tb.on('order.dt search.dt', function()
    {
        tb.column(0, {search:'applied', order:'applied'}).nodes().each(function(cell, i)
        {
            cell.innerHTML = i+1;
        });
    });

    $("#dataTables-user tbody").on("click",'.hapus',function()
    {
        var row = tb.row($(this).parents('tr')).data();
        var id = row[Object.keys(row)[0]];
        var nama = '"'+row[Object.keys(row)[1]]+'"';
        var img = row[Object.keys(row)[6]];

        $("text.teks").text("Anda yakin menghapus data dengan nama pengguna "+nama+" ?");
        $(document).on("click",'.iya',function()
        {
            window.location="<?php echo site_url('index.php/tabel/hapus/id/')?>"+id+"/"+img;
        });
    });

    $("#dataTables-user tbody").on("click",'.ubah',function()
    {
        var row = tb.row($(this).parents('tr')).data();
        var id = row[Object.keys(row)[0]];
        window.location="<?php echo site_url('index.php/tabel/ubah/user/')?>"+id;
    });
});
</script>
