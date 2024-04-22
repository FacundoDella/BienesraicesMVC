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

<<<<<<< HEAD
        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Imagen Blog-1">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="/entrada">
                    <h4>Terraza en el techo de tu casa</h4>
                </a>
                <p class="informacion-meta">Escrtio el <span>20/10/2023</span> por <span>Admin</span></p>
                <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando
                    dinero</p>
            </div>
        </article>

        <article class="entrada-blog">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Imagen Blog-2">
                </picture>
            </div>

            <div class="texto-entrada">
                <a href="/entrada">
                    <h4>Guía para la decoracion de tu hogar</h4>
                </a>
                <p class="informacion-meta">Escrtio el <span>20/10/2023</span> por <span>Admin</span></p>
                <p>Maximiza el espacio en tu hogarcon esta guía, aprende a combinar muebles y colores para darle
                    vida a tu espacio</p>
            </div>
        </article>
=======
        <?php include 'listadoEntradas.php' ?>
>>>>>>> rama1
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