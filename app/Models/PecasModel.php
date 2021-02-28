<?php

namespace App\Models;

use Config\Database;
use CodeIgniter\Model;
use Exception;

class PecasModel extends Model
{
	public function __construct()
	{
		$this->adapter = Database::connect();
	}

	public function getAll()
	{
		return $this->adapter->query("SELECT * FROM users")->getResultArray();
	}
}
