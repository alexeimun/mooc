<?php
/**
* @var $this CI_Loader|App
*/
$this->Header(['assets' => ['bootstrapvalidator', 'dialogs', 'spin']]);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= Component::Breadcrumb([['url' => '', 'text' => 'Inicio'], ['url' => 'tests', 'text' => 'Lista tests'], ['text' => 'Actualizar test']]) ?>
    <?= page_title([ "class" => "ios ion-person", "text" => Camelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?=form_open('', ['class' => 'form-horizontal col-md-8', 'style' => 'margin-left: 15%'], ['ID_TEST' => $info->ID_TEST]) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <?= $this->view("Tests/FormTest", ["view" => "update", "info" => $info], true) ?>
    <?=  form_close() ?>
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
            $.ajax({
                type: 'post',
                url: '<?= site_url('tests/actualizartest') ?>',
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
                    Alert('Registro actualizado exitosamente.', [{
                        label: 'Cerrar',
                        action: function (dialog)
                        {
                            dialog.close();
                        }
                    }]);
                    spinner.stop();
                }
            });
        }
    });
</script>