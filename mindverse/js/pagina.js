const iconoMenu = document.querySelector('#icono-menu'),
    menu = document.querySelector('#menu');
    
iconoMenu.addEventListener('click', (e) => {
    menu.classList.toggle('prendido')
    document.body.classList.toggle('opacidad');

    const rutaActual = e.target.getAttribute('src');

    if(rutaActual == './other/lineatres.png') {
        e.target.setAttribute('src','./other/lineatres.png');
    } else {
        e.target.setAttribute('src','./other/lineatres.png');
    }
});