<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Crear Categoria </title>
</head>
<body>
        
        <form action="/categoria/create" method="post"> 
            <?= view('categoria/_form',['op'=>'Crear']) ?>
            <!--
            <label for="titulo"> Titulo </label>
            <input type="text" name="titulo" placeholder="titulo" id="titulo">
            <label for="descripcion"> Descripcion</label>
            <textarea type="descripcion" name="descripcion"></textarea>
            <button type="submit"> Enviar </button>
            -->
        </form>

</body>
</html>