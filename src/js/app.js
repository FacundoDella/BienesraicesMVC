document.addEventListener('DOMContentLoaded', function () {
    eventLiesteners();

    darkMode();
})

/* 
Añadir al documento html un "escuchador de eventos", entonces cuando el contenido del DOM este cargado, ejecuta una funcion que manda a llamar a las funciones requeridas
 */


function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    //console.log(prefiereDarkMode.matches);

    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else { document.body.classList.remove('dark-mode'); }

    prefiereDarkMode.addEventListener('change', function () {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else { document.body.classList.remove('dark-mode'); }
    })


    const botonDark = document.querySelector('.dark-mode-boton');

    botonDark.addEventListener('click', function oscuro() {

        if (document.body.classList.contains('dark-mode')) {
            document.body.classList.remove('dark-mode');
        } else { document.body.classList.add('dark-mode') };
    })

}

function eventLiesteners() {
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', menuResponsive);


    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodosContacto));

}

/* 
le agrego a la funcion  eventLiesteners() una variable que contenga la clase .mobile-menu, luego a esa misma variable le agredo un "escuchador de eventos", para que cuando uno haga click sobre esa variable (que representa a .menu-mobile la cual es la imagen del menu responsive), mande ejecute la funcion menuResponsive
*/

function menuResponsive() {
    const navegacion = document.querySelector('.navegacion');

    if (navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else { navegacion.classList.add('mostrar') }

    /* El codigo (if y else) de ariba hacen lo mismo que:
    navegacion.classList.toggle('mostrar');
    */
}

/*
A la funcion menuResponsive le agrego una variable que contenga la navegacion,

entonces si la navegacion contiene la clase .mostrar, la remueve. 
Y si no la tiene, la agrega. 

Todo esto para que cuando nosotros demos click y no tiene la clase mostrar, la agrege (lo cual muestra la navegacion), y si tiene la clase mostrar, la quita. 

Damos click y se agrega la navegacion, damos click nuevamente y se elimina
*/

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector('#contacto');

    if (e.target.value == 'telefono') {
        contactoDiv.innerHTML = `
        <label for="telefono">Número de Teléfono</label>
        <input type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]">

        <p>Elija la fecha y la hora, para la llamada</p>
        <label for="fecha">Fecha</label>
        <input type="date" id="fecha" name="contacto[fecha]">

        <label for="hora">Hora</label>
        <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">

        `;
    } else {
        contactoDiv.innerHTML = `
        <label for="email">E-mail</label>
        <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required>
        `;
    }
}