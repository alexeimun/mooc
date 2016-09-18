<?php

    class Component
    {
        public static function Sidebar($params)
        {
            extract($params['options']);
            /**
             * @var string $header
             * @var string $img
             */
            ##Header######################################################################
            $sidebar = "<aside class='main-sidebar'>
                <!-- sidebar: style can be found in sidebar.less -->
                <section class='sidebar'>
                    <!-- Sidebar user panel -->
                    <div class='user-panel'>
                        <div class='pull-left'>";
            if(isset($img))
            {
                $img['url'] = isset($img['url']) ? "onclick=" . "\"" . "location.href='" . site_url($img['url']) . "'" . "\"" : '';
                $sidebar .= "<img  src='" . base_url() . '/' . $img['path'] . "' " . $img['url'] . " draggable='false' style='cursor: pointer' class='img-responsive'/>";
            }
            //$sidebar .= " <!-- search form -->
            //      <form action='#' method='get' class='sidebar-form'>
            //        <div class='input-group'>
            //          <input type='text' name='q' class='form-control' placeholder='Search...'>
            //              <span class='input-group-btn'>
            //                <button type='submit' name='search' id='search-btn' class='btn btn-flat'><i class='fa fa-search'></i>
            //                </button>
            //              </span>
            //        </div>
            //      </form>
            //      <!-- /.search form -->";

            $sidebar .= "</div>
                                    </div>
                                    <ul class='sidebar-menu'>
                                        <li class='header'><span style='color:#6b6b6b;'>$header</span></li>";
            ##nodes##################nodes################################################################################################################################
            $sidebar .= self::renderNodes($params['nodes'], false);
            return $sidebar . "</ul></section></aside>";
        }

        public static function OptionsSidebar()
        {
            echo " <!-- Control Sidebar -->
  <aside class='control-sidebar control-sidebar-dark'>
    <!-- Create the tabs -->
    <ul class='nav nav-tabs nav-justified control-sidebar-tabs'>
      <li><a href='#control-sidebar-home-tab' data-toggle='tab'><i class='fa fa-home'></i></a></li>
      <li><a href='#control-sidebar-settings-tab' data-toggle='tab'><i class='fa fa-gears'></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class='tab-content'>
      <!-- Home tab content -->
      <div class='tab-pane' id='control-sidebar-home-tab'>
        <h3 class='control-sidebar-heading'>Recent Activity</h3>
        <ul class='control-sidebar-menu'>
          <li>
            <a href='javascript:void(0)'>
              <i class='menu-icon fa fa-birthday-cake bg-red'></i>

              <div class='menu-info'>
                <h4 class='control-sidebar-subheading'>Langdon\'s Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href='javascript:void(0)'>
              <i class='menu-icon fa fa-user bg-yellow'></i>

              <div class='menu-info'>
                <h4 class='control-sidebar-subheading'>Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href='javascript:void(0)'>
              <i class='menu-icon fa fa-envelope-o bg-light-blue'></i>

              <div class='menu-info'>
                <h4 class='control-sidebar-subheading'>Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href='javascript:void(0)'>
              <i class='menu-icon fa fa-file-code-o bg-green'></i>

              <div class='menu-info'>
                <h4 class='control-sidebar-subheading'>Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class='control-sidebar-heading'>Tasks Progress</h3>
        <ul class='control-sidebar-menu'>
          <li>
            <a href='javascript:void(0)'>
              <h4 class='control-sidebar-subheading'>
                Custom Template Design
                <span class='label label-danger pull-right'>70%</span>
              </h4>

              <div class='progress progress-xxs'>
                <div class='progress-bar progress-bar-danger' style='width: 70%'></div>
              </div>
            </a>
          </li>
          <li>
            <a href='javascript:void(0)'>
              <h4 class='control-sidebar-subheading'>
                Update Resume
                <span class='label label-success pull-right'>95%</span>
              </h4>

              <div class='progress progress-xxs'>
                <div class='progress-bar progress-bar-success' style='width: 95%'></div>
              </div>
            </a>
          </li>
          <li>
            <a href='javascript:void(0)'>
              <h4 class='control-sidebar-subheading'>
                Laravel Integration
                <span class='label label-warning pull-right'>50%</span>
              </h4>

              <div class='progress progress-xxs'>
                <div class='progress-bar progress-bar-warning' style='width: 50%'></div>
              </div>
            </a>
          </li>
          <li>
            <a href='javascript:void(0)'>
              <h4 class='control-sidebar-subheading'>
                Back End Framework
                <span class='label label-primary pull-right'>68%</span>
              </h4>

              <div class='progress progress-xxs'>
                <div class='progress-bar progress-bar-primary' style='width: 68%'></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class='tab-pane' id='control-sidebar-stats-tab'>Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class='tab-pane' id='control-sidebar-settings-tab'>
        <form method='post'>
          <h3 class='control-sidebar-heading'>General Settings</h3>

          <div class='form-group'>
            <label class='control-sidebar-subheading'>
              Report panel usage
              <input type='checkbox' class='pull-right' checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class='form-group'>
            <label class='control-sidebar-subheading'>
              Allow mail redirect
              <input type='checkbox' class='pull-right' checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class='form-group'>
            <label class='control-sidebar-subheading'>
              Expose author name in posts
              <input type='checkbox' class='pull-right' checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class='control-sidebar-heading'>Chat Settings</h3>

          <div class='form-group'>
            <label class='control-sidebar-subheading'>
              Show me as online
              <input type='checkbox' class='pull-right' checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class='form-group'>
            <label class='control-sidebar-subheading'>
              Turn off notifications
              <input type='checkbox' class='pull-right'>
            </label>
          </div>
          <!-- /.form-group -->

          <div class='form-group'>
            <label class='control-sidebar-subheading'>
              Delete chat history
              <a href='javascript:void(0)' class='text-red pull-right'><i class='fa fa-trash-o'></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->";
        }

        private static function renderNodes($nodes, $auto)
        {
            $sidebar = '';
            foreach ($nodes as $node)
            {
                if(isset($node['visible']) && !$node['visible'])
                {
                    continue;
                }
                $node['options']['target'] = isset($node['options']['target']) ? 'target="' . $node['options']['target'] . '"' : '';
                $node['options']['icon'] = isset($node['options']['icon']) ? $node['options']['icon'] : '';

                if(isset($node['nodes']))
                {
                    $sidebar .= "<li class='treeview'>
                                    <a href='" . (isset($node['url']) ? site_url($node['url']) : '#') . "'>
                                    <i class='" . $node['options']['icon'] . "'></i> <span>&nbsp;&nbsp;" . $node['label'] . "</span>
                                        <i class='fa fa-angle-left pull-right'></i>
                                    </a>
                                    <ul class='treeview-menu'><li>" . static::renderNodes($node['nodes'], true) . "</li></ul></li>";
                }
                else
                {
                    if($auto)
                    {
                        $sidebar .= "<li><a href='" . (isset($node['url']) ? site_url($node['url']) : '#') . "' " . $node['options']['target'] . "'>
                        <i class='fa " . $node['options']['icon'] . "'></i> " . $node['label'] . "</a></li>";
                    }
                    else
                    {
                        $sidebar .= "<li class='treeview'>
                        <a href='" . (isset($node['url']) ? site_url($node['url']) : '#') . "' " . $node['options']['target'] . ">
                        <i class='" . $node['options']['icon'] . "'></i> <span>&nbsp;&nbsp;" . $node['label'] . "</span>
                        </a></li>";
                    }
                }
            }
            return $sidebar;
        }

        public static function Breadcrumb($params)
        {
            $breadcrum = "<ol class='breadcrumb'>";
            foreach ($params as $key => $item)
            {
                if($key + 1 == count($params))
                {
                    $breadcrum .= '<li class="active">' . $item['text'] . '</li>';
                }
                else
                {
                    $breadcrum .= "<li><a href=" . site_url($item['url']) . "><i class='" . ($key == 0 ? 'fa fa-dashboard' : '') . "'></i>" . $item['text'] . "</a></li>";
                }
            }
            return $breadcrum . '</ol>';
        }

        public static function Field($params)
        {
            extract($params);
            /**
             * @var  managers_model $model
             * @var  string $name
             * @var  $info
             * @var  string $type
             * @var   $size
             * @var   $value
             */
            $attr = $model->attributes();

            if(array_key_exists($name, $attr))
            {
                $attr = $attr[$name];
                $placeholder = !isset($attr['placeholder']) ? '' : $attr['placeholder'];
                $label = $attr['label'];
                unset($attr['placeholder'], $attr['label']);
                $size = isset($size) ? $size : [2, 10];
                $value = isset($info) ? $info->$name : (isset($value) ? $value : '');

                switch ($type)
                {
                    case 'textarea':
                        echo form_textarea(array_merge($attr, ['placeholder' => isset($info->visible) ? '' : $placeholder, 'readonly' => isset($info->visible), 'name' => $name, 'input' => ['col' => $size[1]], 'label' => ['col' => $size[0], 'text' => $label]]),
                            $value);
                        break;

                    default:
                        echo form_input(array_merge($attr, ['placeholder' => isset($info->visible) ? '' : $placeholder, 'type' => $type, 'readonly' => isset($info->visible), 'name' => $name, 'input' => ['col' => $size[1]], 'label' => ['col' => $size[0], 'text' => $label]]),
                            $value);
                        break;
                }
            }
            else
            {
                echo "<h3 style='color: lightcoral'>(!) Invalid input name $name</h3>";
            }
        }

        public static function Dropdown(array $params)
        {
            $attr = $params['model']->attributes()[$params['Field']];
            unset($params['model']);
            $params['placeholder'] = $attr['placeholder'];

            echo select_input(['select' => self::_dropdown($params), 'text' => $attr['label']]);
        }

        /**
         * @param array $params
         * @param bool $buffer echoes buffer output if it is true
         * @return string
         */
        public static function Table(array $params, $buffer = true)
        {
            extract($params);
            /**
             * @var array $columns
             * @var array $fields
             * @var array $dataProvider
             * @var string $actions
             * @var string $align
             * @var string $tableName
             * @var bool $autoNumeric
             * @var string $id
             * @var string $controller
             * @var string $tableTitle
             * @var integer $limitCell
             * @var string $showRowCondition
             * @var string $continue
             */

            $limitCell = isset($limitCell) ? $limitCell : 40;
            $align = isset($align) ? $align : 'left';
            $actions = isset($actions) ? $actions : '';
            $controller = isset($controller) ? $controller : '';
            $autoNumeric = isset($autoNumeric) ? $autoNumeric : false;

            $isArrayActions = is_array($actions);

            if(is_array($actions))
            {
                if(key_exists('static', $actions))
                {
                    $_actions = ['view' => strrchr($actions['static'], 'v'), //view
                        'update' => strrchr($actions['static'], 'u'), //update
                        'delete' => strrchr($actions['static'], 'd'), // delete
                        'print' => strrchr($actions['static'], 'p'), //print
                        'check' => strrchr($actions['static'], 'c'), // checkbok
                        'radio' => strrchr($actions['static'], 'r') // radio
                    ];
                }
                #look for custom actions like [[ 'name'=>'greet', 'url'=>'a/b' ]]
                if(key_exists('custom', $actions))
                {
                    foreach ($actions['custom'] as $action)
                    {
                        $_actions['custom'][] = $action;
                    }
                }
            }
            else
            {
                $_actions = ['view' => strrchr($actions, 'v'), //view
                    'update' => strrchr($actions, 'u'), //update
                    'delete' => strrchr($actions, 'd'), // delete
                    'print' => strrchr($actions, 'p'), //print
                    'check' => strrchr($actions, 'c'), // checkbok
                    'radio' => strrchr($actions, 'r') // radio
                ];
            }

            $action = $_actions['delete'] || $_actions['update'] || $_actions['view'] || $_actions['delprinte'] || $_actions['check'] || $_actions['radio'] || $isArrayActions;
            $table = "<section class='content'>
                <div class='row'>
                    <div class='col-xs-12'>
                        <div class='box'>
                            <div class='box-header'>
                                <h3 style='text-align: center;color: #099a5b;'><span style='font-size: 25pt;'
                                                        class='fa fa-table'></span>&nbsp;$tableTitle</h3></div><div class='box-body'>
             <table id='tabla' style='text-align:$align' data-name= '$tableName' class='table table-bordered table-striped'><thead><tr>";
            $c = 0;
            if($autoNumeric)
            {
                $table .= '<th style="width: 20px;">#</th>';
            }
            foreach ($columns as $columnName => $column)
            {
                if(!is_numeric($columnName))
                {
                    $table .= '<th style="' . (isset($column['style']) ? $column['style'] : '') . ';text-align:' . $align . '">' . $columnName . '</th>';
                }
                else
                {
                    $table .= '<th style="text-align:' . $align . '">' . $column . '</th>';
                }
            }
            if($action)
            {
                $table .= '<th>Acciones</th>';
            }
            $table .= '</tr></thead><tbody>';

            foreach ($dataProvider as $record)
            {
                #Check for a row condition to be shown
                if(isset($showRowCondition))
                {
                    eval('$continue=' . $showRowCondition . ";");
                    if(!$continue)
                    {
                        continue;
                    }
                }

                $table .= '<tr>';
                if($autoNumeric)
                {
                    $table .= '<td>' . (++$c) . '</td>';
                }
                foreach ($fields as $kfield => $value)
                {
                    if(!is_numeric($kfield))
                    {
                        if(is_array($value))
                        {
                            switch ($value['type'])
                            {
                                case 'img':
                                    #Represents an image
                                    $table .= '<td><img class="img-circle" style="height: 25px;width: 25px;" src="' . $value['path'] . '/' . $record[$kfield] . '"></td>';
                                    break;
                            }
                        }
                        else
                        {
                            switch ($value)
                            {
                                #Represents a moment helper
                                case 'moment':
                                    $table .= '<td>' . Momento($record[$kfield]) . '</td>';
                                    break;
                                #Represents a date with the helper
                                case 'date':
                                    $table .= '<td>' . date_format(new DateTime($record[$kfield]), 'd/m/Y') . '</td>';
                                    break;
                                #Represents a number format
                                case 'numeric':
                                    $table .= '<td>' . number_format($record[$kfield], 0, '', ',') . '</td>';
                                    break;
                            }
                        }
                    }
                    else
                    {
                        $table .= '<td>' . ($record[$value] = strlen($record[$value]) > $limitCell ? substr($record[$value], 0, $limitCell) . '...' : $record[$value]) . '</td>';
                    }
                }

                if($action)
                {
                    ##Array actions with conditions
                    if($isArrayActions)
                    {
                        foreach ($actions as $kactions => $condition)
                        {
                            foreach (explode(',', $kactions) as $act)
                            {
                                switch ($act)
                                {
                                    case 'v':
                                        eval('$view=' . $condition . ";");
                                        break;
                                    case 'u':
                                        eval('$update=' . $condition . ";");
                                        break;
                                    case 'd':
                                        eval('$delete=' . $condition . ";");
                                        break;
                                    case 'p':
                                        eval('$print=' . $condition . ";");
                                        break;
                                    case 'c':
                                        eval('$check=' . $condition . ";");
                                        break;
                                    case 'r':
                                        eval('$radio=' . $condition . ";");
                                        break;
                                }
                            }
                        }
                    }
                    $table .= '<td>';

                    $kview = $controller . '/ver' . $tableName;
                    $kupdate = $controller . '/actualizar' . $tableName;
                    $kprint = $controller . '/imprimir' . $tableName;
                    $key = '';

                    //TODO  I do not understand this code
                    if(is_array($id))
                    {
                        foreach ($id as $ikey => $ids)
                        {
                            if(!is_numeric($ids))
                            {
                                $key .= '/' . $record[$ids];
                            }
                            else
                            {
                                $key .= '/' . $ids;
                            }
                        }
                    }
                    else
                    {
                        $key .= $record[$id];
                    }
                    //TODO until here

                    if($_actions['view'])
                    {
                        $table .= '<a href="' . site_url("$kview/$key") . '" style="font-size:20pt;color: #29a84b" id="viewid" class="fa fa-eye" target="_blank" data-toggle="tooltip" title="Ver m&aacute;s..."></a>&nbsp;&nbsp;';
                    }
                    if($_actions['print'])
                    {
                        $table .= '<a href="' . site_url("$kprint/$key") . '" style="font-size:20pt;color: black" target="_blank" class="fa fa-print" data-toggle="tooltip" title="Imprimir"></a>&nbsp;&nbsp;';
                    }
                    if($_actions['update'])
                    {
                        $table .= '<a href="' . site_url("$kupdate/$key") . '"  target="_blank" style="font-size:20pt;color:  #0065c3" class="fa fa-pencil" data-toggle="tooltip" title="Editar"></a>&nbsp;&nbsp;';
                    }
                    if($_actions['delete'])
                    {
                        $table .= " <a data-id='$key' style='color:#e54040;font-size:20pt;' class='fa fa-trash-o' data-toggle='tooltip' title='Eliminar'></a>";
                    }
                    ###Check###
                    if($_actions['check'])
                    {
                        $table .= "<input type='checkbox' value='$key' checked>";
                    }
                    ###Radio###
                    if($_actions['radio'])
                    {
                        $table .= "<input type='radio' name='RADIO' value='$key' checked>";
                    }
                    if(key_exists('custom', $_actions))
                    {
                        $table .= "&nbsp;&nbsp;";
                        foreach ($_actions['custom'] as $_action)
                        {
                            eval('$_action[\'url\']=' . $_action['url'] . ';');
                            $table .= '<a href="' . site_url($_action['url']) . '" style="font-size:20pt;color: ' . $_action['color'] . '" id="' . $_action['name'] . 'id" class="' . $_action['icon'] . '" target="' . $_action['target'] . '" data-toggle="tooltip" title="' . $_action['title'] . '"></a>&nbsp;&nbsp;';
                        }
                    }
                    $table .= '</td>';
                }
                $table .= '</tr>';
            }
            $table .= "</tbody></table></div></div></div></div></section>";

            if(!$buffer)
            {
                return $table;
            }
            echo $table;
        }

        private static function _dropdown(array $params)
        {
            extract($params);
            /**
             * @var array $dataProvider
             * @var string $name
             * @var string $placeholder
             * @var string $width
             * @var string $fields
             * @var string $index
             * @var bool $readonly
             * @var bool $simple
             */

            $disable = '';
            $size = isset($width) ? $width : '100%';
            if(isset($readonly))
            {
                $disable = "disabled";
                $size = '100%';
            }
            $dropdown = "<select  name='$name' class='form-control' $disable style='width:" . $size . ";'>";
            $dropdown .= "<option style='text-align: center;' value='0'>$placeholder</option>";
            $name = preg_replace('/\[|\]/', '', $name);
            foreach ($dataProvider as $data)
            {
                if(isset($index) && $index == $data[$name])
                {
                    $dropdown .= "<option value='$data[$name]' selected>";
                }
                else
                {
                    $dropdown .= "<option value='$data[$name]'>";
                }

                foreach ($fields as $key => $value)
                {
                    if(!is_numeric($key))
                    {
                        $dropdown .= $value;
                    }
                    else
                    {
                        $dropdown .= $data[$value];
                    }
                }
                $dropdown .= '</option>';
            }
            $dropdown .= '</select>';
            return $dropdown;
        }

        public static function Question($params = [])
        {
            /**
             * @var string $title
             * @var array $options
             * @var array $num
             * @var array $name
             * @var bool $opcional
             * @var bool $checked
             * @var bool $slider
             */
            extract($params);
            $opcional = isset($opcional) && $opcional ? 'opcional' : '';
            $checked = isset($checked) ? $checked = 'checked' : '';
            $num = isset($num) ? $num . '.' : '';

            $template = "<div id='st" . $name . "'><table class='statement'>
            <div class='font1' style='text-align: left;'>$num <span >$title</span>";

            $template .= '</div>';
            $opt = 0;
            $literals = ['a', 'b', 'c', 'd', 'e', 'f'];
            foreach ($options as $option)
            {
                $template .= "<tr>
                <td><input type='radio'  class='$opcional' value='$literals[$opt]' name='R$name' $checked> </td>
                <td class='option font2' style='text-align: justify;'>" . $literals[$opt] . ")  $option </td>
            </tr>";
                $opt++;
            }
            $template .= "</table></div><br>";
            if(isset($slider) && $slider)
            {
                $template .= '<div class="row margin">
                <div class="col-sm-6">
                    <input id="range' . $name . '" type="text" name="range[]" >
                </div></div>';
            }
            echo $template;
        }

        public static function Alert($params)
        {
            extract($params);

            /**
             * @var $title
             * @var $text
             * @var $icon
             * @var $type
             */

            $type = isset($type) ? $type : 'success';
            $text = isset($text) ? $text : '';
            $icon = isset($icon) ? $icon : 'ion-checkmark';
            return "<div class='alert alert-$type'>
              	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              	<span class='$icon' style='font-size: 20pt'> </span><strong>$title</strong> $text
              </div>";
        }

        public static function Beginbox($params)
        {
            extract($params);

            /**
             * @var $title
             * @var $text
             * @var $type
             */
            return "<div class='row'>
                        <div class='col-lg-9'>
                            <div class='box box-solid bg-green-gradient'>
                                <div class='box-header'>
                                    <i class='fa fa-th'></i>
                                    <h3 class='box-title'>$title</h3>
                                    <div class='box-tools pull-right'>
                                        <button class='btn bg-green btn-sm' data-widget='collapse'><i class='fa fa-minus'></i></button>
                                        <button class='btn bg-green btn-sm' data-widget='remove'><i class='fa fa-times'></i></button>
                                    </div>
                                </div>
                                <div class='box-body border-radius-none'>";
        }

        public static function Frame($params)
        {
            extract($params);

            /**
             * @var $title
             * @var $count
             * @var $icon
             * @var $url
             * @var $background
             */
            return "<div class='col-lg-3 col-xs-6' id='total$title'>
            <!-- small box -->
            <div class='small-box $background'>
                <div class='inner'>
                    <h3>$count</h3>
                    <p>$title</p>
                </div>
                <div class='icon'>
                    <i style='cursor: pointer;' onclick='location.href=\"$url\"' class='$icon'></i>
                </div>
                <a href='$url' class='small-box-footer'>Más información <i class='fa fa-arrow-circle-right'></i></a>
            </div>
        </div>";
        }

        public static function Endbox()
        {
            return " </div><!-- /.box-body -->
                                <div class='box-footer no-border'>
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->
                        </div>
                    </div>";
        }

        public static function tableScript($url)
        {
            return "<script type='text/javascript'>
            $(function () {
                $('#tabla').dataTable({
                    'language': 
                        {
                            'sProcessing':     'Procesando...',
                            'sLengthMenu':     'Mostrar _MENU_ registros',
                            'sZeroRecords':    'No se encontraron resultados',
                            'sEmptyTable':     'Ningún dato disponible en esta tabla',
                            'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
                            'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
                            'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
                            'sInfoPostFix':    '',
                            'sSearch':         'Buscar:',
                            'sUrl':            '',
                            'sInfoThousands':  ',',
                            'sLoadingRecords': 'Cargando...',
                            'oPaginate': {
                            'sFirst':    'Primero',
                            'sLast':     'Útimo',
                            'sNext':     'Siguiente',
                            'sPrevious': 'Anterior'
                            },
                            'oAria': {
                            'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
                            'sSortDescending': ': Activar para ordenar la columna de manera descendente'
                            }
                            }
                });

                $('body').on('click', 'a[data-id]', function () {
                    Alert($(this).data('id'), '" . site_url($url) . "');
                });

        function Alert(id, url) {
            BootstrapDialog.show({
                title: '<span class=\"fa fa-trash\" style=\"font-size: 20pt;font-weight: bold; color: white;\"></span>&nbsp;&nbsp;&nbsp; <span  style=\"font-size: 18pt;\">Atención!</span>',
                type: BootstrapDialog.TYPE_DANGER,
                draggable: true,
                message: '¿Está seguro que desea eliminar este registro?',
                buttons: [{
                label: 'Aceptar',
                    cssClass: 'btn-danger',
                    action: function () {
                    $.post(url, {Id: id}, function () {
                        location.href = '';
                    });
                    }
                },
                    {
                        label: 'Cancelar',
                        action: function (dialogItself) {
                        dialogItself.close();
                    }
                    }]
            });
        }
    });
    </script>";
        }

        public static function RBCA($Modules, $disabled = false)
        {
            $rbca = "";
            $disabled = $disabled ? 'disabled' : '';
            foreach ($Modules as $count => $module)
            {
                $rbca .= "<div class='box box-info'>
                    <div class='box-header''>
                        <h3 class='box-title'> Módulo $count</h3>
                        <!-- tools box -->
                        <div class='pull-right box-tools'>
                            <button class='btn btn-info btn-sm'  style='width:30px;height:25px;' data-widget='collapse'><i class='fa fa-minus'></i></button>
                        </div><!-- /. tools -->
                    </div><!-- /.box-header -->
                    <div class='box-body pad'>
                        <table class='table table-bordered table-striped'>
                            <thead>
                            <tr>
                                <th style='text-align: center;'>#</th>
                                <th style='text-align: center;'>Submódulo</th>
                                <th style='text-align: center;'>Autorizar</th>
                            </tr>
                            </thead>
                            <tbody>";
                foreach ($module as $count => $permission)
                {
                    extract($permission);
                    /**
                     * @var string $ITEM_NAME
                     * @var string $AUTHORIZED
                     * @var string $DESCRIPTION
                     */
                    $count++;
                    $check = $AUTHORIZED == 1 ? 'checked' : '';
                    $rbca .= "<tr>
                                <td style='text-align: center;'>$count</td>
                                <td>$DESCRIPTION</td>
                                <td style='text-align: center;'><input type='checkbox' name='PERMISOS[]' value='$ITEM_NAME' $disabled $check></td>
                            </tr>";
                }
                $rbca .= "</tbody>
                            </table>
                           </div>
                           </div>";
            }
            return $rbca;
        }
    }