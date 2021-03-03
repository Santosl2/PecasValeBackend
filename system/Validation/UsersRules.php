<?php

namespace CodeIgniter\Validation;

use App\Models\UserModel;
use Exception;

class UsersRules
{
    public function validateUser(string $str, string $fields, array $data): bool
    {
        try {
            $model = new UserModel();
            $user = $model->getUserByEmail($data['email']);
            return password_verify($data['password'], $user['password']);
        } catch (Exception $e) {
            return false;
        }
    }
}