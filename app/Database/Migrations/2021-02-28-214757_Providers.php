<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Providers extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'constraint' => 11,
				'auto_increment' => true,
				'unsigned' => true
			],
			'name'=>[
				'type'=>'VARCHAR',
				'constraint'=>24,
				'unique'=>true
			]
		]);

		$this->forge->addKey('id', true)->createTable('providers');
	}

	public function down()
	{
		$this->forge->dropTable('providers');

	}
}
