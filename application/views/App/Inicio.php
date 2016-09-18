<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['']]);
?>
<section class="content-header">
    <h1 style="color:#099a5b"><i class="fa fa-tachometer"></i> Tablero de control
    </h1>
</section>
<br>
<div class="container">
    <?= $Dashboard ?>
</div>
<?= $this->Footer() ?>
<style>
    .green
    {
        color: #088951;
        font-weight: bold;
    }
</style>
