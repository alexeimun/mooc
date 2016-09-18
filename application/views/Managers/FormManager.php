<?php
    /**
     * @var $this CI_Loader|App
     */
    if(isset($info))
    {
        if($view == 'view' || (isset($info) && $info->ID_MANAGER == 1) || $info->ID_MANAGER == $this->session->userdata('ID_MANAGER'))
        {
            $view = 'view';
            $info->visible = false;
        }
    }
    else
    {
        $info = null;
    }
?>
<?php if($view == "view"): ?>
    <?= br(2) ?>
    <div class="row">
        <div class="col-md-12 col-lg-push-0">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                    <h3 class="widget-user-username"><?= $info->MANAGER_NAME ?></h3>
                    <h5 class="widget-user-desc">Miembro desde, <?= Momento($info->REG_DATE) ?></h5>
                    <h5 class="widget-user-desc">Último inicio de
                        sesión <?= Momento($info->LAST_LOG_IN) ?></h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle" src="<?= site_url('public/photos/' . $info->PHOTO) ?>" width="128"
                         height="128"
                         alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header" style="color: #3878a3">15 <i
                                        class="fa fa-rocket"></i>
                                </h5>
                                <a href="" target="_blank"> <b>
                                        Proyectos</b></a>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header"><br></h5>
                                <b>
                                    <?php
                                        if(true)
                                        {
                                            echo '<i style="color: rgba(13, 134, 78, 0.83)" class="fa fa-circle"></i> Conectado';
                                        }
                                        else
                                        {
                                            echo '<i style="color: rgba(153, 25, 46, 0.83)" class="fa fa-circle"></i> Desconectado';
                                        }
                                    ?>
                                </b>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header" style="color: #3878a3">10 <i
                                        class="fa fa-group"></i></h5>
                                <a href="" target="_blank"><b> Practicantes</b></a>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.widget-user -->
        </div>
        <!-- /.col -->
    </div>
<?php else: ?>
    <?= Component::Field(['model' => $this->managers_model, 'name' => 'MANAGER_NAME', 'info' => $info, 'type' => 'text']); ?>
    <?= Component::Field(['model' => $this->managers_model, 'name' => 'MANAGER_EMAIL', 'info' => $info, 'type' => 'text']); ?>
    <?= Component::Field(['model' => $this->managers_model, 'name' => 'PASSWORD', 'info' => $info, 'type' => 'password']); ?>
<?php endif; ?>

<?php if($view != "view"): ?>
    <?= form_input(['placeholder' => 'Ingrese de nuevo la contraseña', 'type' => 'password', 'class' => 'rclave', 'label' => ['text' => 'Comprobar Clave'], 'required' => 'required']) ?>
<?php endif; ?>

<?php if((isset($info) && $info->ID_MANAGER != 1) && $info->ID_MANAGER != $this->session->userdata('ID_MANAGER')): ?>
    <h3 style="text-align: center;color:#099a5b">Roles y permisos</h3>
    <hr style="border: 1px solid #099a5b;"/>
<?php endif; ?>

<?= form_dropdown('LEVEL', [0 => 'Manager', 1 => 'Administrador'], ['input' => ['col' => 3], 'label' => ['col' => 6, 'text' => 'Tipo de usuario']], ['selected' => isset($info) ? $info->LEVEL : 0], ($view == 'view') ? 'disabled=disabled' : '') ?>
<?php
    if((isset($info) && ($info->ID_MANAGER != 1 && $info->ID_MANAGER != $this->session->userdata('ID_MANAGER'))) || $view == 'create')
        echo Component::RBCA($this->managers_model->TraeModulosPermisos(isset($info) ? $info->ID_MANAGER : 0), $view == 'view') ?>


<?= br(2) ?>

<?php
    if($view != "view")
    {
        echo input_submit(["class" => "col-lg-offset-5 col-lg-10", "text" => is_null($info) ? "Guardar" : "Actualizar"]);
        echo call_spin_div();
    }
    echo br(2);
?>