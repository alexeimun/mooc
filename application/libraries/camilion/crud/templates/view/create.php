<?php
    $table_name = strtolower($_POST['TABLE']);
    $table_name_singular = strtolower($_POST['SINGULAR']);
?>
<?= "<?php\n" ?>
/**
* @var $this CI_Loader|App
*/
$this->Header(['assets' => ['bootstrapvalidator', 'dialogs', 'spin']]<?= $_POST['LAYOUT'] == 'main' ? '' : ",'" . $_POST['LAYOUT'] . "'" ?>);
<?= "?>\n" ?>
<section class="content-header">
    <?= "<?= Component::Breadcrumb([['url' => '', 'text' => 'Inicio'], ['url' => '$table_name', 'text' => 'Lista $table_name'], ['text' => 'Crear $table_name_singular']]) ?>\n" ?>
    <?= '<?= page_title([ "class" => "ios ion-person", "text" => Camelize(__FILE__)]) ?>' . "\n" ?>
</section>
<!-- Main content -->
<div class="container">
    <?= "<?=form_open('', ['class' => 'form-horizontal col-md-8', 'style' => 'margin-left: 15%']) ?>\n" ?>
    <hr style="border: 1px solid #099a5b;"/>
    <?= '<?= $this->view("' . ucfirst($table_name) . '/Form' . ucfirst($table_name_singular) . '", ["view" => "create"], true) ?>' . "\n" ?>
    <?= '<?=  form_close() ?>' . "\n" ?>
</div>
<?= '<?= $this->Footer() ?>' . "\n" ?>

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
                url: '<?="crear$table_name_singular" ?>',
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