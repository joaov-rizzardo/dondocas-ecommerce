$(document).ready(() => {
    $('#save').click(() => {
        const files = document.querySelector('#img-file').files
        let reader = new FileReader();

        reader.readAsDataURL(files[0])

        reader.onload = () => {
            console.log(reader.result)
        }
        
        
    })

    $('#save-img').click(() => {
        $('.modal').hide();
    })

    $('#img-file').on('change', event => {
        const $image = document.querySelector('#img-modal')
        
        let files = event.target.files

        let reader = new FileReader();

        reader.readAsDataURL(files[0])

        //console.log(reader)
        reader.onload = () => {
            console.log(reader.result)
            $image.src = reader.result
            $('.modal').show()

            const cropper = new Cropper($image, {
                aspectRatio: 16/9,
                dragMode: 'move',
                background: false,
                movable: false,
                scalable: false,
                zoomable: false,
                crop: event => {
                    console.log(event.detail.x);
                    console.log(event.detail.y);
                    console.log(event.detail.width);
                    console.log(event.detail.height);
                    console.log(event.detail.rotate);
                    console.log(event.detail.scaleX);
                    console.log(event.detail.scaleY);
                }
            })

        }

    })
})

