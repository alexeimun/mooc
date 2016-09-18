<?php
    /**
    * @var $this CI_Loader|App
    */
    $this->Header(['assets' => ['datatables', 'dialogs']]);

        Component::Table(['columns' => ['Test title','Test description',],'tableTitle' => 'Tests','tableName' => 'test',
        'controller' => 'tests','autoNumeric' => true, 'id' => 'ID_TEST','dataProvider' => $this->tests_model->TraeTests(), 'actions' => 'duv',
        'fields' => ['TEST_TITLE','TEST_DESCRIPTION',]]);

     echo $this->Footer();
     echo Component::tableScript("tests/EliminarTest");
?>