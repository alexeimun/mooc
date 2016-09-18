<?php

    Class tests_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function attributes()
        {
                return [
                'ID_LECTION' => [
					'label' => 'Id lection',
					'placeholder' => '--- Selecione lections ---',
					'class' => '',
				],
					'TEST_TITLE' => [
					'label' => 'Test title',
					'placeholder' => 'Ingrese test title',
					'class' => '',
				],
					'TEST_DESCRIPTION' => [
					'label' => 'Test description',
					'placeholder' => 'Ingrese test description',
					'class' => '',
				],
                 ];
        }
        public function TraeTest($IdTest)
        {
            $Test = $this->db->query("SELECT
            			t_tests.ID_TEST,
			t_tests.ID_LECTION,
			t_tests.TEST_TITLE,
			t_tests.TEST_DESCRIPTION,
			t_tests.REG_DATE

			FROM t_tests

			WHERE ID_TEST = '$IdTest'");
            return $Test->num_rows() > 0 ? $Test->result()[0] : null;
        }

        public function Contar()
        {
            return $this->db->count_all_results('t_tests');
        }

        public function ActualizarTest()
        {
            $IdTest = array_shift($_POST);
            $this->db->update('t_tests', $this->input->post(null, true), ['ID_TEST' =>$IdTest]);
        }

        public function InsertarTest()
        {
                    $this->db->insert('t_tests', $this->input->post(null, true));
        }

        public function TraeTests()
        {
            return $this->db->query("SELECT
           			t_tests.ID_TEST,
			t_tests.ID_LECTION,
			t_tests.TEST_TITLE,
			t_tests.TEST_DESCRIPTION,
			t_tests.REG_DATE

			FROM t_tests")->result('array');
        }
             
            public function TraeLectionsDD()
            {
                return $this->db->query("SELECT
                			t_lections.LECTION_TITLE,
			t_lections.ID_LECTION

			FROM t_lections")->result('array');
            }

                    
    public function EliminarTest()
    {
        $this->db->delete('t_tests', ['ID_TEST' => $this->input->post('Id')]);
    }
}