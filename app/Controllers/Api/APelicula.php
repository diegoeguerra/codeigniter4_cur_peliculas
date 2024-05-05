<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class APelicula extends ResourceController
{

    protected $modelName ='App\Models\MPelicula';
    protected $format = 'json';
    //protected $format = 'xml';
// **********************************************************************
    public function index(){
        return $this->respond($this->model->findAll());
    }

    public function show($id=null)
    {
        return $this->respond($this->model->find($id));
    }
// **********************************************************************
    public function create()
    {   
        $data =[
            'titulo'      => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
          ];

        if( $this->validate('peliculas')){            
          $id=$this->model->insert($data);
        }else{                        
            return $this->respond($this->validator->getErrors(),400);                                     
         }
         return $this->respond($id);        
    }
// **********************************************************************
    public function update($id = null)
    {
        if ($this->validate('peliculas')) {
            $this->model->update($id, [
                'titulo'      => $this->request->getRawInput()['titulo'],
                'descripcion' => $this->request->getRawInput()['descripcion']
            ]);
        } else {
            
            if($this->validator->getError('titulo')){
                return $this->respond($this->validator->getError('titulo'), 400);
            }
            
            if($this->validator->getError('descripcion')){
                return $this->respond($this->validator->getError('descripcion'), 400);
            }
            //return $this->respond($this->validator->getErrors(), 400);
        }

        return $this->respond($id);
    }
    /*
    public function update1($id=null)
    {     
        $data =[
            'titulo'      => $this->request->getPost('titulo'),
            'descripcion' => $this->request->getPost('descripcion')
          ];               
        
        if( $this->validate('peliculas')){  
            var_dump($data);     
            $this->model->update($id,$data);                                           
        }else{
            return $this->respond($this->validator->getErrors(),400);                                                  
        }
        //return $this->respond($this->request->getRawInput('titulo'));
        return $this->respond($this->request->getPost('titulo'));
    }
    */
// **********************************************************************
    
public function delete($id=null)
    {  
        $this->model->delete($id);                    
        return $this->respond('OK');       
    }


}


