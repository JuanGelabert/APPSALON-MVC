<?php
include_once __DIR__ . '/../templates/barra.php';
include_once __DIR__ . '/../templates/alertas.php';
?>

<h1 class="nombre-pagina">Actualizar Servicios</h1>
<p class="descripcion-pagina">Administración de servicios</p>

<form method="POST" class="formulario">
    <?php include_once __DIR__ . '/formulario.php'; ?>
    
    <input type="submit" class="boton" value="Actualizar">
</form>