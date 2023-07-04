document.addEventListener('DOMContentLoaded', ()=>{
    const elementos = document.querySelectorAll('.carousel')
    M.Carousel.init(elementos, {
        duration: 200,
        dist: -30,
        shift: 150,
        numVisible:5,
        indicators: true,
        noWrap: false
    });
});