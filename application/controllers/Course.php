<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH . '/libraries/REST_Controller.php';

    class Course extends REST_Controller
    {
        function __construct()
        {
            // Construct the parent class
            parent::__construct();
            $this->load->model(['courses_model']);

        }

        public function index_get()
        {
            $courses = $this->courses_model->TraeCourses();

            $id = $this->get('course_url');

            // If the id parameter doesn't exist return all the users

            if($id === null)
            {
                // Check if the users data store contains courses (in case the database result returns NULL)
                if($courses)
                {
                    // Set the response and exit
                    $this->response($courses, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
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

            // Get the user from the array, using the id as key for retreival.
            // Usually a model is to be used for this.

            $course = null;

            if(!empty($courses))
            {
                foreach ($courses as $key => $value)
                {
                    if(NormalizeAccents(strtolower($value['TITLE'])) == $id)
                    {
                        $course = $value;
                        break;
                    }
                }
            }

            if(!empty($course))
            {
                if(is_null($this->get('lesson')))
                {
                    $course['PREV_TEST'] = $this->courses_model->EnrollUSer($this->get('user_email'), $course['ID_COURSE']);
                    $course['LECTIONS'] = $this->courses_model->TraeLections($course['ID_COURSE']);
                }
                else
                {
                    $course['LESSON'] = $this->courses_model->getLesson($this->get('lesson'), $course['ID_COURSE']);
                    $course['TEST'] = $this->courses_model->getResultLesson($this->get('user_email'), $course['ID_COURSE'], $this->get('lesson'));
                }
                $this->set_response(['status' => true, 'data' => $course], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
            else
            {
                $this->set_response([
                    'status' => false,
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            }
        }

        public function prevtest_get()
        {
            $this->courses_model->SavePrevTestResult($this->get('score'), $this->get('user_email'), $this->get('course_url'));
            $this->response(['status' => true], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }

        public function test_get()
        {
            $this->courses_model->SaveTestResult($this->get('score'), $this->get('user_email'), $this->get('course_url'), $this->get('lesson'));
            $this->response(['status' => true], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }

        public function registerattempt_get()
        {
            $this->courses_model->RegisterAttempt($this->get('user_email'), $this->get('course_url'));
            $this->response(['status' => true], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }

        public function attempt_get()
        {
            $attempt = $this->courses_model->getAttempt($this->get('user_email'), $this->get('course_url'));
            $this->response(['status' => true, 'data' => $attempt], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
    }
