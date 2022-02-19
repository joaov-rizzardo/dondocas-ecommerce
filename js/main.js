
let glide = new Glide('.glide', {
  type: 'carousel',
  perView: 4,
  startAt: 0,
  breakpoints: {
    1024: {
      perView: 3
    },
    600: {
      perView: 2
    }
  }  
})

glide.mount()


