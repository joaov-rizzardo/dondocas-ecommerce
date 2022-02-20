
// Configurações para o slider de novidades
let glide = new Glide('.glide', {
  type: 'carousel',
  perView: 3,
  startAt: 0,
  autoplay: 2000,
  hoverpause: true,
  breakpoints: {
    1024: {
      perView: 2
    },
    600: {
      perView: 2
    }
  }  
})

glide.mount()

let promocoes = new Glide('.promocoes', {
  type: 'carousel',
  perView: 3,
  startAt: 0,
  autoplay: 2000,
  hoverpause: true,
  breakpoints: {
    1024: {
      perView: 2
    },
    600: {
      perView: 2
    }
  }  
})

promocoes.mount()



