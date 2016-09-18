<?php

    Class Users_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function getUsers()
        {
            return $this->db->get('t_users')->result_array();
        }

        public function getUser($user)
        {
            $key = $this->VerifyEmail($user) ? 'EMAIL' : 'USERNAME';
            return $this->db->where($key, $user)->get('t_users')->result_array()[0];
        }

        public function postUser(&$data)
        {
            if(!$this->VerifyEmail($data['EMAIL']))
            {
                #If it is a google user
                if(!isset($data['USERNAME']))
                {
                    $username = $data['USERNAME'] = explode('@', $data['EMAIL'])[0];
                    while ($this->VerifyUsername($username))
                    {
                        $username = $data['USERNAME'] + rand(0, 99);
                    }
                    $data['USERNAME'] = $username;
                    $this->db->insert('t_users', $data);
                    return true;
                }
                #Normal user
                else if(!$this->VerifyUsername($data['USERNAME']))
                {
                    $data['IMAGE_URL'] = site_url('/assets/images/avatar.png');
                    $data['TOKEN_ID'] = md5($data['USERNAME'] . time());
                    $data['NAME'] = $data['USERNAME'];

                    $this->db->insert('t_users', $data);
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else if($this->TypeUser($data['EMAIL'], 1))
            {
                $data['USERNAME'] = $this->getUser($data['EMAIL'])['USERNAME'];
                $this->db->update('t_users', ['TOKEN_ID' => $data['TOKEN_ID']], ['EMAIL' => $data['EMAIL']]);
                return true;
            }
            else
            {
                return false;
            }
        }

        public function userLogin(&$user)
        {
            if($this->VerifyUser($user))
            {
                $key = $this->VerifyEmail($user['USER_AUTH']) ? 'EMAIL' : 'USERNAME';
                $this->db->update('t_users', ['TOKEN_ID' => md5($user['USER_AUTH'] . time())], [$key => $user['USER_AUTH']]);
                return true;
            }
            else
            {
                return false;
            }
        }

        public function VerifyEmail($email)
        {
            return $this->db->query("SELECT ID_USER FROM t_users WHERE EMAIL = '$email'")->num_rows() > 0;
        }

        public function VerifyUsername($username)
        {
            return $this->db->query("SELECT ID_USER FROM t_users WHERE USERNAME = '$username'")->num_rows() > 0;
        }

        public function TypeUser($email, $type)
        {
            return $this->db->query("SELECT ID_USER FROM t_users WHERE TYPE_USER = $type AND  EMAIL = '$email'")->num_rows() > 0;
        }

        public function VerifyUser($user)
        {
            $passwd = $user['PASSWORD'];
            $user = $user['USER_AUTH'];
            return $this->db->query("SELECT ID_USER FROM t_users 
                WHERE (USERNAME = '$user' OR EMAIL = '$user') AND t_users.PASSWORD = '$passwd'")->num_rows() > 0;
        }
    }