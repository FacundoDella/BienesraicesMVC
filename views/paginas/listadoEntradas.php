<?php

foreach ($entradas as $entrada) {
?>
    <article class="entrada-blog">
        <div class="imagen">
            <picture>
                <img loading="lazy" src="/imagenes/<?php echo $entrada->imagen; ?>" alt="Imagen de la Propiedad">
            </picture>
        </div>

        <div class="texto-entrada">
            <a href="/entrada?id=<?php echo $entrada->id ?>">
                <h4><?php echo $entrada->titulo ?></h4>
            </a>
            <p class="informacion-meta">Escrtio el <span><?php echo $entrada->creado; ?></span> por <span><?php echo $entrada->creador; ?></span></p>
            <p class="informacion-meta"><?php echo $entrada->subtitulo; ?></span></p>

            <?php if ($entradaDescripcion) { ?>
                <p>
                    <?php echo acortarTexto($entrada->descripcion, 50); ?>
                </p>
            <?php } ?>

        </div>
    </article>
<?php } ?>