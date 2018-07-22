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

    <title>CRUD - Profil</title>
    <?php include '/../../assetCss.php';?>

    <!-- DataTables CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/1.0.6/css/dataTables.responsive.css" rel="stylesheet">

</head>

<style type="text/css">
#preview
{
    margin-top: 10px;
    margin-bottom: 20px;
    width: 100%;
    height: 100%;
}

b.label-addon
{
    width: 9em;
    display: block;
    text-align: left;
}

.form-view
{
    border: none;
    border-bottom: 1px solid #CCC;
    box-shadow: none;
}

.input-group #namaLengkap,
.input-group #jk
{
    text-transform: capitalize;
}

.form-label
{
    border: none;
    border-bottom: 1px solid #CCC;
    border-radius: 0px;
    background: none;
}

.pd-right-10
{
    padding-right: 10px;
}
</style>

<body>
    <div id="wrapper">
        <?php include '/../../navigasi.php';?>
        <div class="notif"></div>

        <div id="page-wrapper">
            <div class="row" style="margin-top: 2.4em">
                <div class="col-lg-12">
                    <h3 class="page-header">
                        Profil
                    </h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Data Anda
                            <div class="float-right" style="margin-top: -4px">
                                <a href="<?php echo site_url('index.php/profil/ubah/user/').$this->session->userdata('id_pengguna')?>">
                                    <button class="btn btn-primary" style="border: none; margin-top: -2px">
                                        <i class="fa fa-fw fa-edit"></i> Sunting
                                    </button>
                                </a>
                            </div>
                        </div>

                        <form class="panel-body" role="form" action="<?php echo site_url('index.php/profil/submit')?>"  enctype="multipart/form-data" method="post">

                            <div class="col-md-4">
                                <img id="preview" class="img-responsive img-thumbnail">
                            </div>

                            <ul class="nav nav-pills col-md-8 small" style="margin-top: 10px; padding-bottom: 15px; ">
                                <li class="active">
                                    <a href="#profil-pills" data-toggle="tab">Profil</a>
                                </li>
                                <li>
                                    <a href="#akun-pills" data-toggle="tab">Akun</a>
                                </li>
                            </ul>

                            <div class="tab-content col-md-7 form-horizontal">
                                <div class="tab-pane fade in active" id="profil-pills">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="input-group-addon form-label">
                                                <b class="label-addon">
                                                    Nama Lengkap
                                                </b>
                                            </label>
                                            <text class="form-control form-view" id="namaLengkap">
                                                <b class="pd-right-10">:</b>
                                            </text>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="input-group-addon form-label">
                                                <b class="label-addon">
                                                    Jenis Kelamin 
                                                </b>
                                            </label>
                                            <text class="form-control form-view" id="jk">
                                            </text>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="input-group-addon form-label">
                                                <b class="label-addon">
                                                    Tanggal Lahir
                                                </b>
                                            </label>
                                            <text class="form-control form-view" id="lahir">
                                            </text>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="akun-pills">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="input-group-addon form-label">
                                                <b class="label-addon">
                                                    Email 
                                                </b>
                                            </label>
                                            <text class="form-control form-view" id="email">
                                            </text>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <label class="input-group-addon form-label">
                                                <b class="label-addon">
                                                    Nama Pengguna
                                                </b>
                                            </label>
                                            <text class="form-control form-view" id="namaPengguna">
                                            </text>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-danger btn-sm float-right" data-target="#konfirm" data-toggle="modal">
                                        <i class="fa fa-fw fa-trash"></i> Hapus Akun 
                                    </button>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="konfirm" class="modal fade in" role="form">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="panel-red">
                    <h4 class="panel-heading">
                        Konfirmasi Hapus Akun
                    </h4>
                    <div class="panel-body" style="margin-bottom: 10px;">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class=" col-md-8">
                                <form role="form" action="<?php echo site_url('index.php/profil/hapus/id/'.$this->session->userdata('id_pengguna').'/').$this->session->userdata('img')?>" method="post">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user fa-fw"></i>
                                            </span>
                                            <input type="text" class="form-control" name="nama_pengguna" placeholder="Masukan Nama Pengguna" minlength="5" maxlength="40" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock fa-fw"></i>
                                            </span>
                                            <input type="password" class="form-control" name="sandi" placeholder="Masukan Sandi" minlength="5" maxlength="20" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock fa-fw"></i>
                                            </span>
                                            <input type="password" class="form-control" name="confirm_sandi" placeholder="Masukan Ulang Sandi" minlength="5" maxlength="20" required>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-default col-md-5" data-dismiss="modal">
                                        <i class="fa fa-fw fa-close"></i> Batal
                                    </button>
                                    <div class="col-md-2"></div>
                                    <button type="submit" class="btn btn-danger col-md-5">
                                        <i class="fa fa-fw fa-check"></i> Hapus
                                    </button>
                                </form>
                            </div>
                            <div class="col-md-2"></div>
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
    display_session();
    function display_session()
    {
        $.ajax(
        {
            url   : '<?php echo base_url()?>index.php/profil/tampil/display_session',
            type  : 'ajax',
            dataType : 'json',
            success : function(data)
            {
                $('img#preview').attr('src','<?php echo site_url('assets/img/')?>'+data.photo);
                $('text#namaLengkap').html('<b class="pd-right-10">:</b>'+data.nama_lengkap);
                $('text#jk').html('<b class="pd-right-10">:</b>'+data.jenis_kelamin);
                $('text#lahir').html('<b class="pd-right-10">:</b>'+data.tgl_lahir);
                $('text#email').html('<b class="pd-right-10">:</b>'+data.email);
                $('text#namaPengguna').html('<b class="pd-right-10">:</b>'+data.nama_pengguna);
            }
        });
    }
});
</script>