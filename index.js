let slider = document.querySelector('.carrossel .list');
let items = document.querySelectorAll('.carrossel .list .item');
let next = document.getElementById('next');
let prev = document.getElementById('prev');
let dots = document.querySelectorAll('.carrossel .dots li');

let lengthItems = items.length - 1;
let active = 0;
let itemWidth = items[0].offsetWidth; // Obtém a largura do primeiro item

function updateCarousel() {
    itemWidth = items[0].offsetWidth; // Recalcula a largura em cada atualização
    slider.style.transform = `translateX(-${active * itemWidth}px)`;

    let last_active_dot = document.querySelector('.carrossel .dots li.active');
    if (last_active_dot) {
        last_active_dot.classList.remove('active');
    }
    dots[active].classList.add('active');
}

next.onclick = function(){
    active = active + 1 <= lengthItems ? active + 1 : 0;
    updateCarousel();
}

prev.onclick = function(){
    active = active - 1 >= 0 ? active - 1 : lengthItems;
    updateCarousel();
}

let refreshInterval = setInterval(()=> {next.click()}, 3000);

dots.forEach((li, key) => {
    li.addEventListener('click', ()=>{
        active = key;
        updateCarousel();
        clearInterval(refreshInterval);
        refreshInterval = setInterval(()=> {next.click()}, 3000);
    })
})

window.onresize = function(event) {
    updateCarousel();
};

// Inicializa o carrossel
updateCarousel();