<?php

    class Managers extends CI_Controller
    {
        function __construct()
        {
            parent::__construct();
            $this->rbca->haslogin();
        }

        public function index()
        {
            if($this->rbca->is_admin())
            {
                $this->load->view('Managers/Managers');
            }
        }

        public function crearmanager()
        {
            if($this->rbca->is_admin())
            {
                if($this->input->is_ajax_request())
                {
                    $this->managers_model->InsertarManager();
                }
                else
                {
                    $this->load->view('Managers/CrearManager');
                }
            }
        }

        public function actualizarmanager($IdManager = null)
        {
            if($this->rbca->is_admin())
            {
                if($this->input->is_ajax_request())
                {
                    $this->managers_model->ActualizarManager();
                }
                else if(is_numeric($IdManager))
                {
                    $Data = $this->managers_model->TraeManager($IdManager);

                    if($Data != null)
                    {
                        $this->load->view('Managers/ActualizarManager', ['info' => $Data]);
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
        }

        public function verificarcorreo()
        {
            echo $this->managers_model->VerificarCorreo() ? 'ok' : '';
        }

        public function validarclave()
        {
            if(md5($this->input->post('PASSWORD')) == $this->session->userdata('PASSWORD'))
            {
                echo "ok";
            }
        }

        public function vermanager($IdManager)
        {
            if($this->rbca->is_admin())
            {
                if(is_numeric($IdManager))
                {
                    $Data = $this->managers_model->TraeManager($IdManager);

                    if($Data != null)
                    {
                        $this->load->view('Managers/VerManager', ['info' => $Data]);
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
        }

        public function eliminarmanager()
        {
            if($this->input->is_ajax_request() && $this->rbca->is_admin('', false))
            {
                $this->managers_model->EliminarManager();
            }
        }

        public function subirfotomanager()
        {
            $route = '/';
            if($_SERVER['DOCUMENT_ROOT'] == 'C:/wamp/www')
            {
                $route = '/camilion/';
            }
            //Define a destination
            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . $route . 'moocrest/public/photos'; // Relative to the root
            $verifyToken = md5('topsecret' . $_POST['timestamp']);

            if(!empty($_FILES) && $_POST['token'] == $verifyToken)
            {
                $ext = explode('.', $_FILES['Filedata']['name']);
                $ext = $ext[count($ext) - 1];
                $tempFile = $_FILES['Filedata']['tmp_name'];
                $filename = time() . '.' . $ext;
                $targetFile = rtrim($targetFolder, '/') . '/' . $filename;
                // Validate the file type
                $fileTypes = ['jpg', 'jpeg', 'gif', 'png']; // File extensions
                if(in_array($ext, $fileTypes))
                {
                    if(move_uploaded_file($tempFile, $targetFile))
                    {
                        $this->managers_model->EliminaFotoAnteriorManager();
                        $this->managers_model->ActualizarFotoManager($filename);
                        $this->session->set_userdata(['PHOTO' => $filename]);
                        echo json_encode(['status' => true, 'data' => $filename]);
                    }
                }
                else
                {
                    echo json_encode(['status' => false, 'data' => '<h2 style="color: #d3d3d3">Tipo de archivo denegado.</h2>']);
                }
            }
        }
    }