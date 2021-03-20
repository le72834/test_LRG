let imgset = document.querySelector('.part-collection');
let images = imgset.querySelectorAll('a');
// Nav Slider variable
let burger = document.querySelector('.ham-burger');
let navbar = document.querySelector('nav');

let currentImage = 0;

function animatebanner(){
    setInterval(() => {
        currentImage+=1;

        console.log(currentImage);

        if(currentImage === 4){
            console.log("you have reached last image");
            currentImage = 0;
        }

        imgset.style.marginLeft = `${currentImage * -200}`+"px";

    }, 5000);
}

animatebanner();

burger.addEventListener('click', ()=>{
    navbar.classList.toggle('nav-active');
});