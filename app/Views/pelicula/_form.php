<label for="titulo" > Titulo </label>
<input type="text" name="titulo" placeholder="titulo" id="titulo" value="<?= old('titulo',$pelicula['titulo']) ?>">

<label for="descripcion"> Descripcion</label>
<textarea type="descripcion" name="descripcion" >  
    <?= old('descripcion',$pelicula['descripcion']) ?>
</textarea>

<button type="submit"> <?= $op ?> </button>