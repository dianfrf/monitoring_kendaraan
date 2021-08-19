<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title>Monitoring - Register User</title>
        <link rel="stylesheet" href="<?=base_url()?>Asset/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url()?>Asset/fonts/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="<?=base_url()?>Asset/css/style.min.css">
        <link rel="stylesheet" href="<?=base_url()?>Asset/css/components.min.css">
    </head>
    <body>
        <div id="app">
            <section class="section">
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="login-brand">
                                Monitoring Kendaraan
                            </div>
                            <?php if ($this->session->flashdata('pesan') != null) { ?>
                                <?php echo $this->session->flashdata('pesan');?>
                            <?php } ?>
                            <div class="card card-primary">
                                <div class="card-header"><h4>Register User</h4></div>
                                <div class="card-body">
                                    <form method="POST" action="<?=base_url('User/user_register')?>">
                                        <div class="form-group">
                                            <label for="nama_pelanggan">Nama User</label>
                                            <input type="text" class="form-control" name="nama" placeholder="Nama User" autocomplete="off">
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-6">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off">
                                            </div>
                                            <div class="form-group col-6">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Level User</label>
                                            <select class="form-control selectric" name="level_user">
                                                <option value="" disabled selected>--Pilih--</option>
                                                <option value="1">Administrator</option>
                                                <option value="2">Atasan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-primary btn-lg btn-block" name="register" value="Register">
                                        </div>
                                    </form>
                                    <div class="mt-5 text-muted text-center">
                                        Sudah punya akun? <a href="<?=base_url('')?>">Login disini!</a>
                                    </div>
                                </div>
                            </div>
                            <div class="simple-footer">
                                Copyright &copy; 2021 Dian F. Arif<div class="bullet"></div>All Rights Reserved.
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <script src="<?=base_url()?>Asset/modules/jquery.min.js"></script>
        <script src="<?=base_url()?>Asset/modules/tooltip.js"></script>
        <script src="<?=base_url()?>Asset/modules/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>Asset/modules/nicescroll/jquery.nicescroll.min.js"></script>
        <script src="<?=base_url()?>Asset/js/stisla.js"></script>
        <script src="<?=base_url()?>Asset/js/page/auth-register.js"></script>
        <script src="<?=base_url()?>Asset/js/scripts.js"></script>
        <script src="<?=base_url()?>Asset/js/custom.js"></script>
    </body>
</html>
