<?php
/**
* @var $this CI_Loader|App
*/
$this->Header(['assets'=> '']);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= Component::Breadcrumb([['url' => '', 'text' => 'Inicio'], ['url' => 'tests', 'text' => 'Lista tests'], ['text' => 'Ver test']]) ?>
    <?= page_title([ "class" => "ios ion-person", "text" => Camelize(__FILE__)]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?=form_open('', ['class' => 'form-horizontal col-md-8', 'style' => 'margin-left: 15%']) ?>
    <hr style="border: 1px solid #099a5b;"/>
    <?= $this->view("Tests/FormTest", ["view" => "view", "info" => $info], true) ?>
    <?=  form_close() ?>
</div>
<?= $this->Footer() ?>
