<?php
    /**
     * @var $this CI_Loader
     */
    $this->Header(['assets' => ['']]);
?>

<section class="content">
    <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Página no encontrada</h3>

            <p>
                No pudimos encontrar la página que estas buscando.
                Por tanto, puedes <a href="<?= site_url() ?>">regresar al panel de control</a> o probar una nueva
                búsqueda.
            </p>

            <form class="search-form">
                <div class="input-group">
                    <input type="text" name="text" class="form-control" placeholder="Buscar">

                    <div class="input-group-btn">
                        <button type="submit" name="submit" class="btn btn-warning btn-flat"><i
                                class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <!-- /.input-group -->
            </form>
        </div>
        <!-- /.error-content -->
    </div>
    <!-- /.error-page -->
</section>
<?= $this->Footer() ?>

<script>
    $('form').on('submit', function (e)
    {
        e.preventDefault();
        location.href = '<?= site_url()?>' + $('input:text').val();
    })
</script>