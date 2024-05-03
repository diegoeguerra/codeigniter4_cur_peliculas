<?php

namespace App\Models;

use CodeIgniter\Model;

class MUsuario extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';    
    protected $returnType       = 'object';    
    protected $allowedFields    = ['usuario','email','contrasena']; // campos que se permite modificar

    public function contrasenaHash( $contrasenaHash)
    {
        return password_hash($contrasenaHash,PASSWORD_DEFAULT);
    }

    public function contrasenaVerificar($contrasenaPlano,$contrasenaHash)
    {
        return password_verify($contrasenaPlano,$contrasenaHash);
    }

/*
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $useAutoIncrement = true;
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

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
    */
}
