<?= $this->extend('Layouts/vlayout') ?>
  
<?= $this->section('header') ?>
Actualizar Pelicula
<?= $this->endSection() ?>    

<?= $this->section('contenido') ?>     
<?= view('partials/_form-error.php')?>    

<form enctype="multipart/form-data" action="/dashboard/pelicula/update/<?= $pelicula->id ?>" method="post">            
    <?= view('dashboard/pelicula/_form',['op'=>'Actualizar']) ?>
</form>    


<?= $this->endSection() ?>  


