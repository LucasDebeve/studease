document.addEventListener('DOMContentLoaded', function () {
    const navbarToggler = document.querySelector('.navbar-toggler');
    const materialIcon = document.querySelector('.material-symbols-outlined');
    const navbarIcon = document.querySelector('.navbar-toggler-icon');

    navbarToggler.addEventListener('click', function (){
        if (materialIcon.classList.contains('d-none')) {
            materialIcon.classList.remove('d-none');
            navbarIcon.classList.add('d-none');
        } else {
            materialIcon.classList.add('d-none');
            navbarIcon.classList.remove('d-none');
        }
    })
})



