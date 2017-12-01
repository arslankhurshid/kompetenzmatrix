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

}
