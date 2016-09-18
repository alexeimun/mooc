<?php
    /**
     * @var $this CI_Loader|App
     */
    $this->Header(['assets' => ['datatables', 'dialogs']]);

    Component::Table(['columns' => ['Title', 'Description', 'Image', 'Duration',], 'tableTitle' => 'Courses', 'tableName' => 'course',
        'controller' => 'courses', 'autoNumeric' => true, 'id' => 'ID_COURSE', 'dataProvider' => $this->courses_model->TraeCourses(),
        'actions' => ['custom' => [['name' => 'leccion', 'url' => '"lection/".$record[$id]', 'icon' => 'fa fa-adn', 'title' => 'Lecciones', 'color' => '#ffb14a', 'target' => '_blank'],], 'static' => 'duv'],
        'fields' => ['TITLE', 'DESCRIPTION', 'IMAGE', 'DURATION',]]);

    echo $this->Footer();
    echo Component::tableScript("courses/EliminarCourse");
?>