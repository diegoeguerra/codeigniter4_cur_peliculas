<?= $this->extend('Layouts/vlayout') ?>
  
<?= $this->section('header') ?>
Actualizar Pelicula
<?= $this->endSection() ?>    

<?= $this->section('contenido') ?> 
    <form action="/pelicula/update/<?= $pelicula['id'] ?>" method="post">            
        <?= view('pelicula/_form',['op'=>'Actualizar']) ?>
    </form>
<?= $this->endSection() ?>  