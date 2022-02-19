
// Configurações para o slider
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


// Alinhando o controle do slider com as imagens
const img = document.querySelector('.img-novidades')
const coordenadas = img.getBoundingClientRect()
console.log(coordenadas)
const setaEsquerda = document.querySelector('.glide__arrow--left');
setaEsquerda.style.position = 'absolute'
setaEsquerda.style.top = coordenadas.y

