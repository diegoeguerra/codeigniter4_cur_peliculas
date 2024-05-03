<?= $this->extend('Layouts/vlayout') ?>
  
  <?= $this->section('header') ?>
   <title> <?= $categoria->titulo ?> </title>
  <?= $this->endSection() ?>    
  
  <?= $this->section('contenido') ?> 
    <h1><?= $categoria->titulo ?> </h1>
    <p><?=  $categoria->descripcion ?> </p>
  <?= $this->endSection() ?>  