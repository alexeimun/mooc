<?php

    class ccg extends CI_Controller
    {
        private $gen;
        private $cm;
        private $nav;

        function __construct()
        {
            parent::__construct();
            $this->load->library(['camilion/Camilion', 'camilion/libs/Cgenerator', 'camilion/libs/NavLib']);
            $this->gen = new Cgenerator();
            $this->cm = new Camilion();
            $this->nav = new NavLib();
        }

        public function getfields($table)
        {
            echo json_encode($this->gen->Describe($table, 'array'));
        }

        public function getalltablefields()
        {
            $allfields = [];
            $tables = json_decode($this->gen->Tables());
            foreach ($tables as $table)
            {
                $allfields[$table] = $this->gen->Describe($table, 'array');
            }
            echo json_encode($allfields);
        }

        public function gettables()
        {
            echo $this->gen->Tables();
        }

        public function resolvelayouts()
        {
            $layouts = [];
            $path = APPPATH . '/views/layouts';
            $ls = explode("\n", rtrim(`ls $path`, "\n"));
            foreach ($ls as $item)
            {
                if($item != 'camilion')
                {
                    $layouts[] = ['value' => $item, 'label' => $item];
                }
            }
            echo json_encode($layouts);
        }

        public function constructnav()
        {
            if(!empty($_POST))
            {
                $this->cm->GenerateNav();
            }
        }

        public function getnavitems()
        {
            if(!empty($_POST))
            {
                $this->nav->ExtractNav();
            }
        }

        public function index()
        {
            if(!empty($_POST))
            {
                $_POST['LAYOUT'] = $_POST['LAYOUT']['value'];

                if($this->nav->InsertNav($this->nav->ExtractNav('array')))
                {
                    $this->cm->GenerateNav();
                }

                $this->cm->GenerateCrud();
            }
            else
            {
                $this->load->view('camilion/camilion');
            }
        }
    }