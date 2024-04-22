<?php foreach ($entradas as $entrada) {
?>
    <article class="entrada-blog">
        <div class="imagen">
            <picture>
                <img loading="lazy" src="/imagenes/<?php echo $entrada->imagen; ?>" alt="Imagen de la Propiedad">
            </picture>
        </div>

        <div class="texto-entrada">
            <a href="/entrada">
                <h4><?php $entrada->titulo ?></h4>
            </a>
            <p class="informacion-meta">Escrtio el <span><?php echo $entrada->creado; ?></span> por <span><?php echo $entrada->creador; ?></span></p>
            <p><?php echo $entrada->descripcion; ?></p>
        </div>
    </article>
<?php } ?>