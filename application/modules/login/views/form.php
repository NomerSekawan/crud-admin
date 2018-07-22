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

    <title>CRUD - Login</title>
    <?php include '/../../assetCss.php';?>
</head>

<body>
    <div class="notif"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Silahkan Login</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?php echo site_url('index.php/login/form/submit')?>" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-user fa-fw"></i>
                                        </span>
                                        <input type="text" class="form-control" name="nama_pengguna" placeholder="Masukan Nama Pengguna" value="<?php echo set_value('nama_pengguna')?>">
                                    </div>
                                    <text class="small text-danger">
                                        <?php echo form_error('nama_pengguna')?>
                                    </text>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-lock fa-fw"></i>
                                        </span>
                                        <input type="password" class="form-control" name="sandi" placeholder="Masukan Sandi">
                                    </div>
                                    <text class="small text-danger">
                                        <?php echo form_error('sandi')?>
                                    </text>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Login</button><br>
                                <p class="help-block">Belum punya akun ? 
                                    <a href="<?php echo site_url('index.php/daftar/form')?>">Daftar</a>
                                </p>
                            </fieldset>
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
