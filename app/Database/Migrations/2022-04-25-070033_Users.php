<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration{

    public function up(){

        $this->forge->addField([

            'iduser'             => [
                'type'           => 'SERIAL',
                'unsigned'       => true,
                'auto_increment' => true,
                'null'           => false
            ],
            'username'       => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false
            ],
            'userlastname'   => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false
            ],
            'email'          => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => false,
                'unique'     => true
            ],
            'userpassword'   => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false
            ],
            'category'       => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
                'null'       => false
            ],
            'deletedu'       => [
                'type'       => 'DATE',
                'null'       => true
            ],
            'created_at'     => [
                'type'       => 'DATE',
                'null'       => true
            ],
            'updated_at'     => [
                'type'       => 'DATE',
                'null'       => true
            ]
        ]);
        
        $this->forge->addKey('iduser', true);
        $this->forge->createTable('users');

    }

    public function down(){

        $this->forge->dropTable('users');
    }
}

