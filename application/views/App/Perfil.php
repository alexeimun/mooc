<?php
    /**
     * @var $this CI_Loader|App
     */
    $this->Header(['assets' => ['dialogs', 'spin', 'bootstrapvalidator', 'uploadify']]);

?>
<section class="content-header">
    <?= Component::Breadcrumb([['url' => '', 'text' => 'Inicio'], ['text' => 'Perfil']]) ?>
</section>

<!-- Main content -->
<div class="container">
    <?= br(1) ?>
    <?= form_open('', ['class' => 'form-horizontal col-md-6', 'style' => 'margin-left: 20%'], ['ID_MANAGER' => $Info->ID_MANAGER]) ?>
    <div style="text-align: center;" id="imagen">
        <img style="width: 130px;height: 130px;cursor: pointer"
             src="<?= base_url("public/photos/" . $this->session->userdata('PHOTO')) ?>"
             class="img-circle" alt="Manager image" id="dim"/>
    </div>
    <?= br(1) ?>
    <div id="errorload"></div>
    <div style="margin-left: 38%">
        <input type="file" style="" id="file_upload">
    </div>
    <?= br(1) ?>

    <?= form_input(['placeholder' => 'Ingrese su contraseña actual', 'type' => 'password', 'input' => ['col' => 9], 'class' => 'claveinicial', 'label' => ['text' => 'Clave actual', 'col' => 3], 'required' => 'required']) ?>
    <?= form_input(['placeholder' => 'Ingrese una nueva contraseña', 'name' => 'PASSWORD', 'type' => 'password', 'input' => ['col' => 9], 'label' => ['text' => 'Clave', 'col' => 3], 'required' => 'required']) ?>
    <?= form_input(['placeholder' => 'Ingrese de nuevo la contraseña', 'type' => 'password', 'class' => 'rclave', 'input' => ['col' => 9], 'label' => ['text' => 'Comprobar Clave', 'col' => 3], 'required' => 'required']) ?>

    <!--Envíar-->
    <?= input_submit(['class' => 'col-lg-offset-5 col-lg-10', 'text' => 'Actualizar']) ?>

    <?= call_spin_div() ?>
    <?= form_close() ?>
</div>
<?= $this->Footer() ?>

<script>

    var spinner = new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    });

    $('form').validator().on('submit', function (e)
    {
        if (e.isDefaultPrevented())
        {
            // handle the invalid form...
        }
        else
        {
            e.preventDefault();
            if ($('input[name=PASSWORD]').val().length < 8)
            {
                Message('La contraseña debe tener una longitud de al menos 8 caracteres');
            }
            else if ($('input[name=PASSWORD]').val() != $('input.rclave').val())
            {
                Message('La contraseña no coiciede, asegurese de escribirla bien de nuevo');
            }
            else
            {
                $.ajax({
                    type: 'post',
                    url: '<?=site_url('managers/validarclave')?>',
                    data: {'PASSWORD': $('.claveinicial').val()},
                    success: function (data)
                    {
                        if (data == 'ok')
                        {
                            updateManager();
                        }
                        else
                        {
                            Message('Contraseña actual no válida');
                        }
                    }
                });
            }
        }
    });

    function updateManager()
    {
        $.ajax({
            type: 'post', url: '<?=site_url('managers/actualizarmanager')?>', data: $('form').serialize(),
            beforeSend: function ()
            {
                $('body').addClass('Wait');
                $('body,html').animate({scrollTop: 0}, 200);
                spinner.spin(document.getElementById("spin"));
            },
            success: function ()
            {
                $('body').removeClass('Wait');
                spinner.stop();
                Alert('Tu perfil se ha actualizado correctamente.', [{
                    label: 'Cerrar',
                    action: function (dialog)
                    {
                        dialog.close();
                    }
                }]);
            }
        });
    }

    <?php $timestamp = time();?>

    $('#file_upload').uploadify({
        formData: {
            timestamp: '<?= $timestamp;?>',
            token: '<?= md5('topsecret' . $timestamp);?>'
        },
        buttonText: 'SUBIR PHOTO',
        multi: false,
        'swf': '<?=site_url('bower_components/uploadify/uploadify.swf') ?>',
        'uploader': '<?= site_url('managers/subirfotomanager')?>',
        onUploadSuccess: function (file, data)
        {
            data = JSON.parse(data);
            if (data.status == true)
            {
                $('#dim,.img-circle,.user-image').attr('src', '<?=site_url('public/photos') ?>/' + data.data);
            }
        }
    });
</script>


<style>
    img.img-thumbnail
    {
        min-width: 45px;
        min-height: 45px;
        max-height: 170px;
        max-width: 170px;
        width: 15%;
        height: 30%;
        margin: 5px;
        cursor: pointer;
    }

    .Selection
    {
        box-shadow: 2px 2px 2px 2px #52b532;
    }

</style>
