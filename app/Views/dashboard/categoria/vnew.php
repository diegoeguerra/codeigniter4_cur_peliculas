 <?= $this->extend('Layouts/vlayout') ?>
  
<?= $this->section('header') ?>
Crear Categoria
<?= $this->endSection() ?>    

<?= $this->section('contenido') ?> 
        <?= view('partials/_form-error.php')?>        
        <form action="/dashboard/categoria/create" method="post"> 
                <?= view('dashboard/categoria/_form',['op'=>'Crear']) ?>
                    <!--
                    <label for="titulo"> Titulo </label>
                    <input type="text" name="titulo" placeholder="titulo" id="titulo">
                    <label for="descripcion"> Descripcion</label>
                    <textarea type="descripcion" name="descripcion"></textarea>
                    <button type="submit"> Enviar </button>
                    -->
        </form>
<?= $this->endSection() ?>  