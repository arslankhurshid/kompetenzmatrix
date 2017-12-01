<?php

class Migration_create_user_has_comp extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'int',
                'constraint' => 11,
            ),
            'competency_id' => array(
                'type' => 'int',
                'constraint' => 11,
            ),
            'skill_value' => array(
                'type' => 'int',
                'constraint' => 11,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('user_has_comp');
    }

    public function down() {
        $this->dbforge->drop_table('user_has_comp');
    }

}
