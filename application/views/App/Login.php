<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login SDCE</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?= $this->registerAssets(['bootstrapvalidator'], true, true) ?>
</head>
<body class="login-page">
<div class="login-box">
    <div class="login-logo" style="background: #d3d3d3;opacity: .85;">
        <a href=""><span style="color:#0d559d;"><b>Manager</b></span></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body " id="contenedor" style="opacity: .95;">
        <?= form_open("", ['method' => 'post']) ?>
        <div class="form-group has-feedback">
            <input autofocus type="text" class="form-control" placeholder="Ingrese su correo" name="MANAGER" required/>
            <span class="glyphicon glyphicon-envelope form-control-feedback" style="color:#0d559d; "></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Ingrese su clave" name="PASSWORD" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback" style="color:#0d559d;"></span>
        </div>
        <div class="row">
            <div class="col-xs-4">
                <button type="submit" class="btn btn-info btn-block btn-flat">Ingresar <i
                        class="fa fa-sign-in"></i></button>
            </div>
            <!-- /.col -->
        </div>
        <?= form_close() ?>

    </div>
    <div style="margin:10px;">
        <p class="login-box-msg"><b><i class="ion ion-leaf" style="color:#0d559d;"></i>Academic Mooc &copy;
                <?= date('Y') ?></b></p>
    </div>
    <br>
    <!-- /.login-box-body -->
</div>
<script>

    $('form').validator().on('submit', function (e)
    {
        if (e.isDefaultPrevented())
        {
            // handle the invalid form...
        }
        else
        {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: 'app/ValidarCredenciales',
                data: $('form').serialize(),
                success: function (data)
                {
                    if (data == 'ok')
                    {
                        location.href = '<?=site_url()?>';
                    }
                    else
                    {
                        Message('Usuario o clave incorrectos', 'danger', 'form', 900);
                        console.log('dont');
                    }
                }
            });
        }
    });
</script>

</body>
</html>