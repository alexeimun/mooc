<?php

    Class courses_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function attributes()
        {
            return [
                'TITLE' => [
                    'label' => 'Título',
                    'placeholder' => 'Título del curso',
                    'class' => '',
                    "required" => "required",
                ],
                'DESCRIPTION' => [
                    'label' => 'Descripción',
                    'placeholder' => 'Descripción del curso',
                    'class' => '',
                    "required" => "required",
                ],
                'IMAGE' => [
                    'label' => 'Imagen',
                    'placeholder' => 'Ingrese url de la imagen que aparecerá en la presentación del curso',
                    'class' => '',
                    "required" => "required",
                ],
                'DURATION' => [
                    'label' => 'Duración',
                    "placeholder" => "semanas",
                    "min" => 1,
                    "max" => 999,
                    'class' => '',
                    "required" => "required",
                ],
                'STARTS_IN' => [
                    'label' => 'Empieza en',
                    'class' => '',
                    "required" => "required",
                ],
                'ID_TEACHER' => [
                    'label' => 'Profesor',
                    'placeholder' => 'Seleccione profesor',
                    'class' => '',
                    "required" => "required",
                ],
            ];
        }

        public function TraeCourse($IdCourse)
        {
            $Course = $this->db->query("SELECT
            			t_courses.ID_COURSE,
			t_courses.TITLE,
			t_courses.DESCRIPTION,
			t_courses.IMAGE,
			t_courses.DURATION,
			t_courses.STARTS_IN,
			t_courses.REG_DATE

			FROM t_courses

			WHERE ID_COURSE = '$IdCourse'");
            return $Course->num_rows() > 0 ? $Course->result()[0] : null;
        }

        public function Contar()
        {
            return $this->db->count_all_results('t_courses');
        }

        public function ActualizarCourse()
        {
            $IdCourse = array_shift($_POST);
            $this->db->update('t_courses', $this->input->post(null, true), ['ID_COURSE' => $IdCourse]);
        }

        public function InsertarCourse()
        {
            $data = $this->input->post(null, true);
            $IdTeacher = array_pop($data);
            $this->db->insert('t_courses', $data);

            $IdCourse = $this->db->select_max('ID_COURSE')->get('t_courses')->result()[0]->ID_COURSE;
            $this->db->insert('t_course_teachers', ['ID_COURSE' => $IdCourse, 'ID_TEACHER' => $IdTeacher]);
        }

        public function TraeTeachersDropdown()
        {
            return $this->db->select("ID_MANAGER AS ID_TEACHER, MANAGER_NAME AS TEACHER_NAME")->get('t_managers')->result('array');
        }

        public function getResultLesson($email, $courseName, $lesson)
        {
            $IdUser = $this->getUserByEmail($email);
            $IdCourse = $this->getCourseByName($courseName)['ID_COURSE'];
            $query = $this->db->get_where('t_result_tests', ['ID_USER' => $IdUser, 'ID_COURSE' => $IdCourse, 'LESSON_NUMBER' => $lesson], 1);

            if($query->num_rows() > 0)
            {
                return $query->result_array()[0];
            }
            return null;
        }

        public function SavePrevTestResult($score, $email, $courseName)
        {
            $IdUser = $this->getUserByEmail($email);
            $IdCourse = $this->getCourseByName($courseName)['ID_COURSE'];
            $this->db->insert('t_result_tests', ['ID_COURSE' => $IdCourse, 'ID_USER' => $IdUser, 'SCORE' => $score]);
            $this->db->update('t_enrolled', ['PREV_TEST' => 1], ['ID_COURSE' => $IdCourse, 'ID_USER' => $IdUser]);
        }

        public function RegisterAttempt($email, $courseName)
        {
            $IdUser = $this->getUserByEmail($email);
            $IdCourse = $this->getCourseByName($courseName)['ID_COURSE'];
            $this->db->query("update t_enrolled set PREV_TEST_ATTEMPTS=PREV_TEST_ATTEMPTS+1 WHERE ID_USER=$IdUser && ID_COURSE=$IdCourse");
        }

        public function GetAttempt($email, $courseName)
        {
            $IdUser = $this->getUserByEmail($email);
            $IdCourse = $this->getCourseByName($courseName)['ID_COURSE'];
            $attempt = $this->db->select('PREV_TEST_ATTEMPTS')->get_where('t_enrolled', ['ID_COURSE' => $IdCourse, 'ID_USER' => $IdUser], 1);
            return $attempt->num_rows() > 0 ? $attempt->result_array()[0]['PREV_TEST_ATTEMPTS'] : 0;
        }

        public function SaveTestResult($score, $email, $courseName, $lesson)
        {
            $IdUser = $this->getUserByEmail($email);
            $IdCourse = $this->getCourseByName($courseName)['ID_COURSE'];
            $this->db->insert('t_result_tests', ['ID_COURSE' => $IdCourse, 'ID_USER' => $IdUser, 'SCORE' => $score, 'LESSON_NUMBER' => $lesson]);
        }

        public function getCourseByName($name)
        {
            $courses = $this->TraeCourses();
            $course = null;
            if(!empty($courses))
            {
                foreach ($courses as $key => $value)
                {
                    if(NormalizeAccents(strtolower($value['TITLE'])) == $name)
                    {
                        $course = $value;
                        break;
                    }
                }
            }
            return $course;
        }

        public function TraeLections($IdCourse)
        {
            $limit = 1;
            if(date('m') == 10 && date('d') >= 1 && date('d') < 7)
            {
                $limit = 2;
            }
            else if(date('m') == 10 && date('d') > 7)
            {
                $limit = 3;
            }
            return $this->db->get_where('t_lections', ['ID_COURSE' => $IdCourse], $limit)->result_array();
        }

        public function hasPrevTest($IdUser)
        {
            return @$this->db->get_where('t_enrolled', ['ID_USER' => $IdUser])->result_array()[0]['PREV_TEST'] == 0;
        }

        public function getLesson($lesson, $IdCourse)
        {
            return @$this->db->get_where('t_lections', ['ID_COURSE' => $IdCourse, 'LESSON_NUMBER' => $lesson], 1)->result_array()[0];
        }

        public function EnrollUSer($email, $IdCourse)
        {
            $IdUser = $this->getUserByEmail($email);
            if(!$this->isEnrolledUSer($IdUser, $IdCourse))
            {
                $this->db->insert('t_enrolled', ['ID_COURSE' => $IdCourse, 'ID_USER' => $IdUser]);
            }

            return $this->hasPrevTest($IdUser);
        }

        public function getUserByEmail($email)
        {
            return $this->db->select('ID_USER')->get_where('t_users', ['EMAIL' => $email])->result_array()[0]['ID_USER'];
        }

        public function isEnrolledUSer($IdUser, $IdCourse)
        {
            return $this->db->get_where('t_enrolled', ['ID_COURSE' => $IdCourse, 'ID_USER' => $IdUser])->num_rows() > 0;
        }

        public function TraeCourses()
        {
            $courses = $this->db->query("SELECT
            t_courses.ID_COURSE,
			t_courses.TITLE,
			t_managers.MANAGER_NAME AS TEACHER_NAME,
			t_courses.DESCRIPTION,
			t_courses.IMAGE,
			t_courses.DURATION,
			t_courses.STARTS_IN,
			t_courses.REG_DATE,
			count(t_users.ID_USER) AS STUDENTS
			
			FROM t_courses
			INNER JOIN t_course_teachers ON t_course_teachers.ID_COURSE=t_courses.ID_COURSE
				INNER JOIN t_managers ON t_course_teachers.ID_TEACHER=t_managers.ID_MANAGER
			LEFT JOIN t_enrolled ON t_enrolled.ID_COURSE=t_courses.ID_COURSE
			LEFT JOIN t_users ON t_users.ID_USER=t_enrolled.ID_USER
			
			GROUP BY t_courses.ID_COURSE")->result('array');

            foreach ($courses as $key => $course)
            {
                $courses[$key]['URL_NAME'] = NormalizeAccents(strtolower($course['TITLE']));
                $courses[$key]['IMAGE'] = base_url('/assets/images/courses/' . $courses[$key]['IMAGE']);
            }
            return $courses;
        }

        public function EliminarCourse()
        {
            $this->db->delete('t_courses', ['ID_COURSE' => $this->input->post('Id')]);
        }
        ######################## REST QUERIES ###########

    }