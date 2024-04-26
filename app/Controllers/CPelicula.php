<?php

namespace App\Controllers;

use App\Models\MPelicula;

class CPelicula extends BaseController
{
    // http://localhost/pelicula/public/pelicula/new

    public function index()
    {
        $peliculaModel = new MPelicula();

         //var_dump(  $peliculaModel->findAll() ); // muestra todos los registros
        // var_dump(  $peliculaModel->findAll()[0] ); // trae el registro 0, ose al primer registro recuperado
        // var_dump(  $peliculaModel->findAll()[0]['titulo'] ); // trae el registro 0, ose al primer registro recuperado
        
        $data =['peliculas'=>$peliculaModel->findAll()                 
                ];
        /*
        array(3) { 
            [0]=> array(3) { ["id"]          => string(1)  "1" 
                                ["titulo"]      => string(10) "El padrino" 
                                ["description"] => string(37) "pelicula de matadera droga y gangster" 
                                } 
                                
            [1]=> array(3) { ["id"]          => string(1) "2" 
                                ["titulo"]      => string(17) "EL ciudadano kane" 
                                ["description"] => string(15) "pelicula buenoa" 
                                } 
            [2]=> array(3) { ["id"]          => string(1) "3" 
                                ["titulo"]      => string(30) "Cantando bajo la lluvia (1952)" 
                                ["description"] => string(17) "pelicula drmatica" 
                                } 
                        }
        */

        echo view('pelicula/index.php',$data);
        
    }

    public function new()
    {
        echo view('pelicula/vnew',[
                        // le pasamos estos parametros al nuevo formulario
                        'pelicula' => [  
                            'titulo'    => 'titulo de la peliculas',
                            'descripcion'=> 'descripcion de la pelicula'
                                ]
                    ]);
    }


    public function show($id)
    {        
        //echo 'class CPelicula  ==>  public function show($id) => '. $id;        
        $peliculaModel = new MPelicula();        
        //var_dump($peliculaModel->find($id)['titulo']);
        $data =['pelicula'=>$peliculaModel->find($id)];
        echo view('pelicula/vshow.php',$data);
    }



    public function create()
    {   //var_dump($this->request->getPost('titulo'));
        $data =[
                  'titulo'      => $this->request->getPost('titulo'),
                  'descripcion' => $this->request->getPost('descripcion')
                ];

        $peliculaModel = new MPelicula();
        
        if( $this->validate('peliculas')){ // agregamos validaciones configurada en el archivo validation.php
            $peliculaModel->insert($data); 
            return redirect()->to('pelicula')->with('Mensaje','Registro Creado correctamente');
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



    public function edit($id)
    {        
        $peliculaModel = new MPelicula();        
        $data =['pelicula'=>$peliculaModel->find($id)];        
        echo view('pelicula/vedit.php',$data);
    }




    public function update($id)
    {     
        $data =[
            'titulo'      => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
          ];               

        //var_dump($data);
        $peliculaModel = new MPelicula();

        if( $this->validate('peliculas')){ // agregamos validaciones configurada en el archivo validation.php
            $peliculaModel->update($id,$data) ; 
            
            // si las validaciones las cumple regresa a la pantalla principal
            return redirect()->to('pelicula')->with('Mensaje','Registro Actualizado correctamente'); 
        }else{
            //var_dump( $this->validator->getError('titulo'));
            //var_dump( $this->validator->listErrors());
            session()->setFlashdata([
                'validation' => $this->validator
            ]);
            // si no pasa las validaciones 
            // regresa a su propia pantalla con un mensaje de error que se despliega en vedit.php  view('partials/_form-error.php')
             // ->withInput();   le pasa los valores ingresados al formulario esto es paera que no se pierdan
             return redirect()->back()->withInput();
        }


    }

    public function delete($id)
    {  
        $peliculaModel = new MPelicula();
        $peliculaModel->delete($id); 
        echo 'pelicula eliminada';   
        session()->setFlashdata('Mensaje','Resgistro eliminado correctamente');    
        return redirect()->to('pelicula')->with('Mensaje','Registro Eliminado correctamente');    
    }


/*
    public function mi_controller_prueba()
    {
        echo 'hola mundo dentro de app/controller>home.php => public function mi_controller_prueba()';
        return view('welcome_message');
    }

    public function code()
    {
        echo json_encode(array('key1'=>'value1','key2'=>'value2'));
        return view('welcome_message');
    }
    
    public function update($id,$otro)
    {
        echo 'public function update($id) => '. $id . '  '. $otro;
    }
*/
}


