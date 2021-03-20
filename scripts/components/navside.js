let burger = document.querySelector('.ham-burger');
let navbar = document.querySelector('nav');

burger.addEventListener('click', ()=>{
    navbar.classList.toggle('nav-active');
});