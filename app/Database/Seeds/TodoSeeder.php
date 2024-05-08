<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TodoSeeder extends Seeder
{
    public function run()
    {
        $this->call('PeliculaSeeder');
        $this->call('CategoriaSeeder');
        $this->call('EtiquetaSeeder');
        
    }
}
