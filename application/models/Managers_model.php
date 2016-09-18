<?php

    Class managers_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function attributes()
        {
            return [
                'MANAGER_NAME' => [
                    'label' => 'Nombre',
                    'placeholder' => 'Ingrese nombre',
                    'class' => '',
                    'required' => 'required',
                ],
                'MANAGER_EMAIL' => [
                    'label' => 'Correo',
                    'placeholder' => 'Ingrese correo',
                    'class' => '',
                    'pattern' => '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$',
                    'required' => 'required',
                ],
                'PASSWORD' => [
                    'label' => 'Clave',
                    'placeholder' => 'Ingrese clave',
                    'class' => '',
                    'required' => 'required',
                ],
            ];
        }

        public function ActualizarInicioSesion()
        {
            $this->db->set('LAST_LOG_IN', 'NOW()', false);
            $this->db->update('t_managers', ['LOG_IN' => 1], ['ID_MANAGER' => $this->session->userdata('ID_MANAGER')]);
        }

        public function Lougout()
        {
            $this->db->update('t_managers', ['LOG_IN' => 0], ['ID_MANAGER' => $this->session->userdata('ID_MANAGER')]);
        }

        public function ValidarCredenciales($manager, $clave)
        {
            $query = $this->db->select('*', false)->where('MANAGER_EMAIL', $manager)->where('PASSWORD', md5($clave))->get('t_managers');

            if($query->num_rows() == 1)
            {
                return $query->result('array')[0];
            }
            else
            {
                return null;
            }
        }

        public function TraeManager($IdManager)
        {
            $manager = $this->db->query("SELECT
            t_managers.ID_MANAGER,
			t_managers.MANAGER_NAME,
			t_managers.MANAGER_EMAIL,
			t_managers.PASSWORD,
			t_managers.PHOTO,
			t_managers.LEVEL,
			t_managers.STATE,
			t_managers.REG_DATE,
			t_managers.USER_REG,
			t_managers.LAST_LOG_IN

			FROM t_managers

			WHERE ID_MANAGER = '$IdManager'");
            return $manager->num_rows() > 0 ? $manager->result()[0] : null;
        }

        public function Contar()
        {
            return $this->db->count_all_results('t_managers');
        }

        public function TraeModulosPermisos($IdManager)
        {
            $perms = $this->db->query("SELECT DISTINCT
                if(t_auth_assignment.ID_MANAGER = $IdManager, 1, 0) AS AUTHORIZED,
                t_auth_item.NAME AS ITEM_NAME,
                t_auth_item.DESCRIPTION,
                t_auth_item.TYPE
                
                FROM t_auth_assignment
                
                RIGHT JOIN t_auth_item ON t_auth_assignment.ITEM_NAME=t_auth_item.NAME
                LEFT JOIN t_managers ON t_managers.ID_MANAGER = $IdManager")->result('array');

            $permissions = [];
            foreach ($perms as $perm)
            {
                $permissions[$perm['TYPE']][] = $perm;
            }

            return $permissions;
        }

        public function ActualizarManager()
        {
            $data = $this->input->post(null, true);
            $IdManager = array_shift($data);

            if(isset($_POST['PERMISOS']))
            {
                $Permissions = $data['PERMISOS'];
                unset($data['PERMISOS']);

                $perms = [];
                foreach ($Permissions as $permission)
                {
                    $perms[] = ['ID_MANAGER' => $IdManager, 'ITEM_NAME' => $permission];
                }

                $this->db->delete('t_auth_assignment', ['ID_MANAGER' => $IdManager]);
                $this->db->insert_batch('t_auth_assignment', $perms);
            }

            $this->db->update('t_managers', array_merge($data, ['PASSWORD' => md5($data['PASSWORD'])]), ['ID_MANAGER' => $IdManager]);
        }

        public function InsertarManager()
        {
            $data = $this->input->post(null, true);
            $Permissions = $data['PERMISOS'];
            unset($data['PERMISOS']);
            unset($data['PERMISOS']);
            $data['PASSWORD'] = md5($data['PASSWORD']);

            $this->db->set('FECHA_REGISTRO', 'NOW()', false);
            $this->db->insert('t_managers', $data);

            $IdManager= $this->db->select_max('ID_MANAGER')->get('t_managers')->result()[0]->ID_MANAGER;

            $perms = [];
            foreach ($Permissions as $permission)
            {
                $perms[] = ['ID_MANAGER' => $IdManager, 'ITEM_NAME' => $permission];
            }
            $this->db->insert_batch('t_auth_assignment', $perms);
        }

        public function TraeManagers()
        {
            return $this->db->query("SELECT
           	t_managers.ID_MANAGER,
			t_managers.MANAGER_NAME,
			t_managers.MANAGER_EMAIL,
			t_managers.PASSWORD,
			t_managers.PHOTO,
			t_managers.LEVEL,
			t_managers.STATE,
			t_managers.REG_DATE,
			t_managers.USER_REG,
			t_managers.LAST_LOG_IN

			FROM t_managers")->result('array');
        }

        public function EliminarManager()
        {
            $id = $this->input->post('Id');
            if($id != 1 && $id != $this->session->userdata('ID_MANAGER'))
            {
                $this->db->delete('t_auth_assignment', ['ID_MANAGER' => $id]);
                $this->db->delete('t_managers', ['ID_MANAGER' => $id]);
            }
            else
            {
                show_error("No se puede eliminar el registro solicitado.");
            }
        }

        public function VerificarCorreo()
        {
            return $this->db->get_where('t_managers', ['MANAGER_EMAIL' => $this->input->post('MANAGER_EMAIL')])->num_rows() == 1;
        }

        public function ActualizarFotoManager($Foto)
        {
            $this->db->update('t_managers', ['PHOTO' => $Foto], ['ID_MANAGER' => $this->session->userdata('ID_MANAGER')]);
        }

        public function EliminaFotoAnteriorManager()
        {
            $Foto = $this->db->select('PHOTO')->where('ID_MANAGER', $this->session->userdata('ID_MANAGER'))->limit(1)->get('t_managers')->result()[0]->PHOTO;

            if(!is_null($Foto) && $Foto != 'default.png')
            {
                unlink(APPPATH . '../public/photos/' . $Foto);
            }
        }
    }