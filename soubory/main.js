const nav = document.getElementById("navigace");

var cesta = window.location.pathname;
var stranka = cesta.split("/").pop();

if(stranka == "kontakt.php") {
    nav.classList.add('bg-white');
    nav.classList.add('shadow-md');
}
else {
    window.addEventListener('scroll', () => {
        if(window.scrollY >= 50) {
            nav.classList.add('bg-white');
            nav.classList.add('shadow-md');
        }
        else{
            nav.classList.remove('bg-white');
            nav.classList.remove('shadow-md');
        }
    })
    
}

const navigaceResponzivni = document.getElementById("navigace-responzivni");
const tlacitkoNavigace = document.getElementsByClassName("nav-tlacitko")[0];
const tlacitkoMobil = document.getElementsByClassName("nav-tlacitko")[1];

tlacitkoNavigace.addEventListener('click', () => {
    navigaceResponzivni.classList.toggle('hidden');
})

tlacitkoMobil.addEventListener('click', () => {
    navigaceResponzivni.classList.toggle('hidden');
})

const odkaz = document.getElementsByClassName('odkaz');

for (const element of odkaz) {
    element.addEventListener('click', () => {
        navigaceResponzivni.classList.toggle('hidden');
    })
}

