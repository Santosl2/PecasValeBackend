<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPeca extends Migration
{
	public function up()
	{
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'image' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'datetime',
            ],
            'created_at datetime default current_timestamp'
        ]);

        $this->forge->addKey('id', true)->createTable('pecas');
    }

    public function down()
    {
        $this->forge->dropTable('pecas');
    }
}
