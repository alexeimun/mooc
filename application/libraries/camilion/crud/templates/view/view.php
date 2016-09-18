<?php
    $table_name = strtolower($_POST['TABLE']);
    $table_name_singular = strtolower($_POST['SINGULAR']);
?>
<?= "<?php\n" ?>
/**
* @var $this CI_Loader|App
*/
$this->Header(['assets'=> '']<?= $_POST['LAYOUT'] == 'main' ? '' : ",'" . $_POST['LAYOUT'] . "'" ?>);
<?= "?>\n" ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= "<?= Component::Breadcrumb([['url' => '', 'text' => 'Inicio'], ['url' => '$table_name', 'text' => 'Lista $table_name'], ['text' => 'Ver $table_name_singular']]) ?>\n" ?>
    <?= '<?= page_title([ "class" => "ios ion-person", "text" => Camelize(__FILE__)]) ?>'."\n" ?>
</section>
<!-- Main content -->
<div class="container">
    <?= "<?=form_open('', ['class' => 'form-horizontal col-md-8', 'style' => 'margin-left: 15%']) ?>\n" ?>
    <hr style="border: 1px solid #099a5b;"/>
    <?= '<?= $this->view("' . ucfirst($table_name) . '/Form' . ucfirst($table_name_singular) . '", ["view" => "view", "info" => $info], true) ?>' . "\n" ?>
    <?= '<?=  form_close() ?>' . "\n" ?>
</div>
<?= '<?= $this->Footer() ?>' . "\n" ?>