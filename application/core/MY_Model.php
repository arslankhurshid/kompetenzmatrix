<?php

Class My_Model extends CI_Model {

    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    public $rules = array();
    protected $_timestamps = FALSE;

    function __construct() {
        parent::__construct();
    }

    public function get($id = Null, $single = FALSE, $where = FALSE, $select = FALSE) {
        if ($id != Null) {

            $filter = $this->_primary_filter;
            $id = $filter($id);
            $where = 'WHERE ' . $this->_primary_key . '=' . $id;
            $method = 'row';
        } elseif ($single == TRUE) {
            $method = 'row';
        } else {
            $method = 'result_object';
        }
        if ($select == '') {
            $select = 'SELECT *';
        }
        if ($where == '') {
            $where = '';
        }
        $query = $this->db->query("$select FROM $this->_table_name $where ");
        $result = $query->$method();
        return $result;
    }

    public function get_by($where, $single = FALSE) {
        $output = 'WHERE ';
        $output .= implode(' AND ', array_map(
                        function ($v, $k) {
                    if (is_array($v)) {
                        return $k . '[]=' . implode('&' . $k . '[]=', $v);
                    } else {
                        return $k . '=' . "'$v'";
                    }
                }, $where, array_keys($where)
        ));
        return $this->get(NULL, $single == TRUE, $output);
    }

    public function save($data, $id = Null) {
        //set timestamps
        if ($this->_timestamps === TRUE) {
            $now = date('Y-m-d H:i:s');
            if ($id) {
                $data['modified'] = $now;
            } else {
                $data['created'] = $now;
                $data['modified'] = $now;
            }
        }
        // insert
        if ($id === Null) {
            foreach ($data as $key => $val) {
                $values[] = "'$val'";
                $keys[] = $key;
            }

            $query = $this->db->query("INSERT INTO $this->_table_name (" . implode(',', $keys) . ") VALUES (" . implode(',', $values) . ")");
            print_r($this->db->error());
            return TRUE;
        }
        //update
        else {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $where = $this->_primary_key . '=' . $id;
            foreach ($data as $key => $val) {
                $query = $this->db->query("UPDATE $this->_table_name SET $key = '$val' WHERE $where");
            }
        }
    }

    public function array_from_post($fields) {
        $data = array();
        foreach ($fields as $field) {

            $data[$field] = $this->input->post($field);
        }
        return $data;
    }

    public function delete($id) {
        $filter = $this->_primary_filter;
        $id = $filter($id);

        if (!$id) {
            return FALSE;
        }
        $where = $this->_primary_key . '=' . $id;
        $query = $this->db->query("DELETE FROM $this->_table_name WHERE $where");
    }

    public function get_total() {
        $query = $this->db->query("SELECT COUNT(*) as NUMROWS FROM $this->_table_name");
        $result = $query->row();
        return $result->NUMROWS;
    }

}
