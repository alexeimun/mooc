<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['bootstrapvalidator', 'dialogs', 'spin', 'icheck']], 'main');
?>
<section class="content-header">
    <?= Component::Breadcrumb([['url' => '', 'text' => 'Inicio'], ['url' => 'managers', 'text' => 'Managers'], ['text' => 'Crear manager']]) ?>
    <?= page_title(["class" => "ios ion-person", "text" => Camelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-8', 'style' => 'margin-left: 15%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <?= $this->view("Managers/FormManager", ["view" => "create"], true) ?>
    <?= form_close() ?>
</div>
<?= $this->Footer() ?>

<script>
    var spinner = new Spinner({
        lines: 10, width: 4,
        radius: 6, color: '#000', speed: 1, length: 15, top: '10%'
    });

    $('input:checkbox').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        increaseArea: '90%' // optional
    });

    var rightEmail = false;

    function verificarcorreo()
    {
        $.ajax({
            type: 'post',
            url: 'verificarcorreo',
            data: {'MANAGER_EMAIL': $('input[name=MANAGER_EMAIL]').val()},
            success: function (data)
            {
                rightEmail = data != 'ok';
            }
        });
    }

    $('input[name=MANAGER_EMAIL]').on('keyup', function ()
    {
        verificarcorreo();
    })

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
            else if (rightEmail)
            {
                $.ajax({
                    type: 'post',
                    url: 'crearmanager',
                    data: $('form').serialize(),
                    beforeSend: function ()
                    {
                        $('body').addClass('Wait');
                        $('body,html').animate({scrollTop: 0}, 200);
                        spinner.spin(document.getElementById("spin"));
                    },
                    success: function ()
                    {
                        $('body').removeClass('Wait');
                        Alert('Registro creado exitosamente.', [{
                            label: 'Cerrar',
                            action: function (dialog)
                            {
                                dialog.close();
                                clearFields();
                            }
                        }]);
                        spinner.stop();
                    }
                });
            }
            else
            {
                Message('El correo ya existe');
            }
        }
    });
</script>