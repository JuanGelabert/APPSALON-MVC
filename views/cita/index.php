<?php
    include_once __DIR__ . '/../templates/barra.php';
?>

<h1 class="nombre-pagina">Mis reservas</h1>  

<div class="app">
    
    <?php if ($reservas) { ?>
        <ul class="reservas">
            <?php foreach ($reservas as $reserva) { ?>
                <li>
                    <p>Fecha: <span><?php echo $reserva->fecha; ?></span></p>
                    <p>Hora: <span><?php echo $reserva->hora; ?> hs</span></p>
                </li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p class="descripcion-pagina">No tienes ninguna reserva</p>
    <?php } ?>
    
    <button type="button" id="nueva-cita" class="boton">Reservar una nueva cita</button>
    
    <div class="seccion-citas ocultar">
        <nav class="tabs">
            <button type="button" data-paso="1">Servicios</button>
            <button type="button" data-paso="2">Reserva</button>
            <button type="button" data-paso="3">Resumen</button>
        </nav>

        <div id="paso-1" class="seccion">
            <h2>Servicios</h2>
            <p class="text-center">Elige los servicios que deseas</p>
            <div class="listado-servicios" id="servicios"></div>
        </div>
        <div id="paso-2" class="seccion">
            <h2>Reserva</h2>
            <p class="text-center">Selecciona fecha y hora</p>

            <form action="" class="formulario">
                <div class="campo">
                    <!-- <label for="nombre">Nombre</label> -->
                    <input 
                        id="nombre"
                        type="hidden"
                        value="<?php echo $nombre; ?>"
                        disabled
                    />
                </div>
                <div class="campo">
                    <label for="fecha">Fecha</label>
                    <input 
                        id="fecha"
                        type="date"
                        min="<?php echo date('Y-m-d'); ?>"
                    />
                </div>
                <div class="campo">
                    <label for="hora">Hora</label>
                    <input 
                        id="hora"
                        type="time"
                    />
                </div>
                <input type="hidden" id="id" value="<?php echo $id; ?>">
            </form>
        </div>
        <div id="paso-3" class="seccion contenido-resumen">
            <h2>Resumen</h2>
            <p class="text-center">Verifica que la información sea correcta</p>
        </div>

        <div class="paginacion">
            <button
                id="anterior"
                class="boton"
            >&laquo; Anterior</button>
    
            <button
                id="siguiente"
                class="boton"
            >Siguiente &raquo;</button>
        </div>
    </div>
</div>
<?php
    $script = "
        <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
        ";
?>
