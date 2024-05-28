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
        
        if ($residentModel->insert($data)) {
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
    $residentModel = new ResidentModel();
    $residentes = $residentModel->findAll();

    $dataResult = [
        "data" => $residentes,
        "message" => 'Lista de residentes',
        "response" => ResponseInterface::HTTP_OK,
    ];

    return $this->response->setJSON($dataResult);
}

    public function show($id)
    {
        $residentModel = new ResidentModel();
        $residentes = $residentModel->find($id);

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
    $residentModel = new ResidentModel();

   
    $residentes = $residentModel->find($id);

    if ($residentes) {
        $data = [
            'NO_TORRE' => $this->request->getVar('NO_TORRE') ?? $residentes['NO_TORRE'],
            'NO_APARTAMENTO' => $this->request->getVar('NO_APARTAMENTO') ?? $residentes['NO_APARTAMENTO'],
            'NOMBRE_PROPIETARIO' => $this->request->getVar('NOMBRE_PROPIETARIO') ?? $residentes['NOMBRE_PROPIETARIO'],
            'ESTADO' => $this->request->getVar('ESTADO') ?? $residentes['ESTADO'],
        ];

        if ($residentModel->update($id, $data)) {
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
    $residentModel = new ResidentModel();

    $residentes = $residentModel->find($id);

    if ($residentes) {
        if ($residentModel->delete($id)) {
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
