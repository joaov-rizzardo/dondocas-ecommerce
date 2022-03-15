$(document).ready(() => {

    // AQUI DEVE FICAR TODAS AS MASCARAS UTILIZADAS NA PÁGINA
    $('#product-value').mask('00000,00', {
        reverse: true
    })

    $('#save').click(() => {
        const files = document.querySelector('#img-file').files
        let reader = new FileReader();

        reader.readAsDataURL(files[0])

        reader.onload = () => {
            console.log(reader.result)
        }
        
        
    })

    //----------------------------------------------------------------------------//
    //                 FLUXO PARA REALIZAR O CROP DA IMAGEM                       //
    //----------------------------------------------------------------------------//

    $('#img-file').on('change', event => {
        const $image = document.querySelector('#img-modal')
        
        let files = event.target.files

        console.log(files)

        let reader = new FileReader();

        // RECEBE A URL DA IMAGEM
        reader.readAsDataURL(files[0])

        reader.onload = () => {
            $image.src = reader.result
            $('.modal').show()
        
            // CONFIGURAÇÕES PARA O CROPPER
            const cropper = new Cropper($image, {
                aspectRatio: 10/13,
                dragMode : 'move',
                viewMode : 1,
                highlight : false,
                background: false,
                crop: event => {
                    //console.log(event.detail.x);
                    //console.log(event.detail.y);
                    //console.log(event.detail.width);
                    //console.log(event.detail.height);
                    //console.log(event.detail.rotate);
                    //console.log(event.detail.scaleX);
                    //console.log(event.detail.scaleY);
                }
            })
            console.log(cropper)
            $('#save-img').on('click', () => {
                cropper.destroy()
                $('.modal').hide()
            })
        

        }

    })
})

