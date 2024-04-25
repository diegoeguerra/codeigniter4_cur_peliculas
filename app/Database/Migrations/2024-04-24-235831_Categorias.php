<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categorias extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' =>5,   // longitud
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' =>255
            ],            
            'descripcion' => [
                'type' => 'TEXT',
                'null' => TRUE
            ]
        ]);

        $this->forge->addKey('id',TRUE);
        $this->forge->createTable('categorias');
        
    }

    public function down()
    {
        $this->forge->dropTable('categorias');

    }
}
