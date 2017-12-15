<?php

Class Skills_m extends My_Model {

    protected $_table_name = 'kompetenzm.skills';
    protected $_order_by = '';
    public $rules = array();
    public $rules_admin = array();

    public function __construct() {
        parent::__construct();
    }

    public function skillArray() {
        $select = 'SELECT id, name';
        $skills = parent::get(NULL, FALSE, FALSE, $select);
        $array = array(0 => 'Keine');
        if (count($skills)) {
            foreach ($skills as $skill) {
                $array[$skill->ID] = $skill->NAME;
            }
        }
        return $array;
    }

    public function getJobTitleComp($id = null) {
        $query = $this->db->query("SELECT t4.id,t4.name as comp_name,t1.name AS skill_name
                                                    FROM $this->_table_name as t1
                                                    LEFT JOIN kompetenzm.job_title_has_comp as t2 ON t1.id = t2.skill_value
                                                    LEFT JOIN kompetenzm.job_title as t3 ON t3.id = t2.job_title_id
                                                    LEFT JOIN kompetenzm.competency as t4 ON t4.id = t2.competency_id
                                                    WHERE t3.id = '" . $id . "';
                                                    ");
        $results = $query->result_array();
        $array = array();
        foreach ($results as $res) {
            $array[$res['ID']] = $res['SKILL_NAME'];
        }
        return $array;
    }

}
