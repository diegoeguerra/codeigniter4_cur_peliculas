<?= $this->extend('Layouts/web') ?>
  
<?= $this->section('header') ?>
        Listado de categorias
<?= $this->endSection() ?>   

<?= $this->section('contenido') ?>

<?= view('partials/_form-error') ?>
    
    <form action="<?= route_to('usuario.login_post') ?>" method="post">                    
        <label for="email" > Usuario </label>           <input type="text" name="email" placeholder="email" id="email" ">
        <label for="contrasena" > Contrasena </label>   <input type="password" name="contrasena" placeholder="contrasena" id="contrasena" ">    
        <button type="submit"> Enviar </button>
    </form>    
    
 <?= $this->endSection() ?>

    
    