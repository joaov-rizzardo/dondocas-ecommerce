// Configurações dos sliders (GliderJS)
let sliders = document.querySelectorAll('.glide');

const configs = {
  type: 'carousel',
  perView: 4,
  startAt: 0,
  autoplay: 2000,
  hoverpause: true,
  breakpoints: {
    1024: {
      perView: 3
    },
    600: {
      perView: 2
    }
  }
}

sliders.forEach(item => {
  new Glide(item, configs).mount()
})

