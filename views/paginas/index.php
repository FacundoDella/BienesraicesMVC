<main class="contenedor seccion">
    <h1>Mas Sobre Nosotros</h1>
    <?php include 'inconos.php' ?>
</main>

<section class="seccion contenedor">
    <h2>Casas y Deptos en Venta</h2>

    <?php
    include 'listado.php';
    ?>

    <div class="ver-todas alinear-derecha">
        <a href="/propiedades" class="boton-verde">A ver todas</a>
    </div>
</section>

<section class="imagen-contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Llena el formulario de contacto, y un asesor se pondra en contacto contigo a la brevedad</p>
    <a href="/contacto" class="boton-amarillo">Contáctanos</a>
</section>

<div class="contenedor seccion seccion-inferior">
    <section class="blog">
        <h3>Nuestro Blog</h3>

        <?php include 'listadoEntradas.php' ?>
    </section>

    <section class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>El personal se comporto de una excelente forma, muy buena atención y la casa que me
                ofecieron
                cumple con todas mis expectativas</blockquote>
            <p>- Facundo Dellanegra</p>
        </div>
    </section>
</div>