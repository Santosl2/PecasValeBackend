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
		
		$firstQuery = $this->adapter->query("SELECT p.id, p.name, p.image FROM `pecas` p")->getResultArray();
		
		
		foreach($firstQuery as $key => $value)
		{
			$id = $value['id'];
			$pricesQuery = $this->adapter->query("SELECT DISTINCT p.price as value, pv.name FROM pecas_price p RIGHT OUTER JOIN providers pv ON (pv.id = p.providerId) WHERE p.pecaId = $id")->getResultArray();

			$firstQuery[$key]['prices'] = $pricesQuery;
		}

		echo json_encode($firstQuery);


	}
}
