<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ResidentModel;

class Resident extends BaseController
{
    use ResponseTrait;

    public function create()
    {
        $residentes = new ResidentModel();

        $data = [
            'NO_TORRE' => $this->request->getPost('NO_TORRE'),
            'NO_APARTAMENTO' => $this->request->getPost('NO_APARTAMENTO'),
            'NOMBRE_PROPIETARIO' => $this->request->getPost('NOMBRE_PROPIETARIO'),
            'ESTADO' => $this->request->getPost('ESTADO'),
        ];
        
        if ($ResidentModel->insert($data)) {
            $dataResult = [
                "data" => $data,
                "message" => 'residente ha sido Creado',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Error al crear un residente',
                "response" => ResponseInterface::HTTP_CONFLICT,
            ];
        }

        return $this->response->setJSON($dataResult);
    }

    public function index()
    {
        $residentes = new ResidentModel;
    return $this->respond(['Resident' => $residentes->findAll()], 200);
    }

    public function show($id)
    {
        $ResidentModel = new ResidentModel();
        $residentes = $ResidentModel->find($id);

        if ($residentes) {
            $dataResult = [
                "data" => $residentes,
                "message" => 'Residente ha sido Encontrado',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Residente no ha sido encontrado',
                "response" => ResponseInterface::HTTP_NOT_FOUND,
            ];
        }

        return $this->response->setJSON($dataResult);
    }

    public function update($id)
    {
    $ResidentModel = new ResidentModel();

   
    $usuario = $usuarioModel->find($id);

    if ($residentes) {
        $data = [
            'NO_TORRE' => $this->request->getVar('NO_TORRE') ?? $usuario['NO_TORRE'],
            'NO_APARTAMENTO' => $this->request->getVar('NO_APARTAMENTO') ?? $usuario['NO_APARTAMENTO'],
            'NOMBRE_PROPIETARIO' => $this->request->getVar('NOMBRE_PROPIETARIO') ?? $usuario['NOMBRE_PROPIETARIO'],
            'ESTADO' => $this->request->getVar('ESTADO') ?? $usuario['ESTADO'],
        ];

        if ($ResidentModel->update($id, $data)) {
            $dataResult = [
                "data" => $data,
                "message" => 'Residente ha sido actualizado',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Error al actualizar al Residente',
                "response" => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
            ];
        }
    } else {
        $dataResult = [
            "data" => '',
            "message" => 'Residente no ha sido encontrado',
            "response" => ResponseInterface::HTTP_NOT_FOUND,
        ];
    }

    return $this->response->setJSON($dataResult);
}

public function delete($id)
{
    $ResidentModel = new ResidentModel();

    $usuario = $ResidentModel->find($id);

    if ($usuario) {
        if ($ResidentModel->delete($id)) {
            $dataResult = [
                "data" => $residentes,
                "message" => 'Residente ha sido eliminado correctamente',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Error al eliminar al Residente',
                "response" => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
            ];
        }
    } else {
        $dataResult = [
            "data" => '',
            "message" => 'Residente no encontrado',
            "response" => ResponseInterface::HTTP_NOT_FOUND,
        ];
    }

    return $this->response->setJSON($dataResult);
}
}
