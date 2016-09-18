<?php
    $prfix = strtolower($_POST['PREFIX']);
    $table_name = strtolower($_POST['TABLE']);
    $table_name_singular = strtolower($_POST['SINGULAR']);
    $table = $prfix . $table_name;
    $Fields = $_POST['FIELDS'];
?>
<?= "<?php\n" ?>
/**
* @var $this CI_Loader|App
*/
if(isset($info))
{
if($view == 'view') $info->visible =  false;
}
else
{
$info = null;
}

<?php foreach ($Fields as $field) : ?>
    <?php
    $type = 'text';
    switch ($field['typeselect'])
    {
        case 'Password':
            $type = 'password';
            break;
        case 'Email':
            $type = 'email';
            break;
        case 'Textarea':
            $type = 'textarea';
            break;
        case 'Number':
            $type = 'number';
            break;
        case 'Date':
            $type = 'date';
            break;
    }
    ?>
    <?php if(!in_array($field['typeselect'], ['Skip'])): ?>
        <?php $model = '$this->' . $table_name . '_model' ?>
        <?php if($field['typeselect'] == 'Select'): ?>
            <?php $provider = '$this->' .  $table_name . '_model->Trae' . ucfirst(substr($field['linkTable'], strlen($prfix), strlen($field['linkTable']) - strlen($prfix))) . 'DD()' ?>
            Component::Dropdown(['Field' => '<?= $field['Field'] ?>', 'dataProvider' => <?= $provider ?>, 'model' => <?= $model ?>, 'name' => '<?= $field['Field'] ?>', 'fields' => ['<?= $field['textSelect'] ?>']]);<?= "\n" ?>
        <?php else: ?>
            Component::Field(['model' => <?= $model ?>, 'name' => '<?= $field['Field'] ?>', 'info' => $info, 'type' => <?= "'$type'" ?>]);<?= "\n" ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>


<?= 'if($view != "view"){'."\n" ?>
echo input_submit(["class" => "col-lg-offset-5 col-lg-10", "text" => is_null($info) ? "Guardar" : "Actualizar"]); <?= "\n"?>
echo call_spin_div();<?= "\n" ?>
<?= "}\n" ?>
echo br(2);
<?= "?>" ?>