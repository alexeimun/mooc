<?php
    /**
     * @var $this CI_Loader|App
     */
    $this->Header(['assets' => ['bootstrapvalidator', 'dialogs', 'spin']]);
?>
<section class="content-header">
    <?= Component::Breadcrumb([['url' => '', 'text' => 'Inicio'], ['url' => 'courses', 'text' => 'Lista courses'], ['text' => 'Crear curso']]) ?>
    <?= page_title(["class" => "ios ion-person", "text" => Camelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-8', 'style' => 'margin-left: 15%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <?= $this->view("Courses/FormCourse", ["view" => "create"], true) ?>
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
        else if ($('select[name=ID_TEACHER] :selected').val() == 0)
        {
            e.preventDefault();
            Message('Debe seleccionar un profesor');
        }
        else
        {
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: 'crearcourse',
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
    });
</script>