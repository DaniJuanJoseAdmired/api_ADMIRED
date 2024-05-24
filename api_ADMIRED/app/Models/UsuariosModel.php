<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'usuarios';
    protected $primaryKey       = 'ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['NOMBRE', 'APELLIDO', 'TIPO_DOCUMENTO_ID', 'NO_DOCUMENTO', 'FECHA_NACIMIENTO', 'EMAIL', 'CONTRASENA', 'TELEFONO', 'CARGO_ID', 'TORRE', 'APTO', 'PQR_ID', 'RESIDENTES_ID', 'CUOTAS_ADMIN_ID', 'UNIDAD_RESIDENCIAL_ID', 'AREA_COMUN_ID'];

    // Dates
    // protected $useTimestamps    = true;
    // protected $dateFormat       = 'datetime';
    // protected $createdField     = 'created_at';
    // protected $updatedField     = 'updated_at';
    // protected $deletedField     = 'deleted_at';


    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
