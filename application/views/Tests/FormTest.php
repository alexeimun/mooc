<?php
    /**
     * @var $this CI_Loader|App
     */
    if(isset($info))
    {
        if($view == 'view')
        {
            $info->visible = false;
        }
    }
    else
    {
        $info = null;
    }

    Component::Dropdown(['Field' => 'ID_LECTION', 'dataProvider' => $this->tests_model->TraeLectionsDD(), 'model' => $this->tests_model, 'name' => 'ID_LECTION', 'fields' => ['LECTION_TITLE']]);
    Component::Field(['model' => $this->tests_model, 'name' => 'TEST_TITLE', 'info' => $info, 'type' => 'text']);
    Component::Field(['model' => $this->tests_model, 'name' => 'TEST_DESCRIPTION', 'info' => $info, 'type' => 'textarea']);

    if($view != "view")
    {
        echo input_submit(["class" => "col-lg-offset-5 col-lg-10", "text" => is_null($info) ? "Guardar" : "Actualizar"]);
        echo call_spin_div();
    }
    echo br(2);
?>