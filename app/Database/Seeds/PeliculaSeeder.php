<?php

namespace App\Database\Seeds;

use App\Models\MPelicula;
use App\Models\MCategoria;
use CodeIgniter\Database\Seeder;

class PeliculaSeeder extends Seeder
{
    public function run()
    {
        $peliculaModel = new MPelicula();
        $categoriaModel = new MCategoria();

        $categorias = $categoriaModel->limit(7)->findAll();

        $peliculaModel->where('id >=', 1)->delete();

    foreach($categorias as $c){
            for ($i = 0; $i < 20; $i++) {
                $peliculaModel->insert(
                    [
                        'titulo' => "Pelicula $i",
                        'categoria_id' => $c->id,
                        'descripcion' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, hic praesentium. Cupiditate neque officia maiores praesentium exercitationem. Enim dolores velit dolorum tenetur quisquam cum saepe omnis adipisci, asperiores repudiandae! Reiciendis!",
                    ]
                );
            }
        }
    }
}
