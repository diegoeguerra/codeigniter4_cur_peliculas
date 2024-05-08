<?php

namespace App\Controllers\Dashboard;

use App\Models\MPelicula;
use App\Models\MCategoria;
use App\Models\MEtiqueta;
use App\Models\MImagen;
use App\Models\MPeliculaimagen;
use App\Models\MPeliculaEtiqueta;

use App\Controllers\BaseController;


class CPelicula extends BaseController
{
    // http://localhost/pelicula/public/pelicula/new

    public function index()
    {
        $peliculaModel = new MPelicula();
        

        //$this->generar_imagen();
        //$this->generar_imagen();
        //$this->generar_imagen();
        
        //$this->asignar_imagen();

         //var_dump(  $peliculaModel->findAll() ); // muestra todos los registros
        // var_dump(  $peliculaModel->findAll()[0] ); // trae el registro 0, ose al primer registro recuperado
        // var_dump(  $peliculaModel->findAll()[0]['titulo'] ); // trae el registro 0, ose al primer registro recuperado
        
        

        //$db = \Config\Database::connect();
        //$builder = $db->table('peliculas');
        //return $builder->limit(10,20)->getCompiledSelected();
        //$this->db->get_compiled_select();

        // seleccionamos todo de una tabla
        //$data =['peliculas'=>$peliculaModel->asObject()->findAll()];

        
        // ho hacemos un join on otra tabla, es un poco enredado, yo prefiero trabajar con vistas de bd
        // aqui se le agrega un alias al titulo de la categoria ya que se llama igual que 
        $data =[
            'peliculas'=>$peliculaModel
            ->select('peliculas.*, categorias.titulo as categoria_titulo')
            ->join('categorias','categorias.id = peliculas.categoria_id')
            ->findAll()            
        ];

        //'peliculas.id','peliculas.titulo','peliculas.descripcion','peliculas.id_categoria'
        //var_dump($data);
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
        echo view('dashboard/pelicula/index',$data);        
    }
// ************************************************************************************
    public function index2()
    {
        // esto lo utilizamos para retornar el select que se ejecuta de manera interna en la app
        // es para  validar cualquier 
        $db = \Config\Database::connect();
        $builder = $db->table('peliculas');
        return $builder->limit(10,20)->getCompiledSelect();

    }

// ************************************************************************************    

    public function new_anterior()
    {
        echo view('dashboard/pelicula/vnew',[
                        // le pasamos estos parametros al nuevo formulario
                        'pelicula' => [  
                            'titulo'    => 'titulo de la peliculas',
                            'descripcion'=> 'descripcion de la pelicula'
                                ]
                    ]);
    }

    public function new()    
    {
        $categoriaModel = new MCategoria();
        echo view('dashboard/pelicula/vnew',[
                        // le pasamos estos parametros al nuevo formulario
                        'pelicula'  => new Mpelicula(),
                        'categorias'=> $categoriaModel->find()
                    ]);
    }

// ************************************************************************************
    public function show2($id)
    {        
        //echo 'class CPelicula  ==>  public function show($id) => '. $id;        
        $peliculaModel = new MPelicula();        
        //var_dump($peliculaModel->find($id)['titulo']);
        $data =['pelicula'=>$peliculaModel->find($id)];
        echo view('dashboard/pelicula/vshow.php',$data);
    }
// ************************************************************************************
    public function show($id)
    {   
        $peliculaModel = new MPelicula();   
        //$imagenModel   = new MImagen();         

        //$data =['pelicula'=>$peliculaModel->find($id)];   
        //var_dump($peliculaModel->getImagesById($id));

        $data =[
            'pelicula'=>$peliculaModel->asObject()->find($id),
            'imagenes'=>$peliculaModel->asObject()->getImagesById($id),
            'etiquetas'=>$peliculaModel->asObject()->getEtiquetasById($id),
        ];                   
        //var_dump($peliculaModel->asArray()->find($id));
        //var_dump($peliculaModel->asObject()->find($id));
        
        //var_dump($imagenModel->getPeliculasById(2));
        //return;
        echo view('dashboard/pelicula/vshow',$data);

    }
// ************************************************************************************

    public function create()
    {   //var_dump($this->request->getPost('titulo'));
        $data =[
                  'titulo'      => $this->request->getPost('titulo'),
                  'descripcion' => $this->request->getPost('descripcion'),
                  'categoria_id' => $this->request->getPost('categoria_id')
                ];

        $peliculaModel = new MPelicula();
        
        if( $this->validate('peliculas')){ // agregamos validaciones configurada en el archivo validation.php
            $peliculaModel->insert($data); 
            return redirect()->to('dashboard/pelicula')->with('Mensaje','Registro Creado correctamente');
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
        $peliculaModel = new MPelicula();        
        $categoriaModel = new MCategoria();
        $data =[
            'pelicula'  =>$peliculaModel->asObject()->find($id),
            'categorias'=>$categoriaModel->asObject()->find()
        ];        
        echo view('dashboard/pelicula/vedit.php',$data);
    }

    
// ************************************************************************************

    public function update($id)
    {     
        $data =[
            'titulo'       => $this->request->getPost('titulo'),
            'categoria_id' => $this->request->getPost('categoria_id'),
            'descripcion'  => $this->request->getPost('descripcion')
          ];               

        //var_dump($data);

        $peliculaModel = new MPelicula();

        if( $this->validate('peliculas')){ // agregamos validaciones configurada en el archivo validation.php
            $peliculaModel->update($id,$data) ; 
            
            // si las validaciones las cumple regresa a la pantalla principal
            return redirect()->to('dashboard/pelicula')->with('Mensaje','Registro Actualizado correctamente'); 
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

// ************************************************************************************

    public function delete($id)
    {  
        $peliculaModel = new MPelicula();
        $peliculaModel->delete($id);         
        session()->setFlashdata('Mensaje','Resgistro eliminado correctamente');    
        return redirect()->to('dashboard/pelicula')->with('Mensaje','Registro Eliminado correctamente');    
    }
// ************************************************************************************



    public function etiquetas($id) 
    {
        $categoriaModel = new MCategoria();
        $etiquetaModel  = new MEtiqueta();
        $peliculaModel  = new MPelicula();

        $etiquetas =[];
        //var_dump($this->request->getGet('categoria_id'));
        if($this->request->getGet('categoria_id')){
            
            $etiquetas = $etiquetaModel
            ->where('categoria_id',$this->request->getGet('categoria_id'))
            ->findAll();
        }

        //var_dump($etiquetas);

        $data = [
            'pelicula'     => $peliculaModel->find($id),
            'categorias'   => $categoriaModel->findAll(),
            'categoria_id' => $this->request->getGet('categoria_id'),
            'etiquetas'    => $etiquetas,
        ];
        echo view('dashboard/pelicula/vetiquetas',$data);
       

    }

    public function etiquetas_post($id)
    {
        $peliculaEtiquetaModel = new MPeliculaEtiqueta();

        $etiquetaId = $this->request->getPost('etiqueta_id');
        $peliculaId = $id;

        $peliculaEtiqueta = $peliculaEtiquetaModel->where('etiqueta_id', $etiquetaId)->where('pelicula_id', $peliculaId)->first();

        if (!$peliculaEtiqueta) {
            $peliculaEtiquetaModel->insert([
                'pelicula_id' => $peliculaId,
                'etiqueta_id' => $etiquetaId
            ]);
        }

        return redirect()->back();
    }

    public function etiqueta_delete($id, $etiquetaId)
    {
        $peliculaEtiqueta = new MPeliculaEtiqueta();
        $peliculaEtiqueta
        ->where('etiqueta_id', $etiquetaId)
        ->where('pelicula_id', $id)
        ->delete();

        echo '{"mensaje":"Eliminado"}';

        //return redirect()->back()->with('mensaje', 'Etiqueta eliminada');
    }


    private function generar_imagen() 
    {
        $imagenModel = new MImagen();
        $imagenModel->insert([
            'imagen'    => date('y-m-d H:m:s'),
            'extension' => 'Pendiente',
            'date'      => 'Pendiente'
        ]
        );

    } 

    private function asignar_imagen() 
    {
        $peliculaimagenModel = new MPeliculaimagen();
        $peliculaimagenModel->insert([
            'pelicula_id' => '3',
            'imagen_id'   => '2'
        ]
        );

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


