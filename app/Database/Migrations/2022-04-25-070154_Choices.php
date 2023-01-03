<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Choices extends Migration{

    public function up(){

        $this->forge->addField([

            'idchoice'           => [
                'type'           => 'SERIAL',
                'unsigned'       => true,
                'auto_increment' => true,
                'null'           => false
            ],
            'idchoicequestion'   => [
                'type'           => 'INT',
                'null'           => false
            ],
            'iscorrect'     => [
                'type'      => 'INT',
                'null'      => false
            ],
            'choice'         => [
                'type'       => 'VARCHAR',
                'constraint' => '300',
                'null'       => false
            ],
            'deletedchoice'   => [
                'type'        => 'DATE',
                'null'        => true
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
        
        $this->forge->addKey('idchoice', true);
        $this->forge->addForeignKey('idchoicequestion', 'questions', 'idquestion', 'CASCADE', 'CASCADE');
        $this->forge->createTable('choices');
        
    }

    public function down(){

        $this->forge->dropTable('choices');
        
    }
}
