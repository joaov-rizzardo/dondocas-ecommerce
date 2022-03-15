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

        let reader = new FileReader();

        // RECEBE A URL DA IMAGEM
        reader.readAsDataURL(files[0])

        reader.onload = () => {
            $image.src = reader.result

            $('.modal').show()
        
            // CONFIGURAÇÕES PARA O CROPPER
            const cropper = new Cropper($image, {
                aspectRatio: 3120/4160,
                dragMode : 'move',
                viewMode : 1,
                highlight : false,
                background: false,
                crop: event => {
                    $('#img-x').value = event.detail.x
                    $('#img-y').value = event.detail.y
                    $('#img-width').value = event.detail.width
                    $('#img-height').value = event.detail.height
                    console.log(event.detail.x);
                    console.log(event.detail.y);
                    console.log(event.detail.width);
                    console.log(event.detail.height);
                    
                }
            })
            
            // EXECUTA O BLOCO DE CÓDIGO APENAS UMA VEZ
            // EVITA DE ADICIONAR EVENTO DE ONCLICK, SEMPRE QUE O EVENTO DE ONCHANGE DO INPUT FOR DISPARADO

            $('#save-img').one('click', () => {
                cropper.destroy()
                $('.modal').hide()
            })
        }

       


    })
})

