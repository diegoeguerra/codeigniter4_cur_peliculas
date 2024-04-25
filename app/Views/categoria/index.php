<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
</head>
<body>
    <h1> LISTADO DE CATEGORIAS:  </h1>  
    <?= session('key') ?>
    <?= view('partials/_vsession') ?>
    <a href="/categoria/new/" > Crear nueva Categoria </a>       
        <ul>
            <p> <?php foreach ($categoria as $key => $p) : ?> 
                <li>  <?= $p['titulo'] ?> </li>
               <?php endforeach ?>
            </p>
        </ul>


        <table>
            <tr>
                <th> Id </th>
                <th> Titulo </th>
                <th> Descripcion </th>
                <th> Opciones </th>

            </tr>
             <?php foreach ($categoria as $key => $p) : ?> 
            <tr>
                <td>  <?= $p['id'] ?> </td>
                <td>  <?= $p['titulo'] ?> </td>
                <td>  <?= $p['descripcion'] ?> </td>                
                <td> <a href="/categoria/show/<?= $p['id'] ?>" >  Show </a>  
                     <a href="/categoria/edit/<?= $p['id'] ?>" >  Editar </a>  
                     <form action="/categoria/delete/<?= $p['id'] ?>" method="post"> 
                        <button type="submit"> Eliminar </button>
                     </form>                
                </td>
            </tr>
                <?php endforeach ?>            
        </table>


</body>
</html>