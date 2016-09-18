<?php

    class App extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
            //$this->session->sess_destroy();
            if($this->rbca->haslogin('', false))
            {
                $this->load->view('App/Inicio', $this->Dashboard());
            }
            else
            {
                $this->load->view('App/Login');
            }
        }

        public function sessionIsActive()
        {
            if(!$this->session->userdata('ID_MANAGER'))
            {
                echo 'ok';
            }
        }

        public function ValidarClaveAjax()
        {
            if($this->input->is_ajax_request())
            {
                if(!is_null($this->managers_model->ValidarCredenciales($this->session->userdata('MANAGER_EMAIL'), $this->input->post('PASSWORD'), 0)))
                {
                    echo 'ok';
                }
            }
        }

        public function logout()
        {
            $this->managers_model->Lougout();
            $this->session->sess_destroy();
            redirect(site_url(), 'refresh');
        }

        public function error404()
        {
            $this->load->view('App/Error404');
        }

        public function ValidarCredenciales()
        {
            if($this->input->is_ajax_request())
            {
                $log = $this->managers_model->ValidarCredenciales($this->input->post('MANAGER', true), $this->input->post('PASSWORD', true));
                if($log != null)
                {
                    $this->session->set_userdata(array_merge($log,
                        //Custom and override fields
                        [
                            'REG_DATE' => MesNombreAbr(round(date_format(new DateTime($log['REG_DATE']), 'm'))) . '. ' . date_format(new DateTime($log['REG_DATE']), 'Y'),
                        ]
                    ));
                    $this->managers_model->ActualizarInicioSesion();
                    $this->rbca->load_permissions($log['ID_MANAGER']);
                    echo 'ok';
                }
                else
                {
                    sleep(1);
                }
            }
            else
            {
                sleep(1);
            }
        }

        public function acerca()
        {
            if($this->session->userdata('ID_MANAGER'))
            {
                $this->load->view('App/About');
            }
        }

        public function perfil()
        {
            if($this->rbca->haslogin())
            {
                //$this->managers_model->TraeAsesor($this->session->userdata('ID_MANAGER'));
                $this->load->view('App/Perfil', ['Info' => $this->managers_model->TraeManager($this->session->userdata('ID_MANAGER'))]);
            }
        }

        private function Dashboard()
        {
            $this->load->model(['courses_model']);
            $Frames =
                [
                    ['title' => 'Managers', 'count' => $this->managers_model->Contar(), 'icon' => 'fa fa-group', 'background' => 'bg-green-gradient', 'url' => 'managers'],
                    ['title' => 'Courses', 'count' => $this->courses_model->Contar(), 'icon' => 'fa fa-bookmark', 'background' => 'bg-blue-gradient', 'url' => 'courses'],
                ];

            return ['Dashboard' => $this->load->view('App/Dashboard/DashboardManager', ['Frames' => $Frames], true)];
        }
    }