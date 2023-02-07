<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<h3>Buscar citas por fecha</h2>
<div class="busqueda">
<form class="formulario" method="" action="">
    <div class="campo">
    <label for="fecha">Fecha</label>
    <input
        type="date"
        id="fecha"
        name="fecha"
        value="<?php echo $fecha; ?>"
    >
    </div>
</form>
<?php
    if(count($citas) === 0) {
        echo "<h2>No hay citas en esta fecha</h2>";
    }
?>

<div id="citas-admin">
    <ul class="citas">
        <?php
        $idCita = 0;
        foreach ($citas as $key => $cita){
            if ($idCita != $cita->id) {
                $total = 0;
        ?>
                <li>
                    <p>ID: <span><?php echo $cita->id; ?></span></p>
                    <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                    <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                    <p>Email: <span><?php echo $cita->email; ?></span></p>
                    <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>

                    <h4>Servicios</h3>
            <?php }  //Fin de IF
                $idCita = $cita->id;
            ?>
                    <p class="servicio"><?php echo $cita->servicio . ": $" . $cita->precio; ?></p>
        <?php 
            $actual = $cita->id;
            $proximo = $citas[$key + 1]->id ?? 0;
            
            $total += $cita->precio;
            if(esUltimo($actual, $proximo)){ ?>
                <p class="total">Total: <span>$<?php echo $total; ?></span></p>

                <form action="/api/eliminar" id="eliminar" method="POST">
                    <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                    <input type="submit" class="boton-eliminar" value="Eliminar">
                </form>
            <?php }
        } ?> <!-- Fin FOREACH -->
    </ul>

</div>
<?php
    // $script = "<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    $script = "<script src='build/js/buscador.js'></script>";
?>