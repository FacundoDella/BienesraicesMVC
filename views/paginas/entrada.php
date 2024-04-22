<article class="contenedor seccion contenido-centrado">

    <h1> <?php $entrada->titulo ?></h1>

    <picture>
        <img loading="lazy" src="/imagenes/<?php echo $entrada->imagen; ?>" alt="Imagen de la Propiedad">
    </picture>

    <p class="informacion-meta">Escrito el: <span><?php echo $entrada->creado; ?></span> por <span><?php echo $entrada->creador; ?></span></p>

    <div class="resumen-propiedad">

        <p><?php echo $entrada->descripcion; ?></p>
    </div>
</article>


