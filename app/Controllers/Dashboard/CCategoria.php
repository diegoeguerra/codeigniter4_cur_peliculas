<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use App\Models\MCategoria;


class CCategoria extends BaseController
{
    // http://localhost/Categoria/public/Categoria/new

    public function index()
    {
        session()->set('key','Valor de mi variable de session Key');
        $categoriaModel = new MCategoria();
        $data =['categoria'=>$categoriaModel->asObject()->findAll()];        
        echo view('dashboard/categoria/index.php',$data);        
    }
// ************************************************************************************
    public function new()
    {
        echo view('dashboard/categoria/vnew',[
                        // le pasamos estos parametros al nuevo formulario
                        'categoria' =>new MCategoria()
                    ]);
    }
// ************************************************************************************
    public function show($id)
    {   
        $categoriaModel = new MCategoria();                
        $data =['categoria'=>$categoriaModel->asObject()->find($id)];
        echo view('dashboard/categoria/vshow.php',$data);     
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
            return redirect()->to('dashboard/categoria')->with('Mensaje','Registro Creado correctamente'); 
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
        echo view('dashboard/categoria/vedit',$data);        
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
            return redirect()->to('dashboard/categoria')->with('Mensaje','Registro Actulizado correctamente');         
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
        return redirect()->to('dashboard/categoria')->with('Mensaje','Registro Eliminado correctamente');               
    }


}


