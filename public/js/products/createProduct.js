$(document).ready(function () {

    let descriptionEditor;

    ClassicEditor.create(document.querySelector("#addProductForm #description"))
        .then((editor) => {
            descriptionEditor = editor;
        })
        .catch((error) => {
            console.error(error);
        });


    $('#addProductForm #loader').hide();

    let validateForm = {
        errorElement: "div",
        rules: {
            name: "required",
            price: {
                required: true,
                number: true
            },
            qty: {
                required: true,
                number: true
            },
            "image[]": {
                required: true,
                extension: "jpg|jpeg|png",
            },
            brand: {
                required: true
            },
            category: {
                required: true
            },
            description: {
                required: true,
                minlength: 50
            }
        },
        messages: {
            name: {
                required: "Name is required",
            },
            price: {
                required: "Price is required",
            },
            qty: {
                required: "Quantity is required",
            },
            "image[]": {
                required: "Please put at least one image"
            },
            brand: {
                required: "Brand is required"
            },
            category: {
                required: "Category is required"
            },
            description: {
                required: "Description is required"
            },
        },
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        errorPlacement: function (error, element) {
            // Change the location of error labels
            if (element.attr("name") == "description") {
                error.insertAfter("#addProductForm #description_validate");
            } else if (element.attr("name") == "image[]") {
                error.insertAfter("#addProductForm #image-err");
            } else {
                error.insertAfter(element);
            }
        },
        ignore: [],
        submitHandler: function () {
            $('#addProductForm #submit').attr('disabled', true);
            $('#addProductForm #cancel').attr('disabled', true);
            $('#addProductForm #loader').show();

            // AJAX with Image Uploading
            let myForm = document.getElementById("addProductForm");
            let formData = new FormData(myForm); //use formData for forms with files

            $.ajax({
                type: "POST",
                url: '/products',
                data: formData,
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    if (response.msg == 'success') {

                        Swal.fire({
                            icon: 'success',
                            title: 'Created!',
                            text: 'Product has been added.',
                            didClose: () => window.location.reload()
                        })

                        descriptionEditor.setData(''); // Clear wysiwyg form

                        $('#addProductForm #loader').hide();
                        $('#addProductForm #submit').attr('disabled', false);
                        $('#addProductForm #cancel').attr('disabled', false);

                        $("#addProductForm").trigger("reset"); // Clear the form
                        $("#createProductModal").modal("hide"); // Hide the modal
                        $("#dataTable").DataTable().reload();
                    }
                },
                error: function (error) {
                    let msg = error.responseJSON.msg;
                    if (error.status === 400 || error.status === 422) {

                        $('#addProductForm #loader').hide();
                        $('#addProductForm #submit').attr('disabled', false);
                        $('#addProductForm #cancel').attr('disabled', false);

                        Swal.fire(
                            'Oops!',
                            msg,
                            'error'
                        )
                    } else {
                        Swal.fire(
                            'Oops!',
                            'Something went wrong, please try again.',
                            'error'
                        )
                    }
                }

            });
        }
    };

    $('#addProductForm').validate(validateForm);


});
