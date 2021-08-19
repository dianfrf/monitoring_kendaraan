<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <title><?=$PageTitle;?> | Monitoring</title>
        <link rel="stylesheet" href="<?=base_url()?>Asset/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?=base_url()?>Asset/fonts/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="<?=base_url()?>Asset/css/style.min.css">
        <link rel="stylesheet" href="<?=base_url()?>Asset/css/components.min.css">
    </head>
    <body>
        <?php if($this->session->userdata('login') == FALSE) {redirect('');}?>
        <div id="app">
            <div class="main-wrapper main-wrapper-1">
                <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar">
                    <form class="form-inline mr-auto">
                        <ul class="navbar-nav mr-3">
                            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                        </ul>
                    </form>
                    <ul class="navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img alt="image" src="<?=base_url()?>Asset/img/avatar-1.png" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block">Hi, <?=$this->session->userdata('nama')?></div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="<?=base_url('User/user_logout')?>" class="dropdown-item has-icon text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="main-sidebar sidebar-style-2">
                    <aside id="sidebar-wrapper">
                        <div class="sidebar-brand">
                            <a href="<?=base_url('Dashboard');?>">Monitoring Kendaraan</a>
                        </div>
                        <div class="sidebar-brand sidebar-brand-sm">
                            <a href="<?=base_url('Dashboard');?>">MK</a>
                        </div>
                        <ul class="sidebar-menu">
                            <li class="menu-header">MAIN</li>
                            <li class="<?= ($active == "Dashboard") ? 'active' : ''; ?>">
                                <a class="nav-link" href="<?=base_url('Dashboard')?>">
                                    <i class="fas fa-home"></i><span>Dashboard</span>
                                </a>
                            </li>
                            <?php if($this->session->userdata('level') == 1) { ?>
                            <li class="menu-header">Master Data</li>
                            <li class="<?= ($active == "Kendaraan") ? 'active' : ''; ?>">
                                <a class="nav-link" href="<?=base_url('Data_Kendaraan')?>">
                                    <i class="fas fa-car"></i><span>Data Kendaraan</span>
                                </a>
                            </li>
                            <li class="<?= ($active == "Atasan") ? 'active' : ''; ?>">
                                <a class="nav-link" href="<?=base_url('Data_Atasan')?>">
                                    <i class="fas fa-user"></i><span>Data Atasan / Penyetuju</span>
                                </a>
                            </li>
                            <li class="menu-header">Pemesanan</li>
                            <li class="<?= ($active == "PesanKendaraan") ? 'active' : ''; ?>">
                                <a class="nav-link" href="<?=base_url('Pesan_Kendaraan')?>">
                                    <i class="far fa-file-alt"></i><span>Pesan Kendaraan</span>
                                </a>
                            </li>
                            <li class="<?= ($active == "Histori") ? 'active' : ''; ?>">
                                <a class="nav-link" href="<?=base_url('Histori_Pemesanan')?>">
                                    <i class="fas fa-history"></i><span>Histori Pemesanan</span>
                                </a>
                            </li>
                            <?php } else { ?>
                            <li class="menu-header">Pemesanan</li>
                            <li class="<?= ($active == "DaftarPemesanan") ? 'active' : ''; ?>">
                                <a class="nav-link" href="<?=base_url('Daftar_Pemesanan')?>">
                                    <i class="far fa-file-alt"></i><span>Daftar Pemesanan</span>
                                </a>
                            </li>
                            <li class="<?= ($active == "Histori") ? 'active' : ''; ?>">
                                <a class="nav-link" href="<?=base_url('Histori_Pemesanan')?>">
                                    <i class="fas fa-history"></i><span>Histori Pemesanan</span>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </aside>
                </div>
                <div class="main-content">
                    <?php
                        $this->load->view($content);
                    ?>
                </div>
                <footer class="main-footer">
                    <div class="footer-left">
                        Copyright &copy; 2021 Dian F. Arif<div class="bullet"></div>All Rights Reserved.
                    </div>
                </footer>
            </div>
        </div>
        <script src="<?=base_url()?>Asset/js/jquery-3.2.1.min.js"></script>
        <script src="<?=base_url()?>Asset/modules/tooltip.js"></script>
        <script src="<?=base_url()?>Asset/js/bootstrap.min.js"></script>
        <script src="<?=base_url()?>Asset/modules/nicescroll/jquery.nicescroll.min.js"></script>
        <script src="<?=base_url()?>Asset/js/stisla.js"></script>
        <script src="<?=base_url()?>Asset/js/page/index-0.js"></script>
        <script src="<?=base_url()?>Asset/js/scripts.js"></script>
        <script src="<?=base_url()?>Asset/js/custom.js"></script>
    </body>
</html>
