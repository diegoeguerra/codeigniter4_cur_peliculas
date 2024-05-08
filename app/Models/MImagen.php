<?php

namespace App\Models;

use CodeIgniter\Model;

class MImagen extends Model
{
    protected $table            = 'imagenes';    
    protected $returnType       = 'object';  
    protected $primaryKey       = 'id';  
    protected $allowedFields    = ['imagen','extension','data'];

    public function getPeliculasById($id){
        return  $this->select("p.*")
         ->join('pelicula_imagen as pi','pi.imagen_id = imagenes.id')
         ->join('peliculas as p','p.id = pi.pelicula_id')
         ->where('imagenes.id',$id)
         ->findAll();
 
     }
     
    
    /*    
    protected $useAutoIncrement = true;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;    

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
