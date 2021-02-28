<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Adduser extends Migration
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
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => 92,
				'unique' => true,
			],

			'email' => [
				'type' => 'VARCHAR',
				'constraint' => 92,
				'unique' => true,
			],

			'password' => [
				'type' => 'VARCHAR',
				'constraint' => 92
			]
		])
		->addKey('id', true)
		->createTable('users');

	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}
