<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$tgl = date('d');
$bln = date('m');
$thn = date('Y');
$max = ($thn - 10);
$min = ($thn - 65);
$fix_max = $max."-".$bln."-".$tgl;
$fix_min = $min."-".$bln."-".$tgl;
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
</style>

<body>
    <div id="wrapper">
        <?php include '/../../navigasi.php';?>
        <div class="notif"></div>

        <div id="page-wrapper">
            <div class="row" style="margin-top: 2.4em">
                <div class="col-lg-12">
                    <h3 class="page-header">
                        <a href="<?php echo site_url('index.php/profil/tampil/user/').$this->session->userdata('id_pengguna')?>">
                            Profil
                        </a>
                        / Ubah Data
                    </h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Data Anda
                            <div class="float-right" style="margin-top: -4px">
                                <a href="<?php echo site_url('index.php/profil/tampil/user/').$this->session->userdata('id_pengguna')?>">
                                    <button class="btn btn-primary" style="border: none; margin-top: -2px">
                                        <i class="fa fa-fw fa-arrow-left"></i> Kembali
                                    </button>
                                </a>
                            </div>
                        </div>

                        <form class="panel-body" role="form" action="<?php echo site_url('index.php/profil/ubah/submit')?>"  enctype="multipart/form-data" method="post">
                            <?php
                            if(is_array($us) || is_object($us))
                            {
                                foreach($us as $er)
                                {
                                ?>
                            <input type="text" name="id" value="<?php echo $er['id']?>" hidden>
                            <input type="text" name="photo_awal" value="<?php echo $er['photo']?>" hidden>
                            <div class="col-md-1"></div>
                            <div class="col-md-4">
                                Photo
                                <text class="small">(max : 2mb)</text>
                                <input type="file" id="pilih" name="photo" class="form-control" accept="image/*">
                                <span class="small text-danger">
                                    <?php echo form_error('photo')?>
                                </span>
                                <img id="preview" class="img-responsive img-thumbnail" src="<?php echo site_url('assets/img/').$er['photo']?>">
                            </div>

                            <div class="col-md-6 form-horizontal" style="margin-top: 20px">
                                <div class="form-group">
                                    <div class="input-group">
                                        <label class="input-group-addon">
                                            <b class="label-addon">
                                                Nama Lengkap 
                                            </b>
                                        </label>
                                        <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukan Nama Lengkap" value="<?php echo $er['nama_lengkap']?>">
                                    </div>
                                    <text class="small text-danger">
                                        <?php echo form_error('nama_lengkap')?>
                                    </text>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label class="input-group-addon">
                                            <b class="label-addon">
                                                Jenis Kelamin 
                                            </b>
                                        </label>
                                        <select class="form-control" name="jenis_kelamin">
                                            <option id="none" value="">Pilih jenis kelamin</option>
                                            <option id="0" value="perempuan">Perempuan</option>
                                            <option id="1" value="laki-laki">Laki-Laki</option>
                                        </select>
                                    </div>
                                    <text class="small text-danger">
                                        <?php echo form_error('jenis_kelamin')?>
                                    </text>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label class="input-group-addon">
                                            <b class="label-addon">
                                                Tanggal Lahir
                                            </b>
                                        </label>
                                        <input type="date" class="form-control" name="tgl_lahir" min="<?php echo $fix_min?>" max="<?php echo $fix_max?>" value="<?php echo $er['tgl_lahir']?>">
                                    </div>
                                    <text class="small text-danger">
                                        <?php echo form_error('tgl_lahir')?>
                                    </text>
                                </div>
                                
                                <div class="form-group">
                                    <div class="input-group">
                                        <label class="input-group-addon">
                                            <b class="label-addon">
                                                Email 
                                            </b>
                                        </label>
                                        <input type="text" class="form-control" name="email" placeholder="Masukan Email" value="<?php echo $er['email']?>">
                                    </div>
                                    <text class="small text-danger">
                                        <?php echo form_error('email')?>
                                    </text>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label class="input-group-addon">
                                            <b class="label-addon">
                                                Nama Pengguna
                                            </b>
                                        </label>
                                        <input type="text" class="form-control" name="nama_pengguna" placeholder="Masukan Nama Pengguna" value="<?php echo $er['nama_pengguna']?>">
                                    </div>
                                    <text class="small text-danger">
                                        <?php echo form_error('nama_pengguna')?>
                                    </text>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label class="input-group-addon">
                                            <b class="label-addon">
                                                Sandi Lama
                                            </b>
                                        </label>
                                        <input type="password" class="form-control" name="sandi-lm">
                                    </div>
                                    <text class="small float-right">nb : masukan sandi lama untuk konfirmasi perubahan</text>
                                    <text class="small text-danger">
                                        <?php echo form_error('sandi-lm')?>
                                    </text>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label class="input-group-addon">
                                            <b class="label-addon">
                                                Sandi Baru
                                            </b>
                                        </label>
                                        <input type="password" class="form-control" name="sandi-br">
                                    </div>
                                    <text class="small float-right">nb : kosongkan jika sandi tidak diubah</text>
                                    <text class="small text-danger">
                                        <?php echo form_error('sandi-br')?>
                                    </text>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <label class="input-group-addon">
                                            <b class="label-addon">
                                                Ulangi Sandi Baru
                                            </b>
                                        </label>
                                        <input type="password" class="form-control" name="confirm_sandi">
                                    </div>
                                    <text class="small float-right">nb : kosongkan jika sandi tidak diubah</text>
                                    <text class="small text-danger">
                                        <?php echo form_error('confirm_sandi')?>
                                    </text>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm float-right" style="margin-left: 0.4em;">
                                        <i class="fa fa-fw fa-save"></i> Simpan
                                    </button>
                                    <button type="reset" class="btn btn-danger btn-sm float-right">
                                        <i class="fa fa-fw fa-undo"></i> Reset
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                                <?php
                                }
                            }
                            ?>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include '/../../assetJs.php';?>
    <?php include '/../../notif.php';?>
</body>
</html>

<script type="text/javascript">
$(document).ready( function()
{
    function readURL(input)
    {
        if (input.files && input.files[0])
        {
            var reader = new FileReader();
            reader.onload = function (e)
            {
                $("img#preview").attr('src', e.target.result);
                $("img#preview").show();
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
        
    $("#pilih").change(function()
    {
        readURL(this);
    });

    $("button[type='reset']").click(function()
    {
        $("img#preview").attr('src','<?php echo site_url('assets/img/'.$er['photo'])?>');
    });
});
</script>

<?php
if(is_array($us) || is_object($us))
{
    foreach($us as $er)
    {
        if($er['jenis_kelamin'] == 'perempuan')
        {
            ?>
            <script>
            $('option#0').attr('selected',true);
            </script>
            <?php
        }
        elseif($er['jenis_kelamin'] == "laki-laki")
        {
            ?>
            <script type="text/javascript">
            $('option#1').attr('selected',true);
            </script>
            <?php
        }
        else
        {
            ?>
            <script type="text/javascript">
            $('option#none').attr('selected',true);
            </script>
            <?php
        }
    }
}
?>
