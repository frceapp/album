$(document).ready(function () {
    window.allow_swap = true

    document.body.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        startY = e.touches[0].clientY;
    });
    
    document.body.addEventListener('touchend', (e) => {
        endX = e.changedTouches[0].clientX;
        endY = e.changedTouches[0].clientY;
        
        const deltaX = endX - startX;
        const deltaY = endY - startY;
        
        if (Math.abs(deltaX) > Math.abs(deltaY)) {
            if (!window.allow_swap) {
                return
            }

            window.allow_swap = false

            if (deltaX > 0) {
            // Swipe right
            swipeRight();
            } else {
            // Swipe left
            swipeLeft();
            }
        }
    });

    document.addEventListener('keydown', (event) => { 
        if (!window.allow_swap) {
            return
        }

        window.allow_swap = false

        if (event.keyCode == 37) {
            swipeRight();
        } else if (event.keyCode == 39) {
            swipeLeft()
        }
    });

    window.page_index = 100
    
    function swipeRight() {
        window.current_page ++
        if (window.total_page < window.current_page) {
            window.current_page --
            window.allow_swap = true
            return
        }
        $(`.${window.current_page}`).removeClass('flip')
        setTimeout(function () {
            $(`.${window.current_page}`).css('z-index', window.page_index)
            $(`.${window.current_page - 1}`).css('z-index', window.page_index - 1)
            window.allow_swap = true
        }, 50)

        window.page_index ++
    }
      
    function swipeLeft() {
        if (0 >= window.current_page) {
            window.allow_swap = true
            return
        }
        $(`.${window.current_page}`).addClass('flip')
        window.current_page --
        setTimeout(function () {
            $(`.${window.current_page}`).css('z-index', window.page_index)
            $(`.${window.current_page + 1}`).css('z-index', window.page_index - 1)
            window.allow_swap = true
        }, 500)

        window.page_index ++
    }
});


$(document).ready(function () {
    $('.front').click(function () {
        if (!login) {
            return
        }

        var id = $(this).data('id')
        $(`.file-input-front[data-page="${id}"]`).click()
    })

    $('.file-input-front').on('change', function() {
        console.log('a');
        const id = $(this).data('id');
        const file = this.files[0];
        const imagePreview = $(`.preview-front-${id}`);
    
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.attr('src', e.target.result);
                imagePreview.show();
    
                // Construct a FormData object to send the image
                const formData = new FormData();
                formData.append('image', file); // 'image' should match the API's expected field name for the image
                formData.append('id', id);
    
                // Make an AJAX request to post the image to the API
                $.ajax({
                    url: 'upload_image.php',
                    type: 'POST',
                    data: formData,
                    processData: false, // Don't process the data (needed for FormData)
                    contentType: false, // Don't set the content type (needed for FormData)
                    success: function(response) {
                        // Handle the API response here
                        console.log('Image uploaded successfully', response);
                    },
                    error: function(error) {
                        // Handle any errors that occur during the AJAX request
                        console.error('Error uploading image', error);
                    }
                });
            };
            reader.readAsDataURL(file);
        }
    });
    
    $('.login').click(async function () {
        const { value: password } = await Swal.fire({
            title: 'Enter your password',
            input: 'password',
            inputLabel: 'Password',
            inputPlaceholder: 'Enter your password',
            inputAttributes: {
              maxlength: 10,
              autocapitalize: 'off',
              autocorrect: 'off'
            }
        })
        
        if (password) {
            $.ajax({
                type: "POST",
                url: "auth.php",
                data: {
                    password: password,
                    type: 'login'
                },
                dataType: "json",
                success: function (response) {
                    console.log(response)
                    if (response.success) {
                        Swal.fire(
                            'Success',
                            'Login Success',
                            'success'
                        ).then(function () {
                            location.reload()
                        })
                    } else {
                        Swal.fire(
                            'Failed',
                            'Login failed',
                            'error'
                        )
                    }
                },
                error: function (response) {
                    console.log(response)
                    Swal.fire(
                        'Failed',
                        'Login failed',
                        'error'
                    )
                }
            });
        }
    })
});
  
  