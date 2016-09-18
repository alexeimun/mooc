<?php
    class Tests extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();

            $this->rbca->haslogin();
            $this->load->model(['tests_model',]);
        }

        public function index()
        {
            $this->load->view('Tests/Tests');
        }

        public function creartest()
        {
            if($this->input->is_ajax_request())
            {
                $this->tests_model->InsertarTest();
            }
            else
            {
                $this->load->view('Tests/CrearTest');
            }
        }

        public function actualizartest($IdTest = null)
        {
            if($this->input->is_ajax_request())
            {
                $this->tests_model->ActualizarTest();
            }
            else if(is_numeric($IdTest))
            {
                $Data = $this->tests_model->Traetest($IdTest);

                if($Data != null)
                {
                    $this->load->view('Tests/ActualizarTest', ['info' => $Data]);
                }
                else
                {
                    redirect(site_url(), 'refresh');
                }
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }

        public function vertest($IdTest)
        {
             if(is_numeric($IdTest))
            {
                $Data = $this->tests_model->Traetest($IdTest);

                if($Data != null)
                {
                    $this->load->view('Tests/VerTest', ['info' => $Data]);
                }
                else
                {
                    redirect(site_url(), 'refresh');
                }
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }


        public function eliminartest()
        {
            if($this->input->is_ajax_request())
            {
                $this->tests_model->EliminarTest();
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }
    }