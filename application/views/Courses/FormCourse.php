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

    Component::Field(['model' => $this->courses_model, 'name' => 'TITLE', 'info' => $info, 'type' => 'text']);
    Component::Field(['model' => $this->courses_model, 'name' => 'DESCRIPTION', 'info' => $info, 'type' => 'textarea']);
    Component::Field(['model' => $this->courses_model, 'name' => 'IMAGE', 'info' => $info, 'type' => 'text']);
    Component::Field(['model' => $this->courses_model, 'name' => 'DURATION', 'info' => $info, 'type' => 'number', 'size' => [2, 2], 'value' => 1]);
    Component::Field(['model' => $this->courses_model, 'name' => 'STARTS_IN', 'info' => $info, 'type' => 'date']);

    Component::Dropdown(['Field' => 'ID_TEACHER', 'dataProvider' => $this->courses_model->TraeTeachersDropdown(), 'model' => $this->courses_model, 'name' => 'ID_TEACHER', 'fields' => ['TEACHER_NAME']]);

    if($view != "view")
    {
        echo input_submit(["class" => "col-lg-offset-5 col-lg-10", "text" => is_null($info) ? "Guardar" : "Actualizar"]);
        echo call_spin_div();
    }
    echo br(2);
?>