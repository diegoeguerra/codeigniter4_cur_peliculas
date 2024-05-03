<?= $this->extend('Layouts/vlayout') ?>
  
<?= $this->section('header') ?>
Actualizar Categoria
<?= $this->endSection() ?>    

<?= $this->section('contenido') ?> 
    <?= view('partials/_form-error.php')?>  
    <form action="/dashboard/categoria/update/<?= $categoria->id ?>" method="post">            
        <?= view('dashboard/categoria/_form',['op'=>'Actualizar']) ?>
    </form>
<?= $this->endSection() ?>  