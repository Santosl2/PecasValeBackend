<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class UserModel extends Model
{
	protected $table = 'users';
	protected $allowedFields = [
		'username',
		'email',
		'password'
	];

	protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
	
	protected function beforeInsert(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    protected function beforeUpdate(array $data): array
    {
        return $this->getUpdatedDataWithHashedPassword($data);
    }

    private function getUpdatedDataWithHashedPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $plaintextPassword = $data['data']['password'];
            $data['data']['password'] = $this->hashPassword($plaintextPassword);
        }
        return $data;
    }

	private function hashPassword(string $password): string{
		return password_hash($password, PASSWORD_BCRYPT);
	}

	public function getUserByEmail(string $email): array
	{
		$user = $this
			->asArray()
			->where(['email' => $email])
			->first();

		if (!$user)
			throw new Exception("Oops, nenhum usuário encontrado.");

		return $user;
	}
}
