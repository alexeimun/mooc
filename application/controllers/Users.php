<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH . '/libraries/REST_Controller.php';

    class Users extends REST_Controller
    {
        function __construct()
        {
            // Construct the parent class
            parent::__construct();
        }

        public function index_get()
        {
            $users = $this->users_model->getUsers();

            $id = $this->get('id');

            // If the id parameter doesn't exist return all the users

            if($id === null)
            {
                // Check if the users data store contains users (in case the database result returns NULL)
                if($users)
                {
                    // Set the response and exit
                    $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
                }
                else
                {
                    // Set the response and exit
                    $this->response([
                        'status' => false,
                        'message' => 'No users were found',
                    ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
                }
            }

            // Find and return a single record for a particular user.

            $id = (int)$id;

            // Validate the id.
            if($id <= 0)
            {
                // Invalid id, set the response and exit.
                $this->response(null, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // Get the user from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $user = null;

            if(!empty($users))
            {
                foreach ($users as $key => $value)
                {
                    if(isset($value['ID_USER']) && $value['ID_USER'] == $id)
                    {
                        $user = $value;
                        break;
                    }
                }
            }

            if(!empty($user))
            {
                $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => false,
                    'message' => 'User could not be found',
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        public function userlogin_post()
        {
            $data = $this->post(null, true);
            if(!empty($data) || !is_null($data))
            {
                if($this->users_model->userLogin($data))
                {
                    $this->set_response(['status' => true, 'data' => $this->users_model->getUser($data['USER_AUTH'])], REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response(['status' => false], REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->response(null, REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function validateuser_get()
        {
            $field = $this->get('field', true);
            $type = $this->get('type', true);
            if(!empty($field) && !empty($type))
            {
                if($type == 'username')
                {
                    $this->set_response(['status' => true, 'response' => $this->users_model->VerifyUsername($field)], REST_Controller::HTTP_OK);
                }
                else if($type == 'email')
                {
                    $this->set_response(['status' => true, 'response' => $this->users_model->VerifyEmail($field)], REST_Controller::HTTP_OK);
                }
                else
                {
                    $this->response(null, REST_Controller::HTTP_BAD_REQUEST);
                }
            }
            else
            {
                $this->response(null, REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function index_post()
        {
            $data = $this->post(null, true);
            if(!empty($data) || !is_null($data))
            {
                if($this->users_model->postUser($data))
                {
                    // CREATED (201) being the HTTP response code
                    $this->set_response(['status' => true, 'data' => $data, 'message' => 'successfully source added'], REST_Controller::HTTP_CREATED);
                }
                else
                {
                    $this->response(['status' => false, 'message' => 'The username or email already exist'], REST_Controller::HTTP_OK);
                }
            }
            else
            {
                $this->response(null, REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function index_put()
        {
            //$this->some_model->update_user(...);
            $message = [
                'id' => 100, // Automatically generated by the model
                'name' => $this->post('name'),
                'email' => $this->post('email'),
                'message' => 'Added a resource',
            ];

            $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
        }

        public function index_delete()
        {
            $id = (int)$this->get('id');

            // Validate the id.
            if($id <= 0)
            {
                // Set the response and exit
                $this->response(null, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
            }

            // $this->some_model->delete_something($id);
            $message = [
                'id' => $id,
                'message' => 'Deleted the resource',
            ];

            $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
        }
    }
