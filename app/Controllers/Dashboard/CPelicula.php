<?php

namespace App\Controllers\Dashboard;

use App\Models\MPelicula;
use App\Models\MCategoria;
use App\Models\MEtiqueta;
use App\Models\MImagen;
use App\Models\MPeliculaimagen;
use App\Models\MPeliculaEtiqueta;
use App\Libraries\LAyuda;

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
        $layuda       = new LAyuda();
        $data =[
            'titulo'       => $this->request->getPost('titulo'),
            'categoria_id' => $this->request->getPost('categoria_id'),
            'descripcion'  => $this->request->getPost('descripcion')
          ];               
        $peliculaModel = new MPelicula();

        if( $this->validate('peliculas')){ // agregamos validaciones configurada en el archivo validation.php                        
            $peliculaModel->update($id,$data) ;             
            $this->asignar_imagen($id);            
            // si las validaciones las cumple regresa a la pantalla principal
            return redirect()->to('dashboard/pelicula')->with('Mensaje','Registro Actualizado correctamente'); 
        }else{
            //var_dump('No paso validacion');
            //var_dump( $this->validator->getError('titulo'));
            //var_dump( $this->validator->listErrors());
            session()->setFlashdata([
                'validation' => $this->validator
            ]);
            // si no pasa las validaciones 
            // regresa a su propia pantalla con un mensaje de error que se despliega en vedit.php  view('partials/_form-error.php')
             // ->withInput();   le pasa los valores ingresados al formulario esto es paera que no se pierdan
             //return redirect()->back()->withInput();
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

    /*
    private function asignar_imagen() 
    {
        $peliculaimagenModel = new MPeliculaimagen();
        $peliculaimagenModel->insert([
            'pelicula_id' => '3',
            'imagen_id'   => '2'
        ]
        );

    } */

    private function asignar_imagen($peliculaId)     
    {
        $layuda       = new LAyuda();

        if($imagefile = $this->request->getFile('imagen')){
            
            //upload
                if($imagefile->isValid())
                {            
                    
                    $validationRule = [
                        'imagen' => [
                            'label' => 'Image File',
                            'rules' => [
                                'uploaded[imagen]',
                                'is_image[imagen]',
                                'mime_in[imagen,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                                'max_size[imagen,4096]',
                                'max_dims[imagen,1024,768]',
                            ],
                        ],
                    ];

                    if (! $this->validateData([], $validationRule)) {
                        $data = ['errors' => $this->validator->getErrors()];            
                        //return view('upload_form', $data);
                        $layuda->imprime_msg_web('mensaje','no es una imagen, ' . $this->validator->listErrors());
                    }else{
                        $imageNombre = $imagefile->getRandomName();
                        $ext = $imagefile->guessExtension();
                        //$imagefile->move(WRITEPATH . 'uploads/peliculas',$imageNombre );
                        
                        // se coloco en este directoria ya que se purede consumir desde la web
                       //  http://peliculas.test/uploads/peliculas/1715198606_1a7591dce7154bb131d6.jpg
                        $imagefile->move('../public/uploads/peliculas', $imageNombre);

                        $imagenModel = new MImagen();                     
                        
                        $imagenId = $imagenModel->insert([
                            'imagen' => $imageNombre,
                            'extension' => $ext,
                            'data' => 'Pendiente'
                        ]);
    
                        $peliculaImagenModel = new MPeliculaImagen();
                        $peliculaImagenModel->insert([
                            'imagen_id' => $imagenId,
                            'pelicula_id' => $peliculaId,
                        ]);
                        

                    }

                    /*

                    
                    $validated = $this->validate([
                        'uploaded[imagen]',
                        'mime_in[imagen,image/jpg,image/gif,image/png]',
                        'max_size[imagen,4096]',
                    ]);

                    if ($validated){
                        
                        $imageNombre = $imagefile->getRandomName();
                        $imagefile->move(WRITEPATH . 'uploads/peliculas',$imageNombre );

                    } else{
                    
                        $layuda->imprime_msg_web('mensaje','no es una imagen, ' . $this->validator->listErrors());
                    }
                    
                    $imageNombre = $imagefile->getRandomName();
                    $imagefile->move(WRITEPATH . 'uploads/peliculas',$imageNombre );
                 */   
                }
                
                return $this->validator->listErrors();           
            }
            

    }

    function image($image)
    {
        // abre el archivo en modo binario desde la carpeta que no se tiene acceso publicam,ente, esto es para proteger el archivo.
        if (!$image) {
            $image = $this->request->getGet('image');
        }
        $name = WRITEPATH . 'uploads/peliculas/' . $image;

        if (!file_exists($name)) {
            //throw PageNotFoundException::forPageNotFound();
        }

        $fp = fopen($name, 'rb');

        // envía las cabeceras correctas
        header("Content-Type: image/png");
        header("Content-Length: " . filesize($name));

        // vuelca la imagen y detiene el script
        fpassthru($fp);
        exit;
    }

    public function borrar_imagen($peliculaId,$imagenId){

        $imagenModel         = new MImagen();
        $peliculaModel       = new MPelicula();
        $peliculaImagenModel = new MPeliculaImagen();
        $layuda              = new LAyuda();


        $layuda->imprime_msg_web('imagenId',$imagenId);
        $layuda->imprime_msg_web('peliculaId',$peliculaId);
        

        $imagen = $imagenModel->find($imagenId);

        //$layuda->imprime_msg_web('imagen',$imagen);

        //archivo
        if ($imagen == null) {
            return 'no existe imagen..';
        }
        //$imageRuta = WRITEPATH . 'uploads/peliculas/' . $imagen->imagen;
        $imageRuta =  'uploads/peliculas/' . $imagen->imagen;
        // archivo

        // eliminar pivote
        $peliculaImagenModel
        ->where('imagen_id', $imagenId)
        ->where('pelicula_id', $peliculaId)
        ->delete();

        if ($peliculaImagenModel->where('imagen_id', $imagenId)->countAllResults() == 0) {
            // eliminar toda la imagen
            unlink($imageRuta);
            $imagenModel->delete($imagenId);
        }

        return redirect()->back()->with('mensaje', 'Imagen Eliminada');
    }


    public function descargar_imagen($imagenId)
    {
        $imagenModel = new MImagen();

        $imagen = $imagenModel->find($imagenId);

        if ($imagen == null) {
            return 'no existe imagen';
        }

        //$imageRuta = WRITEPATH . 'uploads/peliculas/' . $imagen->imagen;
        $imageRuta =  'uploads/peliculas/' . $imagen->imagen;

        return $this->response->download($imageRuta, null)->setFileName('imagen.png');
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


