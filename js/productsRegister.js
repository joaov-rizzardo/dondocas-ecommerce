$(document).ready(() => {

    // AQUI DEVE FICAR TODAS AS MASCARAS UTILIZADAS NA PÁGINA
    $('#product-value').mask('00000,00', {
        reverse: true
    })

    $('#save').on('click', () => {
        const productName = document.querySelector('#product-name').value
        const productValue = document.querySelector('#product-value').value
        const productCategory = document.querySelector('#product-category'.value)
        const productSubCategory = document.querySelector('#product-subcategory').value

        let registerData = {
                productName : productName,
                productValue : productValue,
                productCategory : productCategory,
                productSubCategory : productSubCategory
        };
        
        // ARRAY QUE SERÁ PERCORRIDO PARA REALIZAR A VALIDAÇÃO DOS CAMPOS
        const validationArray = [
            productName,
            productValue,
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

            // ARRAY QUE SERÁ ARMAZENADO AS INFORMAÇÕES DE ESTOQUE
            let stockItens = Array();

            // OBTEM E VERIFICA SE EXISTE AS INFORMAÇÕES DE ESTOQUE
            const $stockInformation = document.querySelectorAll('.fieldset-stock-item')
            if($stockInformation){
                //console.log(stockInformation)
                $stockInformation.forEach($stock => {
                    const colorName = $stock.querySelector('.product-color-name').value
                    const color = $stock.querySelector('.product-color').value
                    const size = $stock.querySelector('.product-size').value
                    const amount = $stock.querySelector('.product-amount').value

                    const stockObj = {
                        colorName : colorName,
                        color : color,
                        size : size,
                        amount : amount
                    }

                    stockItens.push(stockObj)
                })
                
                console.log(stockItens)
            }
            
            
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

    //==================================================//
    //       FLUXO PARA ADICIONAR LINHA DE ESTOQUE      //
    //==================================================//

    $('#stock_add').on('click', () => {
        const $fieldset = document.createElement('fieldset')
        $fieldset.className = "fieldset-stock-item"

        const $divSize = document.createElement('div')
        $divSize.className = 'stock-item'

        const $divColor = document.createElement('div')
        $divColor.className = 'stock-item'

        const $labelColorName = document.createElement('label')
        $labelColorName.innerHTML = "Cor:"
        
        const $inputColorName = document.createElement('input')
        $inputColorName.type = 'text'
        $inputColorName.className = 'form-control product-color-name'

        const $labelColor = document.createElement('label')
        $labelColor.innerHTML = 'Selecione a cor'
        
        const $inputColor = document.createElement('input')
        $inputColor.type = 'color'
        $inputColor.className = 'form-control product-color'
        
        const $labelSize = document.createElement('label')
        $labelSize.innerHTML = 'Tamanho:'

        const $selectSizes = document.createElement('select')
        $selectSizes.className = 'form-control product-size'

        const $defaultOption = document.createElement('option')
        $defaultOption.value = ''
        $defaultOption.innerHTML = 'Tamanho único'
        $defaultOption.selected = 'selected'

        $selectSizes.appendChild($defaultOption)
        //Requisição para buscar os tamanhos
        
        const $labelAmount = document.createElement('label')
        $labelAmount.innerHTML = 'Quantidade:';

        const $inputAmount = document.createElement('input')
        $inputAmount.type = 'number'
        $inputAmount.className = 'form-control product-amount'

        // INCLUINDO TODOS OS ELEMENTOS RELACIONADOS A DIV COLOR
        $divColor.appendChild($labelColorName)
        $divColor.appendChild($inputColorName)
        $divColor.appendChild($labelColor)
        $divColor.appendChild($inputColor)

        // INCLUINDO TODOS OS ELEMENTOS RELACIONADOS A DIV SIZE
        $divSize.appendChild($labelSize)
        $divSize.appendChild($selectSizes)
        $divSize.appendChild($labelAmount)
        $divSize.appendChild($inputAmount)

        //  INCLUINDO AS DIVS AO FIELD SET
        $fieldset.appendChild($divColor)
        $fieldset.appendChild($divSize)
        // INCLUINDO A DIV NO HTML
        const $sectionStock = document.querySelector('#stock-information')
        $sectionStock.appendChild($fieldset)


    })
})

