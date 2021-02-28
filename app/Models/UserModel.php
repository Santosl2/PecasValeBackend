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
