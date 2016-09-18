<?php
    /**
     * @var Cgenerator $gen
     */
    $table_name = strtolower($_POST['TABLE']);
    $table = $_POST['PREFIX'] . $table_name;
    $table_name_singular = strtolower($_POST['SINGULAR']);
    $primary_key = $gen->ShowPrimaryKey($table);
?>
<?= "<?php\n" ?>
/**
* @var $this CI_Loader|App
*/
$this->Header(['assets' => ['bootstrapvalidator', 'dialogs', 'spin']]);
<?= "?>\n" ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= "<?= Component::Breadcrumb([['url' => '', 'text' => 'Inicio'], ['url' => '$table_name', 'text' => 'Lista $table_name'], ['text' => 'Actualizar $table_name_singular']]) ?>\n" ?>
    <?= '<?= page_title([ "class" => "ios ion-person", "text" => Camelize(__FILE__)]) ?>' . "\n" ?>
</section>
<!-- Main content -->
<div class="container">
    <?= "<?=form_open('', ['class' => 'form-horizontal col-md-8', 'style' => 'margin-left: 15%'], ['$primary_key' => " . '$info->' . $primary_key . "]) ?>\n" ?>
    <hr style="border: 1px solid #099a5b;"/>
    <?= '<?= $this->view("' . ucfirst($table_name) . '/Form' . ucfirst($table_name_singular) . '", ["view" => "update", "info" => $info], true) ?>' . "\n" ?>
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
                url: '<?="<?= site_url('$table_name/actualizar$table_name_singular" . "') ?>" ?>',
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