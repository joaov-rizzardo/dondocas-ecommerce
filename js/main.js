// Configurações dos sliders (GliderJS)
let sliders = document.querySelectorAll('.glide');

const configs = {
  type: 'carousel',
  perView: 4,
  startAt: 0,
  autoplay: 2000,
  hoverpause: true,
  breakpoints: {
    992: {
      perView: 3
    },
    768: {
      perView: 2
    }
  }
}

sliders.forEach(item => {
  new Glide(item, configs).mount()
})



