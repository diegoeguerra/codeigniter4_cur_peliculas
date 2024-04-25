<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
</head>
<body>
    <h1> LISTADO DE PELICULAS:  </h1>  
    <?= view('partials/_vsession') ?>
    <a href="/pelicula/new/" > Crear nueva pelicula </a>       
        <ul>
            <p> <?php foreach ($peliculas as $key => $p) : ?> 
                <li>  <?= $p['titulo'] ?> </li>
            <?php endforeach ?>

            <!--
           $peliculas = contiene lo siguiente
            array(3) { 
             p$ ==> [0]=> array(3) {   ["id"]          => string(1)  "1" 
                                       ["titulo"]      => string(10) "El padrino" 
                                       ["description"] => string(37) "pelicula de matadera droga y gangster" 
                                    } 
                                    
             p$ ==>   [1]=> array(3) { ["id"]          => string(1) "2" 
                                       ["titulo"]      => string(17) "EL ciudadano kane" 
                                       ["description"] => string(15) "pelicula buenoa" 
                                    } 
             p$ ==>   [2]=> array(3) { ["id"]          => string(1) "3" 
                                       ["titulo"]      => string(30) "Cantando bajo la lluvia (1952)" 
                                       ["description"] => string(17) "pelicula drmatica" 
                                    } 
                            }
                        -->
            </p>
        </ul>


        <table>
            <tr>
                <th> Id </th>
                <th> Titulo </th>
                <th> Descripcion </th>
                <th> Opciones </th>

            </tr>
             <?php foreach ($peliculas as $key => $p) : ?> 
            <tr>
                <td>  <?= $p['id'] ?> </td>
                <td>  <?= $p['titulo'] ?> </td>
                <td>  <?= $p['descripcion'] ?> </td>                
                <td> <a href="/pelicula/show/<?= $p['id'] ?>" >  Show </a>  
                     <a href="/pelicula/edit/<?= $p['id'] ?>" >  Editar </a>  
                     <form action="/pelicula/delete/<?= $p['id'] ?>" method="post"> 
                        <button type="submit"> Eliminar </button>
                     </form>                
                </td>
            </tr>
                <?php endforeach ?>            
        </table>


</body>
</html>