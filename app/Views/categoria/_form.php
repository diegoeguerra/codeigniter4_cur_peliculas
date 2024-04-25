<label for="titulo" > Titulo </label>
<input type="text" name="titulo" placeholder="titulo" id="titulo" value="<?= $categoria['titulo'] ?>">

<label for="descripcion"> Descripcion</label>
<textarea type="descripcion" name="descripcion" >  
    <?= $categoria['descripcion'] ?>
</textarea>

<button type="submit"> <?= $op ?> </button>