<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Etiquetas extends Migration
{
    public function up()
    {
        //$this->forge->dropTable('peliculas');
        
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
            'categoria_id' => [
                'type' => 'INT',
                'constraint' =>5,   // longitud
                'unsigned' => TRUE                
            ],
        ]);

        $this->forge->addKey('id',TRUE);
        $this->forge->addForeignKey('categoria_id','categorias','id','CASCADE','CASCADE');
        $this->forge->createTable('etiquetas');

       

    }

    public function down()
    {
        $this->forge->dropTable('etiquetas');
    }
}
