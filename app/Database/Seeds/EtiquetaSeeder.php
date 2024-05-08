<?php

namespace App\Database\Seeds;

use App\Models\MEtiqueta;
use App\Models\Mcategoria;
use CodeIgniter\Database\Seeder;

class EtiquetaSeeder extends Seeder
{
    public function run()
    {
        $etiquetaModel = new MEtiqueta();
        $categoriaModel = new MCategoria();

        $categorias = $categoriaModel->limit(7)->findAll();

        $etiquetaModel->where('id >=', 1)->delete();

    foreach($categorias as $c){
            for ($i = 0; $i < 20; $i++) {
                $etiquetaModel->insert(
                    [
                        'titulo' => "Tag $i $c->titulo",
                        'categoria_id' => $c->id,
                        'descripcion' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, hic praesentium. Cupiditate neque officia maiores praesentium exercitationem. Enim dolores velit dolorum tenetur quisquam cum saepe omnis adipisci, asperiores repudiandae! Reiciendis!",
                    ]
                );
            }
        }
    }
}

