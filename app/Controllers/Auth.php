<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use ReflectionException;

class Auth extends BaseController
{
    /**
     * Register a new user
     * @return Response
     * @throws ReflectionException
     */

    public function register()
    {
        $rules = [
            'username' => 'required',
            'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]|max_length[72]'
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules)) {
            return $this->getResponse(
                $this->validator->getErrors(),
                ResponseInterface::HTTP_BAD_REQUEST
            );
        }

        $userModel = new UserModel();
        $userModel->save($input);

        return $this->getJWT(
            $input['email'],
            ResponseInterface::HTTP_CREATED
        );
    }

    /**
     * Login users
     * @return Response
     */

    public function login()
    {
        $rules = [
            'email' => 'required|min_length[6]|max_length[92]|valid_email',
            'password' => 'required|min_length[8]|max_length[100]|validateUser[email, password]'
        ];

        $errors = [
            'password' => [
                'validateUser' => "Oops, informações de login inválidas."
            ]
        ];

        $input = $this->getRequestInput($this->request);

        if (!$this->validateRequest($input, $rules, $errors)) {
            return $this
                ->getResponse(
                    $this->validator->getErrors(),
                    ResponseInterface::HTTP_BAD_REQUEST
                );
        }

        return $this->getJWT($input['email']);

    }

    private function getJWT(string $email, int $responseCode = ResponseInterface::HTTP_OK)
    {
        try {
            $model = new UserModel();
            $user = $model->getUserByEmail($email);
            unset($user['password']);
            unset($user['id']);

            helper('jwt');

            return $this
                ->getResponse(
                    [
                        'message' => 'Sucesso!',
                        'user' => $user,
                        'access_token' => getSignedJWTForUser($email)
                    ]
                );
        } catch (Exception $exception) {
            return $this
                ->getResponse(
                    [
                        'error' => $exception->getMessage(),
                    ],
                    $responseCode
                );
        }
    }
}
