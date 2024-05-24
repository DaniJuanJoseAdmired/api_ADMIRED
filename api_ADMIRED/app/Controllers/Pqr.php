<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PqrModel;
use CodeIgniter\HTTP\ResponseInterface;

class Pqr extends BaseController
{
    public function create()
    {
        $pqrModel = new PqrModel();

        $data = [
            'TIPO' => $this->request->getPost('TIPO'),
            'ESTADO_ID' => $this->request->getPost('ESTADO_ID'),
        ];

        if ($pqrModel->insert($data)) {
            $dataResult = [
                "data" => $data,
                "message" => 'PQR Creado',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Error al crear PQR',
                "response" => ResponseInterface::HTTP_CONFLICT,
            ];
        }

        return $this->response->setJSON($dataResult);
    }

    public function index()
{
    $pqrModel = new PqrModel();
    $pqr = $pqrModel->findAll();

    $dataResult = [
        "data" => $pqr,
        "message" => 'Lista de PQR',
        "response" => ResponseInterface::HTTP_OK,
    ];

    return $this->response->setJSON($dataResult);
}



    public function show($id)
    {
        $pqrModel = new PqrModel();
        $pqr = $pqrModel->find($id);

        if ($pqr) {
            $dataResult = [
                "data" => $pqr,
                "message" => 'PQR Encontrado',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'PQR no encontrado',
                "response" => ResponseInterface::HTTP_NOT_FOUND,
            ];
        }

        return $this->response->setJSON($dataResult);
    }

    public function update($id)
{
    $pqrModel = new PqrModel();

    // Obtener el usuario actual
    $pqr = $pqrModel->find($id);

    // Verificar si el usuario existe
    if ($pqr) {
        // Obtener los datos del formulario
        $data = [
            'TIPO' => $this->request->getVar('TIPO') ?? $pqr['TIPO'],
            'ESTADO_ID' => $this->request->getVar('ESTADO_ID') ?? $pqr['ESTADO_ID'],
        ];

        // Actualizar el usuario en la base de datos
        if ($pqrModel->update($id, $data)) {
            $dataResult = [
                "data" => $data,
                "message" => 'PQR actualizado',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Error al actualizar PQR',
                "response" => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
            ];
        }
    } else {
        $dataResult = [
            "data" => '',
            "message" => 'PQR no encontrado',
            "response" => ResponseInterface::HTTP_NOT_FOUND,
        ];
    }

    return $this->response->setJSON($dataResult);
}

public function delete($id)
{
    $pqrModel = new PqrModel();

    // Obtener el usuario actual
    $pqr = $pqrModel->find($id);

    // Verificar si el usuario existe
    if ($pqr) {
        // Eliminar el usuario de la base de datos
        if ($pqrModel->delete($id)) {
            $dataResult = [
                "data" => $pqr,
                "message" => 'PQR eliminado correctamente',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Error al eliminar PQR',
                "response" => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
            ];
        }
    } else {
        $dataResult = [
            "data" => '',
            "message" => 'PQR no encontrado',
            "response" => ResponseInterface::HTTP_NOT_FOUND,
        ];
    }

    return $this->response->setJSON($dataResult);
}



}
