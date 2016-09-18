<?php

    class Courses extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();

            $this->rbca->haslogin();
            $this->load->model(['courses_model']);
        }

        public function index()
        {
            $this->load->view('Courses/Courses');
        }

        public function crearcourse()
        {
            if($this->input->is_ajax_request())
            {
                $this->courses_model->InsertarCourse();
            }
            else
            {
                $this->load->view('Courses/CrearCourse');
            }
        }

        public function actualizarcourse($IdCourse = null)
        {
            if($this->input->is_ajax_request())
            {
                $this->courses_model->ActualizarCourse();
            }
            else if(is_numeric($IdCourse))
            {
                $Data = $this->courses_model->Traecourse($IdCourse);

                if($Data != null)
                {
                    $this->load->view('Courses/ActualizarCourse', ['info' => $Data]);
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

        public function vercourse($IdCourse)
        {
            if(is_numeric($IdCourse))
            {
                $Data = $this->courses_model->Traecourse($IdCourse);

                if($Data != null)
                {
                    $this->load->view('Courses/VerCourse', ['info' => $Data]);
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

        public function eliminarcourse()
        {
            if($this->input->is_ajax_request())
            {
                $this->courses_model->EliminarCourse();
            }
            else
            {
                redirect(site_url(), 'refresh');
            }
        }
    }


