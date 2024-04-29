<?= $this->extend('Layouts/vlayout') ?>
  
<?= $this->section('header') ?>
Actualizar Categoria
<?= $this->endSection() ?>    

<?= $this->section('contenido') ?> 
    <?= view('partials/_form-error.php')?>  
    <form action="/categoria/update/<?= $categoria->id ?>" method="post">            
        <?= view('categoria/_form',['op'=>'Actualizar']) ?>
     </form>
<?= $this->endSection() ?>  