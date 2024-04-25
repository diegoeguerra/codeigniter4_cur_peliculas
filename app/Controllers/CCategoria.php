<?php

namespace App\Controllers;

use App\Models\MCategoria;

class CCategoria extends BaseController
{
    // http://localhost/Categoria/public/Categoria/new

    public function index()
    {
        $categoriaModel = new MCategoria();

         //var_dump(  $categoriaModel->findAll() ); // muestra todos los registros
        // var_dump(  $categoriaModel->findAll()[0] ); // trae el registro 0, ose al primer registro recuperado
        // var_dump(  $categoriaModel->findAll()[0]['titulo'] ); // trae el registro 0, ose al primer registro recuperado
        
        $data =['categoria'=>$categoriaModel->findAll()                 
                ];
        /*
        array(3) { 
            [0]=> array(3) { ["id"]          => string(1)  "1" 
                                ["titulo"]      => string(10) "El padrino" 
                                ["description"] => string(37) "categoria de matadera droga y gangster" 
                                } 
                                
            [1]=> array(3) { ["id"]          => string(1) "2" 
                                ["titulo"]      => string(17) "EL ciudadano kane" 
                                ["description"] => string(15) "categoria buenoa" 
                                } 
            [2]=> array(3) { ["id"]          => string(1) "3" 
                                ["titulo"]      => string(30) "Cantando bajo la lluvia (1952)" 
                                ["description"] => string(17) "categoria drmatica" 
                                } 
                        }
        */

        echo view('categoria/index.php',$data);
        
    }

    public function new()
    {
        echo view('categoria/vnew',[
                        // le pasamos estos parametros al nuevo formulario
                        'categoria' => [  
                            'titulo'    => 'titulo de la categorias',
                            'descripcion'=> 'descripcion de la categoria'
                                ]
                    ]);
    }

    public function show($id)
    {   
        $categoriaModel = new MCategoria();                
        $data =['categoria'=>$categoriaModel->find($id)];
        echo view('categoria/vshow.php',$data);
    }

    public function create()
    {   
        $data =[
                  'titulo'      => $this->request->getPost('titulo'),
                  'descripcion' => $this->request->getPost('descripcion')
                ];
        $categoriaModel = new MCategoria();
        $categoriaModel->insert($data); 
    }

    public function edit($id)
    {        
        $categoriaModel = new MCategoria();        
        $data =['categoria'=>$categoriaModel->find($id)];        
        echo view('categoria/vedit.php',$data);
    }

    public function update($id)
    {     
        $data =[
            'titulo'      => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
          ];                
        $categoriaModel = new MCategoria();
        $categoriaModel->update($id,$data); 
        echo 'categoria actualizada';        
    }

    public function delete($id)
    {  
        $categoriaModel = new MCategoria();
        $categoriaModel->delete($id); 
        echo 'categoria eliminada';        
    }


}


