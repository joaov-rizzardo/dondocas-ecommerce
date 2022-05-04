$(document).ready(() => {

    // AQUI DEVE FICAR TODAS AS MASCARAS UTILIZADAS NA PÁGINA
    $('#product-value').mask('00000,00', {
        reverse: true
    })

    $('#promotion_value').mask('00000,00', {
        reverse: true
    })

    $('#save').on('click', () => {

        showLoading()

        const productName = document.querySelector('#product-name').value
        const productValue = document.querySelector('#product-value').value
        const productCategory = document.querySelector('#product-category').value
        const productSubCategory = document.querySelector('#product-subcategory').value
        const productPromotion = document.querySelector('#promotion').checked
        const productPromotionValue = document.querySelector('#promotion_value').value
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
        formData.append('product_promotion', productPromotion ? 1 : 0)
        formData.append('product_promotion_value', productPromotionValue)

        const productKey = document.querySelector('#product_key').value

        if (productKey.length) {
            formData.append('product_key', productKey)
        }

        // ARRAY QUE SERÁ PERCORRIDO PARA REALIZAR A VALIDAÇÃO DOS CAMPOS
        let validationArray = [
            productName,
            productValue,
            productCategory,
            productSubCategory,
        ]

        const files = document.querySelector('#img-file').files

        // VALIDA SE FOI SELECIONADA UMA IMAGEM
        if (files.length == 0 && !productKey.length) {
            hideLoading()
            alert('Nenhuma imagem foi selecionada')
            return
        }

        if (files.length > 0) {

            const image = files[0]

            // ATRIBUI OS VALORES REFERENTES A IMAGEM NO FORMDATA
            formData.append('image', image)
            formData.append('imageX', imageX)
            formData.append('imageY', imageY)
            formData.append('imageWidth', imageWidth)
            formData.append('imageHeight', imageHeight)

            // ATRIBUÍ AS POSIÇÕES DA IMAGEM AO ARRAY DE VALIDAÇÃ
            validationArray.push(imageX)
            validationArray.push(imageY)
            validationArray.push(imageWidth)
            validationArray.push(imageHeight)
        }


        // REALIZA A VALIDAÇÃO DOS CAMPOS
        let stopCondition = false // VARIAVEL QUE IRÁ RECEBER A CONDIÇÃO DE PARADA -  SE TRUE DEVE INTERROMPER A EXECUÇÃO DA FUNÇÃO
        validationArray.every(field => {
            if (field == '') {
                hideLoading()
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

                const $stockKey = $stock.querySelector('.stock_key')

                if ($stockKey) {

                    if ($stockKey.value != '') {
                        stockObj.stock_key = $stockKey.value
                    }
                }

                stockItems.push(stockObj)
            })

            if (stopCondition) {
                hideLoading()
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
                hideLoading()
                alert('Produto cadastrado com sucesso!')
                window.location.href = `?product_key=${response}`
            },
            error: () => {
                alert('Não foi possível salvar o produto')
            }
        })


    })

    $('#del-product').on('click', () => {

        const productKey = document.querySelector('#product_key').value

        if (!productKey) {
            alert('O produto ainda não foi cadastrado!')
            return
        }

        if (!confirm('Tem certeza que deseja excluir o produto?')) {
            return;
        }

        showLoading()

        $.ajax({
            url: `${pathBase}/app/controllers/productController.php`,
            type: 'post',
            async: false,
            data: {
                action: 'delProduct',
                productKey: productKey
            },
            success: () => {
                hideLoading()
                alert('Produto excluído com sucesso!')
                window.location.href = '?'
            },  
            error: () => {
                hideLoading()
                alert('Ocorreu um erro inesperado')
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

        showLoading()

        // RECEBE A URL DA IMAGEM
        reader.readAsDataURL(files[0])

        reader.onload = () => {

            hideLoading()

            $image.src = reader.result

            // CRIA A DIV QUE IRÁ RECEBER O PREVIEW DA IMAGEM CASO ELA NÃO EXISTA
            let $divPhoto = document.querySelector('#photo')

            if (!$divPhoto) {
                $divPhoto = document.createElement('div')
                $divPhoto.id = 'photo'

                document.querySelector('#photo-preview').appendChild($divPhoto)
            }

            $('.modal').show()

            // CONFIGURAÇÕES PARA O CROPPER
            const cropper = new Cropper($image, {
                aspectRatio: 3120 / 4160,
                dragMode: 'move',
                viewMode: 1,
                preview: '#photo',
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

                const $image = document.querySelector('#photo img')

                cropper.destroy()

                let $divPhoto = document.querySelector('#photo')

                if (!$divPhoto) {
                    $('.modal').hide()
                    return
                }

                $divPhoto.innerHTML = ''

                $divPhoto.appendChild($image)

                $('.modal').hide()
            })
        }
    })

    //==================================================//
    //       FLUXO PARA ADICIONAR LINHA DE ESTOQUE      //
    //==================================================//

    $('#stock_add').on('click', () => {
        showLoading()
        const category = document.querySelector('#product-category').value

        if (!category.length) {
            hideLoading()
            alert('É necessário preencher todos os campos acima para adicionar estoque')
            return
        }
        const $fieldset = document.createElement('fieldset')
        $fieldset.className = "fieldset-stock-item"

        const $button = document.createElement('button')
        $button.setAttribute('onclick', 'delStockLine(event)')
        $button.innerHTML = '<i class="fa-solid fa-xmark"></i>'

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

        //Requisição para buscar os tamanhos
        const response = $.ajax({
            url: `${pathBase}/app/controllers/productController.php`,
            type: 'post',
            async: false,
            data: {
                action: 'getCategorySizes',
                category_key: category
            },
            error: () => {
                hideLoading()
                alert('Ocorreu um erro inesperado')
            }
        }).responseText

        if (response == 'false') {
            hideLoading()
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
        $fieldset.appendChild($button)
        $fieldset.appendChild($divColor)
        $fieldset.appendChild($divSize)
        // INCLUINDO A DIV NO HTML
        const $sectionStock = document.querySelector('#stock-information')
        $sectionStock.appendChild($fieldset)

        hideLoading()
    })

    //==========================================================================
    //                   FLUXO PARA BUSCAR AS SUBCATEGORIAS
    //==========================================================================
    $('#product-category').on('change', event => {
        showLoading()
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
                hideLoading()
                alert('Ocorreu um erro inesperado')
            }
        }).responseText

        if (response == 'false') {
            hideLoading()
            return;
        }
        const subCategories = JSON.parse(response)

        subCategories.map(subCategory => {
            const $option = document.createElement('option')
            $option.value = subCategory.subcategory_key
            $option.innerHTML = subCategory.subcategory_name

            productSubCategory.appendChild($option)
        })

        const subcategory_key = document.querySelector('#product-subcategory').value
        changeSelectSizes(subcategory_key)
    })

    //=========================================================================
    //          FLUXO PARA EVENTO DE CHANGE NO SELECT DE SUBCATEGORIAS
    //=========================================================================
    $('#product-subcategory').on('change', event => {

        showLoading()

        const subcategory_key = event.target.value

        changeSelectSizes(subcategory_key)

    })

})

function changeSelectSizes(subcategory_key) {

    // RECEBE A NODELIST COM OS SELECTS DE TAMANHO
    let $productSizes = document.querySelectorAll('.product-size')

    if (!$productSizes.length) {
        hideLoading()
        return
    }

    // BUSCA OS TAMANHOS PARA A SUBCATEGORIA SELECIONADA
    let response = $.ajax({
        url: `${pathBase}/app/controllers/productController.php`,
        type: 'post',
        async: false,
        data: {
            action: 'getSubcategorySizes',
            subcategory_key: subcategory_key
        },
        error: () => {
            hideLoading()
            alert('Ocorreu um erro inesperado')
        }
    }).responseText

    if (!response) {
        hideLoading()
        return false
    }

    const subcategorySizes = JSON.parse(response)

    //==========================================================================
    //              PERCORRE OS SELECTS DE TAMANHO E CRIA 
    //      AS OPÇÕES COM BASE NOS DADOS RETORNADOS DA REQUISIÇÃO
    //==========================================================================
    $productSizes.forEach(item => {
        item.innerHTML = '';

        subcategorySizes.map(size => {
            const option = document.createElement('option')
            option.value = size.size_key
            option.innerHTML = size.size_name
            item.appendChild(option)
        })
    })

    hideLoading()
}

//=========================================================================
//                FLUXO PARA EXCLUIR A LINHA DE ESTOQUE
//=========================================================================
function delStockLine(event) {

    if (!confirm('Você tem certeza que deseja excluir a linha de estoque?')) {
        return
    }

    showLoading();

    const $fieldset = event.target.closest('fieldset')

    const $stockKey = $fieldset.querySelector('.stock_key')

    if ($stockKey) {
        const stock_key = $stockKey.value

        $.ajax({
            url: `${pathBase}/app/controllers/productController.php`,
            type: 'post',
            async: false,
            data: {
                action: 'delStock',
                stock_key
            },
            error: () => {
                hideLoading()
                alert('Ocorreu um erro inesperado')
            }
        })
    }

    hideLoading()

    $fieldset.parentNode.removeChild($fieldset)
}
