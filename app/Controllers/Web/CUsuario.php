<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MUsuario;
use App\Libraries\LAyuda;

class CUsuario extends BaseController
{
    // http://peliculas.test/dashboard/usuario/crear_usuario
    public function crear_usuario()
    {
        $usuarioModel = new MUsuario();
        $usuarioModel->insert(
            [
                'usuario'    =>'admin',
                'email'      =>'admin@gmail.com',
                'contrasena' => $usuarioModel->contrasenaHash('12345')
            ]
            );
    }
 // ****************************************************************************************   
    // http://peliculas.test/dashboard/usuario/probar_contrasena
    public function probar_contrasena()
    {
        $usuarioModel = new MUsuario();
       var_dump($usuarioModel->contrasenaVerificar('12345','$2y$10$05dfFDGI9hLEO25xzFgM2.yEsNKf/Mp2xNRj9BX0ioYJx0X6XpOYi'));

       echo $usuarioModel->contrasenaVerificar('12345','$2y$10$05dfFDGI9hLEO25xzFgM2.yEsNKf/Mp2xNRj9BX0ioYJx0X6XpOYi');
    }
// ****************************************************************************************

    public function login()
    {
        echo view('web/usuario/vlogin');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(route_to('usuario.login'));        
    }
// ****************************************************************************************
    public function login_post()
    {
        $layuda       = new LAyuda();
        $usuarioModel = new MUsuario();
        $email        = $this->request->getPost('email');         // email o usuario
        $contrasena   = $this->request->getPost('contrasena');    // contrasena
        
        // solo verifica que el usuario exista en la tabla usuarios
        // el usuario puede ser el email o un usuario
        $usuario    = $usuarioModel->select('id,usuario,email,contrasena,tipo')        
                    ->orWhere('email',$email)        
                    ->orWhere('usuario',$email)        
                    ->first();
        /*
        $layuda->imprime_msg_web("usuario",$usuario->usuario);
        $layuda->imprime_msg_web("email",$usuario->email);
        $layuda->imprime_msg_web("contrasena",$usuario->contrasena);
        $layuda->imprime_msg_web("tipo",$usuario->tipo);
        */

        // valida si trajo datos del select (solo busca el usuario)
        if (!$usuario){

            $layuda->imprime_msg_web("mensaje","Usuarion no existe en la bd");            
            
            //return redirect()->back()->with('mensaje','Usuario y/o contraseña invalido');
        }else
        {
            $layuda->imprime_msg_web("mensaje","Usuario existe en la bd");
            $layuda->imprime_msg_web("usuario",$usuario->usuario);
            $layuda->imprime_msg_web("email",$usuario->email);
            $layuda->imprime_msg_web("contrasena",$usuario->contrasena);
            $layuda->imprime_msg_web("tipo",$usuario->tipo);

            $layuda->imprime_msg_web("contrasena valida",$usuarioModel->contrasenaVerificar($contrasena,$usuario->contrasena));
            $layuda->imprime_msg_web("contrasena Hash",$usuario->contrasena);
            $layuda->imprime_msg_web("contrasena Plano",$contrasena);

            if($usuarioModel->contrasenaVerificar($contrasena,$usuario->contrasena))
            {
                $layuda->imprime_msg_web("mensaje","Usuario y/o contraseña valido");            
                $session = session();
                unset($usuario->contrasena);
                session()->set('usuario',$usuario);
                //$session->set($usuario);
                return redirect()->to('/dashboard/categoria')->with('Mensaje',"bienvenid@ $usuario->usuario");
            
            }else{
                $layuda->imprime_msg_web("mensaje","Contrasena invalida");            
            }

                
        }

        // valida si la contraseña es valid

        
       


        //contraseña invalida
        //return redirect()->back()->with('mensaje','Usuario y/o contraseña invalido');

        //var_dump(session()->get('usuario') );        
        /*
        var_dump(session()->get('usuario')->usuario);
        var_dump(session()->get('usuario')->email);
        var_dump(session()->get('usuario')->tipo);
        echo "***********************";
        echo session()->get('usuario')->usuario;
        echo session()->get('usuario')->email;
        echo session()->get('usuario')->tipo;
        */
        

   }
// ****************************************************************************************
   public function register()
    {
        echo view('web/usuario/vregister');
    }
// ****************************************************************************************
    public function register_post()
    {
        $usuarioModel = new MUsuario();         

        // valida contra el validador "app->config->validation.php"        
        if( $this->validate('usuarios')){
           
            $usuarioModel->insert([
                'usuario'   =>$this->request->getPost('usuario'),
                'email'     =>$this->request->getPost('email'),
                'contrasena'=>$usuarioModel->contrasenaHash($this->request->getPost('contrasena'))
            ]);

            return redirect()->to(route_to('usuario.login'))->with('Mensaje',"Login Exitoso");
        }
        
        session()->setFlashdata([
            'validation' => $this->validator
        ]);
        
        // en caso de que falle regresa a la pagina anterior
        return redirect()->back()->withInput();  

   }

}

