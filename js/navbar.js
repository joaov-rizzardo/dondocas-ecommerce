$(document).ready(() => {

    $('#hamburguer').click(() => {
        let icon = document.querySelector('#hamburguer i')
        let menu = document.querySelector('#menufull')
        let body = document.querySelector('body');

        if (icon.className == 'fa-solid fa-bars') {
            menu.style.opacity = 1
            body.style.overflowY = 'hidden';
            icon.className = "fa-solid fa-xmark"
        } else if (icon.className == 'fa-solid fa-xmark') {
            menu.style.opacity = 0
            body.style.overflowY = 'scroll';
            icon.className = "fa-solid fa-bars"
        }

    })
})