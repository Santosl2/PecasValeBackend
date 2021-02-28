<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addpecaprice extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'pecaId' => [
				'type' => 'INT',
				'null'=>false
			],
			'providerId' => [
				'type' => 'INT',
				'null'=>false
			],
			'price' => [
				'type' => 'DECIMAL',
				'constraint' => '13,2'
			]
		])->createTable('pecas_price');
		
	}

	public function down()
	{
		//
	}
}
