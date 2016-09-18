<?php

    class NavLib
    {
        public function ExtractNav($format = 'json')
        {
            $layoutPath = APPPATH . "/views/layouts/" . $_POST['LAYOUT'] . "/navigation.php";

            if(file_exists($layoutPath))
            {
                $data = $this->DecodeFile($layoutPath);
                if($format == 'json')
                {
                    echo json_encode($data);
                }
                else
                {
                    return $data;
                }
            }
            else
            {
                return null;
            }
        }

        public function InsertNav($nodes)
        {
            $plural = strtolower($_POST['TABLE']);
            $singular = strtolower($_POST['SINGULAR']);
            $node_exist = false;

            foreach ($nodes as $node)
            {
                if($node['label'] == ucfirst($plural) && $node['url'] == '')
                {
                    $node_exist = true;
                    break;
                }
            }
            if($node_exist)
            {
                return false;
            }
            array_push($nodes, ['label' => ucfirst($plural), 'url' => '', 'options' => ['icon' => 'bookmark'],
                'nodes' =>
                    [
                        ['label' => "Crear $singular", 'url' => "$plural/crear$singular", 'options' => ['icon' => 'user-plus']],
                        ['label' => "Listado $plural", 'url' => $plural, 'options' => ['icon' => 'list']],
                    ],
            ]);
            $_POST['NODES'] = $nodes;
            return true;
        }

        private function DecodeFile($path)
        {
            $nav = ['path' => file($path), 'initnav' => false, 'content' => ''];
            foreach ($nav['path'] as $num => $line)
            {
                $line = rtrim($line);
                if(!$nav['initnav'])
                {
                    if(strpos($line, "'nodes'") !== false)
                    {
                        $nav['initnav'] = true;
                    }
                }
                else if(strpos($line, "?>") === false)
                {
                    $nav['content'] .= $line;
                }
                else
                {
                    break;
                }
            }
            $nav['content'] = rtrim($nav['content'], "]);");
            $nav['content'] = rtrim($nav['content'], ', ');
            $mainav = [];
            eval('$mainav=' . $nav['content'] . ";");

            //var_dump($mainav);exit;
            return $mainav;
        }

        public function AssemblyNodes($nodes)
        {
            foreach ($nodes as $node)
            {
                $label = $node['label'];
                $url = isset($node['url']) ? $node['url'] : '';
                $icon = str_replace('fa fa-', '', $node['options']['icon']);

                if(isset($node['nodes']))
                {
                    echo "['label' => '$label', 'url' => '$url', 'options' => ['icon' => 'fa fa-$icon'],
                     'nodes' =>
                        [\n";
                    $this->AssemblyNodes($node['nodes']);
                    echo "\n\t\t\t\t\t\t],],";
                }
                else
                {
                    echo "\t\t\t\t\t\t['label' => '$label', 'url' => '$url', 'options' => ['icon' => 'fa fa-$icon']],\n";
                }
            }
        }
    }