<?php

    /**
     * Class Rbca
     * Role Base on Control Access
     */
    class Rbca
    {
        private $CI;

        public function __construct()
        {
            //Define CI based variables (so you can use CI functions)
            $this->CI =& get_instance();
        }

        public function can($verb, $redirect = true)
        {
            if($redirect)
            {
                if(!isset($this->CI->session->userdata['can'][$verb]))
                {
                    redirect(site_url(), 'refresh');
                }
            }
            else
            {
                return isset($this->CI->session->userdata['can'][$verb]);
            }
        }

        public function haslogin($route = '', $redirect = true)
        {
            if(count($this->CI->session->all_userdata()) > 1)
            {
                return true;
            }
            else if($redirect)
            {
                redirect(site_url($route), 'refresh');
            }
            else
            {
                return false;
            }
        }

        public function is_admin($route = '', $redirect = true)
        {
            if($this->CI->session->userdata('LEVEL') == 1)
            {
                return true;
            }
            else if($redirect)
            {
                redirect(site_url($route), 'refresh');
            }
            else
            {
                return false;
            }
        }

        public function load_permissions($id_user)
        {
            if($this->CI->config->config['enable_rbca'])
            {
                $this->CI->db->select('item_name');
                $this->CI->db->where('ID_MANAGER', $id_user);
                $permissions = $this->CI->db->get('t_auth_assignment')->result('array');
                $perms = [];
                foreach ($permissions as $perm)
                {
                    $perms[$perm['item_name']] = 1;
                }
                $this->CI->session->set_userdata(['can' => $perms]);
            }
        }

        public function is_authorized($data)
        {
            if(!$this->_authorized($data))
            {
                redirect(site_url(), 'refresh');
            }
        }

        /**
         * @param $data
         * @return bool
         */
        private function _authorized($data)
        {
            switch ($data)
            {
                case '*':
                    return true;
                case
                '~':
                    return false;
                default:
                    if(!is_array($data))
                    {
                        return false;
                    }
                    extract($data);
                    /**
                     * @var
                     */
                    $actor = $this->CI->session->userdata('CURRENT_USER');
                    $action = isset($this->CI->uri->segments[2]) ? $this->CI->uri->segments[2] : 'index';

                    foreach ($data as $key => $value)
                    {
                        if($actor == $key)
                        {
                            if(is_array($value))
                            {
                                if(isset($value['~']))
                                {
                                    foreach ($value['~'] as $act)
                                    {
                                        if($action == $act)
                                        {
                                            return false;
                                        }
                                    }
                                    return true;
                                }
                                else
                                {
                                    foreach ($value as $kkey => $act)
                                    {
                                        if($action == $act)
                                        {
                                            return true;
                                        }
                                    }
                                }
                            }
                            else if($value == $action)
                            {
                                return true;
                            }
                            else if($value == '*')
                            {
                                return true;
                            }
                            else
                            {
                                return false;
                            }
                        }
                        else if($key == '~')
                        {
                            foreach ($value as $act)
                            {
                                if($action == $act)
                                {
                                    return false;
                                }
                            }
                            return true;
                        }
                    }
                    return false;
            }
        }
    }