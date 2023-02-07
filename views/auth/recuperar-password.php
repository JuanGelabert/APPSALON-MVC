<h1 class="nombre-pagina">Recuperar password</h1>
<p class="descripcion-pagina">Coloca tu nuevo password a continuación</p>

<?php
    if ($alertas) {
        include_once __DIR__ . '/../templates/alertas.php';
    }

    if ($error OR $exito) return;

    if ($exito) { ?>
        
        <div class="acciones">
            <a href="/"> Volver a la página principal</a>
        </div>
        
    <?php }
?>

<form class="formulario" method="POST">
    <div class="campo">
        <label for="password">Password</label>
        <input
            type="password"
            name="password"
            id="password"
        >
    </div>
    <input type="submit" class="boton" value="Confirmar">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes cuenta? Inicia sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes cuenta? Crea una</a>
</div>