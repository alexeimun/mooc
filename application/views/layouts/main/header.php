<?php
    /**
     * @var $this App|CI_Loader
     */
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= isset($title) ? $title : 'Academic Mooc' ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->registerAssets($assets) ?>
</head>

<body class="skin-black sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="<?= site_url() ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><i class="fa fa-home"></i></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"></span> <b>Academic</b> Mooc
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Menu</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img
                                src="<?= base_url("public/photos/" . $this->session->userdata('PHOTO')) ?>"
                                class="user-image" alt="User Image"/>
                            <span class="hidden-xs"><?= $this->session->userdata('MANAGER_NAME') ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img
                                    src="<?= base_url("public/photos/" . $this->session->userdata('PHOTO')) ?>"
                                    class="img-circle" alt="User Image"/>

                                <p>
                                    <?= $this->session->userdata('MANAGER_NAME') ?>
                                    - <?= $this->session->userdata('LEVEL') == 0 ? 'Admistrador' : 'Manager' ?>
                                    <small>Miembro desde <?= $this->session->userdata('FECHA_REGISTRO') ?></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="<?= site_url('app/perfil') ?>" class="btn btn-default btn-flat">Perfil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="<?= site_url('app/logout') ?>" style="" id="logout"
                                       class="btn btn-default btn-flat">Cerrar sesi&oacute;n</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

    </header>