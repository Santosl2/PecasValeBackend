<?php

namespace App\Controllers;

use App\Models\PecasModel;
use App\Models\UserModel;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;
use ReflectionException;

class Pecas extends BaseController
{
    /**
     * Register a new user
     * @return Response
     * @throws ReflectionException
     */

    public function index()
    {
        $pp = (new PecasModel())->getAll();
        var_dump($pp);
    }
}
