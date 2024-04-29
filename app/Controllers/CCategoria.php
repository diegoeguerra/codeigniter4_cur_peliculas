<?php

namespace App\Controllers;

use App\Models\MCategoria;

class CCategoria extends BaseController
{
    // http://localhost/Categoria/public/Categoria/new

    public function index()
    {
        session()->set('key','Valor de mi variable de session Key');
        $categoriaModel = new MCategoria();

         //var_dump(  $categoriaModel->findAll() ); // muestra todos los registros
        // var_dump(  $categoriaModel->findAll()[0] ); // trae el registro 0, ose al primer registro recuperado
        // var_dump(  $categoriaModel->findAll()[0]['titulo'] ); // trae el registro 0, ose al primer registro recuperado
        
        $data =['categoria'=>$categoriaModel->asObject()->findAll()];
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
// ************************************************************************************
    public function new()
    {
        echo view('categoria/vnew',[
                        // le pasamos estos parametros al nuevo formulario
                        'categoria' =>new CategoriaModel()
                    ]);
    }
// ************************************************************************************
    public function show($id)
    {   
        $categoriaModel = new MCategoria();                
        $data =['categoria'=>$categoriaModel->asObject()->find($id)];
        echo view('categoria/vshow.php',$data);     
    }
// ************************************************************************************
    public function create()
    {   
        $data =[
                  'titulo'      => $this->request->getPost('titulo'),
                  'descripcion' => $this->request->getPost('descripcion')
                ];

        $categoriaModel = new MCategoria();
        
        if( $this->validate('categorias')){ // agregamos validaciones configurada en el archivo validation.php
            $categoriaModel->insert($data); 
            return redirect()->to('categoria')->with('Mensaje','Registro Creado correctamente'); 
        }else{            
            session()->setFlashdata([
                'validation' => $this->validator
            ]);
            // si no pasa las validaciones 
            // regresa a su propia pantalla con un mensaje de error que se despliega en vedit.php  view('partials/_form-error.php')
            // ->withInput();   le pasa los valores ingresados al formulario esto es paera que no se pierdan
            return redirect()->back()->withInput();
        }        
    }

// ************************************************************************************
    public function edit($id)
    {        
        $categoriaModel = new MCategoria();        
        $data =['categoria'=>$categoriaModel->asObject()->find($id)];        
        echo view('categoria/vedit.php',$data);        
    }
// ************************************************************************************
    public function update($id)
    {     
        $data =[
            'titulo'      => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
          ];                
        $categoriaModel = new MCategoria();
        
        if( $this->validate('categorias')){ // agregamos validaciones configurada en el archivo validation.php
            $categoriaModel->update($id,$data);            
            // si las validaciones las cumple regresa a la pantalla principal
            return redirect()->to('categoria')->with('Mensaje','Registro Actulizado correctamente');         
        }else{            
            session()->setFlashdata([
              'validation' => $this->validator
            ]);
            // si no pasa las validaciones 
            // regresa a su propia pantalla con un mensaje de error que se despliega en vedit.php  view('partials/_form-error.php')
             // ->withInput();   le pasa los valores ingresados al formulario esto es paera que no se pierdan
             return redirect()->back()->withInput();
            
        }
    }
// ************************************************************************************

    public function delete($id)
    {  
        $categoriaModel = new MCategoria();
        $categoriaModel->delete($id);         
        return redirect()->to('categoria')->with('Mensaje','Registro Eliminado correctamente');               
    }


}


