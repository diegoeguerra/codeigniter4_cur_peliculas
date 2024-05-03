<?= $this->extend('Layouts/web') ?>
  
<?= $this->section('header') ?>
        Listado de categorias
<?= $this->endSection() ?>   

<?= $this->section('contenido') ?>

<?= view('partials/_form-error') ?>
    
    <form action="<?= route_to('usuario.register_post') ?>" method="post">   

        <label for="usuario" > Usuario </label>         <input type="text" name="usuario" placeholder="usuario" id="usuario" ">

        <label for="email" > Usuario/Email </label>     <input type="text" name="email" placeholder="email" id="email" ">

        <label for="contrasena" > Contrasena </label>   <input type="password" name="contrasena" placeholder="contrasena" id="contrasena" ">   

        <button type="submit"> Enviar </button>
    </form>    
    
 <?= $this->endSection() ?>

    
    