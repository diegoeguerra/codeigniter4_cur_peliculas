<?php

namespace App\Models;

use CodeIgniter\Model;

class MPelicula extends Model
{
    protected $table            = 'peliculas';    
    protected $primaryKey       = 'id';
    protected $returnType       = 'object';
    protected $allowedFields    = ['titulo','descripcion','categoria_id'];  // campos que seran editable4s

    public function getImagesById($id)
    {
        return $this->select("i.*")
            ->join('pelicula_imagen as pi', 'pi.pelicula_id = peliculas.id')
            ->join('imagenes as i', 'i.id = pi.imagen_id')
            ->where('peliculas.id', $id)
            ->findAll();
    }

    public function getEtiquetasById($id)
    {
        return $this->select('e.*')
            ->join('pelicula_etiqueta as pe', 'pe.pelicula_id = peliculas.id')
            ->join('etiquetas as e', 'e.id = pe.etiqueta_id')
            ->where('peliculas.id', $id)
            ->findAll();
    }



    // esto no lo estaremos utilizando
    /*    
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
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
