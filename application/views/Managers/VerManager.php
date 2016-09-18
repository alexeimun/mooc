<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => 'icheck']);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <?= Component::Breadcrumb([['url' => '', 'text' => 'Inicio'], ['url' => 'managers', 'text' => 'Managers'], ['text' => 'Ver manager']]) ?>
</section>
<!-- Main content -->
<div class="container">
    <?= form_open('', ['class' => 'form-horizontal col-md-8', 'style' => 'margin-left: 15%']) ?>
    <?= $this->view("Managers/FormManager", ["view" => "view", "info" => $info], true) ?>
    <?= form_close() ?>
</div>
<?= $this->Footer() ?>

<script>
    $('input:checkbox').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        increaseArea: '90%' // optional
    });
</script>
