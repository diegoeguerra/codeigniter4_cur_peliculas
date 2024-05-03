<?php

namespace App\Libraries;

class LAyuda{
    
    // funcion que imprime mesajes de ayuda o debug dentro de la aplicacion
    public function imprime_msg_web($p_titulo,$p_mensaje){
        echo "\n<br> $p_titulo => "  . $p_mensaje;        
    }
    

}