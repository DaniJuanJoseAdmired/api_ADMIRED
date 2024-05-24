<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ResidentModel;

class Resident extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $residentes = new ResidentModel;
    return $this->respond(['Resident' => $residentes->findAll()], 200);
    }
}
