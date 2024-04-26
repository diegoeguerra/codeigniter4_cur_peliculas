<?= $this->extend('Layouts/vlayout') ?>
  
<?= $this->section('header') ?>
Actualizar Pelicula
<?= $this->endSection() ?>    

<?= $this->section('contenido') ?> 
    
    <?= view('partials/_form-error.php')?>
    
    <form action="/pelicula/update/<?= $pelicula['id'] ?>" method="post">            
        <?= view('pelicula/_form',['op'=>'Actualizar']) ?>
    </form>
    
<?= $this->endSection() ?>  