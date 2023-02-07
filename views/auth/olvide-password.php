<h1 class="nombre-pagina">Olvide password</h1>
<p class="descripcion-pagina">Reestablece tu contraseña escribiendo tu email a continuacion</p>

<?php
    if ($alertas) {
        include_once __DIR__ . '/../templates/alertas.php';
    }
?>

<form action="/olvide" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Tu email">
    </div>
    <input type="submit" class="boton" value="Enviar instrucciones">
</form>
<div class="acciones">
    <a href="/">¿Recordaste la contraseña? Inicia Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes una cuenta? Regístrate</a>
</div>