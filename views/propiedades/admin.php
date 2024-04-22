<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php
    if ($resultado) {
        $mensaje = mostrarNotificacion(intval($resultado));

        if ($mensaje) { ?>
            <p class="alerta exito"><?php echo s($mensaje) ?></p>
    <?php

        }
    }

    ?>


    <a href="/propiedades/crear" class=" boton boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class=" boton boton-amarillo">Nuevo(a) Vendedor</a>
    <a href="/entradas/crear" class=" boton boton-amarillo">Nueva Entrada de Blog</a>

    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody> <!-- .Motrar los Resultados -->
            <?php foreach ($propiedades as $propiedad) :
            ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="../imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                    <td>$ <?php echo $propiedad->precio; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a class="boton-amarillo-block" href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>

        </thead>

        <tbody> <!-- .Motrar los Resultados -->
            <?php foreach ($vendedores as $vendedor) :
            ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>

                        <a class="boton-amarillo-block" href="vendedores/actualizar?id=<?php echo $vendedor->id; ?>">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <h2>Entradas del Blog</h2>

<table class="propiedades">
    <thead>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Subtítulo</th>
            <th>Descripción</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>

    </thead>

    <tbody> <!-- .Motrar los Resultados -->
        <?php foreach ($entradas as $entrada) :
        ?>
            <tr>
                <td><?php echo $entrada->id; ?></td>
                <td><?php echo $entrada->titulo; ?></td>
                <td><?php echo $entrada->subtitulo; ?></td>
                <td class="descipcionPequeña"><?php echo $entrada->descripcion; ?></td>
                <td><img src="../imagenes/<?php echo $entrada->imagen; ?>" class="imagen-tabla"></td>
                <td>
                    <form method="POST" class="w-100" action="entradas/eliminar">
                        <input type="hidden" name="id" value="<?php echo $entrada->id; ?>">
                        <input type="hidden" name="tipo" value="vendedor">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>

                    <a class="boton-amarillo-block" href="entradas/actualizar?id=<?php echo $entrada->id; ?>">Actualizar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


</main>