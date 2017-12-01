<?php

// havn't run yet.. 
class Migration_create_comp_values extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '120',
            ),
            'user_id' => array(
                'type' => 'int',
                'constraint' => 11,
            ),
            'parent_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'default' => 0,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('strength');
    }

    public function down() {
        $this->dbforge->drop_table('competency');
    }

}
