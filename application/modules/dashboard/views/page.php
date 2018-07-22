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

    <title>CRUD - Dashboard</title>
    <?php include '/../../assetCss.php';?>
</head>

<style type="text/css">
.user-row
{
    margin-bottom: 14px;
}

.user-row:last-child
{
    margin-bottom: 0;
}

.dropdown-user
{
    margin: 13px 0;
    padding: 5px;
    height: 100%;
}

.dropdown-user:hover
{
    cursor: pointer;
}

.table-user-information > tbody > tr
{
    border-top: 1px solid rgb(221, 221, 221);
}

.table-user-information > tbody > tr:first-child
{
    border-top: 0;
}


.table-user-information > tbody > tr > td
{
    border-top: 0;
}

.toppad
{
    margin-top:20px;
}

#kosong
{
    display: none;
}
</style>

<body>
    <div id="wrapper">
        <?php include '/../../navigasi.php';?>
        <div class="notif"></div>

        <div id="page-wrapper">
            <div class="row" style="margin-top: 2.4em">
                <div class="col-lg-12">
                    <h3 class="page-header">Dashboard</h3>
                </div>
            </div>

            <div class="alert alert-danger" id="kosong">
                <i class="fa fa-fw fa-warning"></i>
                Tidak Terdapat Data Pada Tabel.
            </div>
            <div class="row user-card" id="card"></div>

            <button type="button" id="btn-lainnya" class="btn btn-block btn-primary" style="margin-bottom: 30px" onclick="window.location='<?php echo site_url('index.php/tabel/tampil')?>';">
                Lihat Lainnya
            </button>
        </div>
    </div>

    <div id="detail" class="modal fade in" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="panel-primary">
                    <h4 class="panel-heading">
                        Detail Pengguna
                        <button class="btn btn-primary float-right" type="button" onClick="reset();" data-dismiss="modal" style="border: none; margin-top: -5px">
                            <i class="fa fa-fw fa-close"></i>
                        </button>
                    </h4>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center">
                                <img id="photo" class="img-circle img-responsive" style="margin-bottom: 40px;">
                            </div>

                            <div class=" col-md-9 col-lg-9 "> 
                                <table class="table table-user-information">
                                    <tbody>
                                        <tr>
                                            <td>Nama Lengkap</td><td>:</td>
                                            <td id="nama_lengkap"></td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td><td>:</td>
                                            <td id="jenis_kelamin"></td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir</td><td>:</td>
                                            <td id="tgl_lahir"></td>
                                        </tr>
                                        <tr>
                                            <td>Nama Pengguna</td><td>:</td>
                                            <td id="nama_pengguna"></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td><td>:</td>
                                            <td><a id="email"></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer"></div>
                </div>
            </div>
        </div>
    </div>

    <?php include '/../../assetJs.php';?>
    <?php include '/../../notif.php';?>
</body>
</html>

<script type="text/javascript">
$(document).ready(function()
{
    display_pengguna();
    function display_pengguna()
    {
        $.ajax(
        {
            url   : '<?php echo base_url()?>index.php/dashboard/page/display_pengguna',
            type  : 'ajax',
            dataType : 'json',
            success : function(data)
            {
                if(data.length == 0)
                {
                    $('#kosong').show();
                    $('#btn-lainnya').hide();
                }
                else
                {
                    var card = "";
                    var i;
                    for(i = 0; i < data.length; i++)
                    {
                        card += "<div class='col-md-3'>";
                            card+="<div class='panel panel-primary'>";
                                card+="<div class='panel-heading'>";
                                    card+="<center>";
                                        card+="<b>"+data[i].nama_pengguna+"</b>";
                                    card+="</center>";
                                card+="</div>";

                                card+="<div class='panel-body' style='margin-bottom: -20px'>";
                                    card+="<div class='col-md-2'></div>";
                                    card+="<div class='image col-md-8'>";
                                        card+="<img src='<?php echo site_url('assets/img/')?>"+data[i].photo+"' class='img-responsive img-thumnail'>";
                                    card+="</div>";
                                    card+="<div class='col-md-2'></div>";
                                card+="</div>";
                                card+="<div class='panel-body text-center' style='margin-top: -10px'>";
                                    card+="<h4>";
                                        card+="<a href='javascript()' data-toggle='modal' data-target='#detail' id='nama' data='"+data[i].id+"'>"+data[i].nama_lengkap+"</a>";
                                    card+="</h4>";
                                    card+="<text>"+data[i].email+"</text>";
                                card+="</div>";
                            card+="</div>";
                        card+="</div>";
                    }
                    $('#btn-lainnya').show();
                    $("#card").html(card);
                }
            }
        });
    }

    $(document).on('click','#nama',function()
    {
        var id = $(this).attr('data');
        $.ajax(
        {
            url: '<?php echo base_url('index.php/dashboard/page/display_detail')?>',
            type: 'GET',
            dataType: 'json',
            data: {id:id},
            success: function(data)
            {
                $.each(data,function()
                {
                    $('img#photo').attr('src','<?php echo site_url('assets/img/')?>'+data.photo);
                    $('#nama_lengkap').text(data.nama_lengkap);
                    $('#jenis_kelamin').text(data.jenis_kelamin);
                    $('#tgl_lahir').text(data.tgl_lahir);
                    $('#nama_pengguna').text(data.nama_pengguna);
                    $('#email').attr('src','mail:'+data.email);
                    $('#email').text(data.email);
                });
            }
        });
        return false;
    });
});
</script>