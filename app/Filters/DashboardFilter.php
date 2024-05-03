<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\LAyuda;

class DashboardFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $layuda       = new LAyuda();
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
        
        // si no existe la lista usuario en la session, se redirecciona al login
        $layuda->imprime_msg_web("","");
        if (!session()->get('usuario') ){            
            $layuda->imprime_msg_web("mensage DashboardFilter","No existe session del usuario creada, redirecciono a login");
            //return redirect()->to(route_to('usuario.login'));
          }else
            {    // verifica si el tipo del usuario guardado en la session inicialmente es de tipo admin
                if (session()->get('usuario')->tipo!= 'admin' ){            
                $layuda->imprime_msg_web("mensage DashboardFilter","usuario no es admin: ".session()->get('usuario')->tipo);
                    //return redirect()->to(route_to('dashboard/categoria'));
                }else{            
                    $layuda->imprime_msg_web("mensage DashboardFilter","usuario es admin: ".session()->get('usuario')->tipo);
                    //return redirect()->to(route_to('dashboard/pelicula'));
                }

            }
        
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
