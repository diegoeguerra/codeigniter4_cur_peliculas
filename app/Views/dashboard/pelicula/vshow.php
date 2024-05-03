<?= $this->extend('Layouts/vlayout') ?>
  
<?= $this->section('header') ?>
<?= $pelicula->titulo ?> 
<?= $this->endSection() ?>    

<?= $this->section('contenido') ?>     
    <p><?= $pelicula->titulo ?> </p>
<?= $this->endSection() ?>  
