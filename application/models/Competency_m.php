<?php

Class Competency_m extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $_table_name = 'kompetenzm.competency';
    protected $_order_by = '';
    public $rules = array(
        'parent_id' => array(
            'field' => 'parent_id',
            'label' => 'Parent',
            'rules' => 'trim|intval'
        ),
        'name' => array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
    );

    public function get_new() {
        $competency = new stdClass();
        $competency->NAME = '';
        $competency->PARENT_ID = 0;

        return $competency;
    }

    public function getLabels() {
        $query = $this->db->query("SELECT name FROM $this->_table_name WHERE parent_id != 0");
        $skills = $query->result_array();
        $response = array();
        foreach ($skills as $key => $val) {
            $response[] = $val['NAME'];
        }

        return $response;
    }

    public function delete($id) {
        //delete a competency
        parent::delete($id);
        //Reset parent id for its children
        $query = $this->db->query("DELETE FROM $this->_table_name WHERE $this->_table_name.parent_id = $id");
    }

    public function get_nested() {
        $query = $this->db->query("SELECT * FROM $this->_table_name ORDER BY order ASC");
        $competencies = $query->result_array();
        $array = array();
        foreach ($competencies as $competency) {
            if (!$competency['PARENT_ID']) {
                $array[$competency['ID']] = $competency;
            } else {
                $array[$competency['PARENT_ID']]['CHILDREN'][] = $competency;
            }
        }

        return $array;
    }

    public function save_order($competencies) {
        if (count($competencies)) {
            foreach ($competencies as $order => $competency) {
                if ($competency['item_id'] !== '') {
                    $data = array('parent_id' => (int) $competency['parent_id'], 'order' => $order);
                    $parent_id = (int) $competency['parent_id'];
                    $where = $this->_primary_key . '=' . $competency['item_id'];
                    $query = $this->db->query("UPDATE $this->_table_name SET parent_id = $parent_id , order = $order WHERE $where");
                }
            }
        }
    }

    public function get_with_parent($limit = null, $perpage = null) {

        if ($limit != '') {
            $limit = $limit . ',' . $perpage;
        } else {
            $limit = '';
        }
        $query = $this->db->query("SELECT $this->_table_name.*,p.name as parent_name FROM $this->_table_name
                                                             LEFT JOIN kompetenzm.competency as p ON $this->_table_name.parent_id=p.id
                                                             $limit");
        $result = $query->result_object();
        return $result;
    }

    public function getSubCompArray() {
        // get sub competency against parent competency in array for drop down
        $select = 'SELECT id,name';
        $where = 'parent_id !=0';
        $categories = parent::get(null, FALSE, $where, $select);
        $array = array();
        if (count($categories)) {
            foreach ($categories as $category) {
                $array[$category->ID] = $category->NAME;
            }
        }
        return $array;
    }

    public function getParentChild($id = null) {
        $query = $this->db->query("SELECT id,name,parent_id FROM $this->_table_name");
        $competencies = $query->result_array();
        $array = array();
        foreach ($competencies as $key => $competency) {
            if (!$competency['PARENT_ID']) {
                $array[$competency['ID']] = $competency;
            } else {
                $array[$competency['PARENT_ID']]['CHILD'][$competency['ID']] = $competency['NAME'];
            }
        }
        return $array;
    }

    public function get_no_parents($id = null) {
        // Fetch all competencys w/out parents
        // Return key => value pair array
        if ($id == '') {
            $id = '';
        } else {
            $id = 'AND id !=' . $id;
        }
        $query = $this->db->query("SELECT id,name FROM $this->_table_name WHERE parent_id=0 $id");
        $competencies = $query->result_object();
        $array = array(0 => 'Keine');

        if (count($competencies)) {
            foreach ($competencies as $competency) {
                $array[$competency->ID] = $competency->NAME;
                if ($id != null) {
                    $parents = $this->get_with_parent();
                    $parentID = array();
                    foreach ($parents as $parent) {
                        $parentID[$parent->PARENT_ID] = $parent->PARENT_NAME;
                        if ($parent->PARENT_ID == $id) {
                            unset($array[$competency->ID]);
                        }
                    }
                }
            }
        }
        return $array;
    }

}
