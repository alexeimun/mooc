<?php
    /**
     * @var  CI_Loader $this
     * @var $Frames
     */
?>
<section class="content">
    <div class="row">
        <?php foreach ($Frames as $key => $frame): ?>
        <?php if($key != 0 && $key % 4 == 0): ?>
    </div>
    <div class="row">
        <?php endif; ?>
        <?= Component::Frame($frame) ?>
        <?php endforeach; ?>
    </div>
</section>