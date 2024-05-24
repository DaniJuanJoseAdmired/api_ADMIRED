<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use CodeIgniter\HTTP\ResponseInterface;

class Usuarios extends BaseController
{
    public function create()
    {
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
            $dataResult = [
                "data" => $data,
                "message" => 'Usuario Creado',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Error al crear usuario',
                "response" => ResponseInterface::HTTP_CONFLICT,
            ];
        }

        return $this->response->setJSON($dataResult);
    }

    public function index()
{
    $usuarioModel = new UsuariosModel();
    $usuarios = $usuarioModel->findAll();

    $dataResult = [
        "data" => $usuarios,
        "message" => 'Lista de usuarios',
        "response" => ResponseInterface::HTTP_OK,
    ];

    return $this->response->setJSON($dataResult);
}



    public function show($id)
    {
        $usuarioModel = new UsuariosModel();
        $usuario = $usuarioModel->find($id);

        if ($usuario) {
            $dataResult = [
                "data" => $usuario,
                "message" => 'Usuario Encontrado',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Usuario no encontrado',
                "response" => ResponseInterface::HTTP_NOT_FOUND,
            ];
        }

        return $this->response->setJSON($dataResult);
    }

    public function update($id)
{
    $usuarioModel = new UsuariosModel();

    // Obtener el usuario actual
    $usuario = $usuarioModel->find($id);

    // Verificar si el usuario existe
    if ($usuario) {
        // Obtener los datos del formulario
        $data = [
            'NOMBRE' => $this->request->getVar('NOMBRE') ?? $usuario['NOMBRE'],
            'APELLIDO' => $this->request->getVar('APELLIDO') ?? $usuario['APELLIDO'],
            'EMAIL' => $this->request->getVar('EMAIL') ?? $usuario['EMAIL'],
            'CONTRASENA' => $this->request->getVar('CONTRASENA') ? password_hash($this->request->getVar('CONTRASENA'), PASSWORD_DEFAULT) : $usuario['CONTRASENA'],
            'TELEFONO' => $this->request->getVar('TELEFONO') ?? $usuario['TELEFONO'],
            'TORRE' => $this->request->getVar('TORRE') ?? $usuario['TORRE'],
            'APTO' => $this->request->getVar('APTO') ?? $usuario['APTO'],
        ];

        // Actualizar el usuario en la base de datos
        if ($usuarioModel->update($id, $data)) {
            $dataResult = [
                "data" => $data,
                "message" => 'Usuario actualizado',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Error al actualizar usuario',
                "response" => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
            ];
        }
    } else {
        $dataResult = [
            "data" => '',
            "message" => 'Usuario no encontrado',
            "response" => ResponseInterface::HTTP_NOT_FOUND,
        ];
    }

    return $this->response->setJSON($dataResult);
}

public function delete($id)
{
    $usuarioModel = new UsuariosModel();

    // Obtener el usuario actual
    $usuario = $usuarioModel->find($id);

    // Verificar si el usuario existe
    if ($usuario) {
        // Eliminar el usuario de la base de datos
        if ($usuarioModel->delete($id)) {
            $dataResult = [
                "data" => $usuario,
                "message" => 'Usuario eliminado correctamente',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Error al eliminar usuario',
                "response" => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
            ];
        }
    } else {
        $dataResult = [
            "data" => '',
            "message" => 'Usuario no encontrado',
            "response" => ResponseInterface::HTTP_NOT_FOUND,
        ];
    }

    return $this->response->setJSON($dataResult);
}



}
