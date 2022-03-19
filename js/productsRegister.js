$(document).ready(() => {

    // AQUI DEVE FICAR TODAS AS MASCARAS UTILIZADAS NA PÁGINA
    $('#product-value').mask('00000,00', {
        reverse: true
    })

    $('#save').on('click', () => {
        const productName = document.querySelector('#product-name').value
        const productValue = document.querySelector('#product-value').value
        const productCategory = document.querySelector('#product-category').value
        const productSubCategory = document.querySelector('#product-subcategory').value
        const imageX = document.querySelector('#img-x').value
        const imageY = document.querySelector('#img-y').value
        const imageWidth = document.querySelector('#img-width').value
        const imageHeight = document.querySelector('#img-height').value


        // DEVERÁ SER ENVIADO EM UM FORMDATA POR CONTA DO UPLOAD DA IMAGEM
        const formData = new FormData();
        formData.append('product_name', productName)
        formData.append('product_value', productValue)
        formData.append('category_key', productCategory)
        formData.append('subcategory_key', productSubCategory)
        formData.append('imageX', imageX)
        formData.append('imageY', imageY)
        formData.append('imageWidth', imageWidth)
        formData.append('imageHeight', imageHeight)

        // ARRAY QUE SERÁ PERCORRIDO PARA REALIZAR A VALIDAÇÃO DOS CAMPOS
        let validationArray = [
            productName,
            productValue,
            productCategory,
            productSubCategory,
            imageX,
            imageY,
            imageWidth,
            imageHeight
        ]

        const files = document.querySelector('#img-file').files

        // VALIDA SE FOI SELECIONADA UMA IMAGEM
        if (files.length == 0) {
            alert('Nenhuma imagem foi selecionada')
            return
        }

        const image = files[0]
        formData.append('image', image)

        // REALIZA A VALIDAÇÃO DOS CAMPOS
        let stopCondition = false // VARIAVEL QUE IRÁ RECEBER A CONDIÇÃO DE PARADA -  SE TRUE DEVE INTERROMPER A EXECUÇÃO DA FUNÇÃO
        validationArray.every(field => {
            if (field == '') {
                alert('Verifique se todos os campos foram preenchidos')
                stopCondition = true
                return false
            }
        })

        if (stopCondition) {
            return
        }

        // ARRAY QUE SERÁ ARMAZENADO AS INFORMAÇÕES DE ESTOQUE
        let stockItems = Array();

        // OBTEM E VERIFICA SE EXISTE AS INFORMAÇÕES DE ESTOQUE
        const $stockInformation = document.querySelectorAll('.fieldset-stock-item')
        if ($stockInformation) {
            $stockInformation.forEach($stock => {
                const colorName = $stock.querySelector('.product-color-name').value
                const color = $stock.querySelector('.product-color').value
                const size = $stock.querySelector('.product-size').value
                const amount = $stock.querySelector('.product-amount').value

                // VERIFICA SE OS CAMPOS RELACIONADOS A ESTOQUE ESTÃO VAZIOS
                if (!colorName.length || !color.length || !size.length || !amount.length) {
                    stopCondition = true
                    return false
                }

                const stockObj = {
                    product_color_name: colorName,
                    product_color: color,
                    size_key: size,
                    product_amount: amount
                }

                stockItems.push(stockObj)
            })

            if (stopCondition) {
                alert('Verifique se todos os campos relacionados a estoque foram preenchidos')
                return
            }
        }

        const stock = JSON.stringify(stockItems)
        formData.append('stock', stock)

        // AÇÃO QUE DEVE SER REALIZADA NO CONTROLLER
        formData.append('action', 'saveProduct')

        $.ajax({
            url: `${pathBase}/app/controllers/productController.php`,
            type: 'post',
            data: formData,
            processData: false,
            contentType: false,
            success: response => {

            },
            error: () => {
                alert('Não foi possível salvar o produto')
            }
        })


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
                aspectRatio: 3120 / 4160,
                dragMode: 'move',
                viewMode: 1,
                highlight: false,
                background: false,
                crop: event => {
                    document.querySelector('#img-x').value = event.detail.x
                    document.querySelector('#img-y').value = event.detail.y
                    document.querySelector('#img-width').value = event.detail.width
                    document.querySelector('#img-height').value = event.detail.height
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
        const subcategory = document.querySelector('#product-subcategory').value

        if (!subcategory.length) {
            alert('É necessário preencher todos os campos acima para adicionar estoque')
            return
        }
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
        const response = $.ajax({
            url: `${pathBase}/app/controllers/productController.php`,
            type: 'post',
            async: false,
            data: {
                action: 'getSubcategorySizes',
                subcategory_key: subcategory
            },
            error: () => {
                alert('Ocorreu um erro inesperado')
            }
        }).responseText

        if (response == 'false') {
            return
        }

        const productSizes = JSON.parse(response)

        productSizes.map(size => {
            const option = document.createElement('option')
            option.value = size.size_key
            option.innerHTML = size.size_name
            $selectSizes.appendChild(option)
        })

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

    //==========================================================================
    //                   FLUXO PARA BUSCAr AS SUBCATEGORIAS
    //==========================================================================
    $('#product-category').on('change', event => {
        const categoryKey = event.target.value
        let productSubCategory = document.querySelector('#product-subcategory')
        productSubCategory.innerHTML = ''

        //BUSCANDO AS SUBCATEGORIAS PARA A CATEGORIA SELECIONADA
        let response = $.ajax({
            url: `${pathBase}/app/controllers/productController.php`,
            type: 'post',
            async: false,
            data: {
                action: 'getSubcategories',
                category_key: categoryKey
            },
            error: () => {
                alert('Ocorreu um erro inesperado')
            }
        }).responseText

        console.log(response)
        if (response == 'false') {
            return;
        }
        const subCategories = JSON.parse(response)

        subCategories.map(subCategory => {
            const $option = document.createElement('option')
            $option.value = subCategory.subcategory_key
            $option.innerHTML = subCategory.subcategory_name

            productSubCategory.appendChild($option)
        })
    })

    //=========================================================================
    //          FLUXO PARA EVENTO DE CHANGE NO SELECT DE SUBCATEGORIAS
    //=========================================================================
    $('#product-subcategory').on('click', event => {

        const subcategory_key = event.target.value

        changeSelectSizes(subcategory_key)

    })
})

function changeSelectSizes(subcategory_key) {
    let productSize = document.querySelectorAll('.product-size')

    if (!productSize.length) {
        return
    }
}

