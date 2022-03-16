$(document).ready(() => {

    // AQUI DEVE FICAR TODAS AS MASCARAS UTILIZADAS NA PÁGINA
    $('#product-value').mask('00000,00', {
        reverse: true
    })

    $('#save').on('click', () => {
        const productName = document.querySelector('#product-name').value
        const productValue = document.querySelector('#product-value').value
        const productColor = document.querySelector('#product-color').value
        const productCategory = document.querySelector('#product-category'.value)
        const productSubCategory = document.querySelector('#product-subcategory').value

        let registerData = {
                productName : productName,
                productValue : productValue,
                productColor : productColor,
                productCategory : productCategory,
                productSubCategory : productSubCategory
        };
        
        // ARRAY QUE SERÁ PERCORRIDO PARA REALIZAR A VALIDAÇÃO DOS CAMPOS
        const validationArray = [
            productName,
            productValue,
            productColor,
            productCategory,
            productSubCategory
        ]

        const files = document.querySelector('#img-file').files
        
        // VALIDA SE FOI SELECIONADA UMA IMAGEM
        if(files.length == 0){
            //alert('Nenhuma imagem foi selecionada')
            //return
        }

        // REALIZA A VALIDAÇÃO DOS CAMPOS
        let stopCondition = false // VARIAVEL QUE IRÁ RECEBER A CONDIÇÃO DE PARADA -  SE TRUE DEVE INTERROMPER A EXECUÇÃO DA FUNÇÃO
        validationArray.every(field => {
            if(field == ''){
                //alert('Verifique se todos os campos foram preenchidos')
                //stopCondition = true
                //return false
            }
        })

        if(stopCondition){
            return
        }
        
        let reader = new FileReader();

        reader.readAsDataURL(files[0])

        reader.onload = () => {
            const productImage = reader.result
            registerData.productImage = productImage

            console.log(registerData)
            
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

    // FLUXO PARA ADICIONAR LINHA DE ESTOQUE
    $('#stock_add').on('click', () => {
        const $div = document.createElement('div')
        $div.className = 'stock-item'

        const $labelSize = document.createElement('label')
        $labelSize.innerHTML = 'Tamanho:'

        const $selectSizes = document.createElement('select')
        $selectSizes.className = 'form-control'

        const $defaultOption = document.createElement('option')
        $defaultOption.value = ''
        $defaultOption.innerHTML = 'Selecione um tamanho'
        $defaultOption.selected = 'selected'

        $selectSizes.appendChild($defaultOption)
        //Requisição para buscar os tamanhos
        
        const $labelAmount = document.createElement('label')
        $labelAmount.innerHTML = 'Quantidade:';

        const $inputAmount = document.createElement('input')
        $inputAmount.type = 'number'

        // INCLUINDO TODOS OS ELEMENTOS CRIADOS NA DIV PRINCIPAL (.stock-item)
        $div.appendChild($labelSize)
        $div.appendChild($selectSizes)
        $div.appendChild($labelAmount)
        $div.appendChild($inputAmount)

        // INCLUINDO A DIV NO HTML
        const $sectionStock = document.querySelector('#stock-information')
        $sectionStock.appendChild($div)


    })
})

