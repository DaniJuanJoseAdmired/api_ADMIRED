<?php

namespace App\Controllers;

use App\Controllers\BaseController; 
use App\Models\UsuariosModel;
use CodeIgniter\HTTP\ResponseInterface;

class Usuarios extends BaseController
{
    public function create()
    {
        $dataResult = [];
        $usuarioModel = new UsuariosModel();

        $data = [
            'NOMBRE' => $this->request->getPost('NOMBRE'),
            'APELLIDO' => $this->request->getPost('APELLIDO'),
            'TIPO_DOCUMENTO_ID' => $this->request->getPost('TIPO_DOCUMENTO_ID'),
            'NO_DOCUMENTO' => $this->request->getPost('NO_DOCUMENTO'),
            'FECHA_NACIMIENTO' => $this->request->getPost('FECHA_NACIMIENTO'),
            'EMAIL' => $this->request->getPost('EMAIL'),
            'CONTRASENA' => password_hash($this->request->getVar('CONTRASENA'), PASSWORD_DEFAULT),
            'TELEFONO' => $this->request->getPost('TELEFONO'),
            'CARGO_ID' => $this->request->getPost('CARGO_ID'),
            'TORRE' => $this->request->getPost('TORRE'),
            'APTO' => $this->request->getPost('APTO'),
        ];

        if ($usuarioModel->insert($data)) {
            $dataResult["data"] = $data;
            $dataResult["messaje"] = 'Usuario Creado';
            $dataResult["response"] = ResponseInterface::HTTP_OK;
        } else {
            $dataResult["data"] = '';
            $dataResult["messaje"] = 'Error al crear usuario';
            $dataResult["tresponse"] = ResponseInterface::HTTP_CONFLICT;
        }
        return json_encode($dataResult);
    }
}
