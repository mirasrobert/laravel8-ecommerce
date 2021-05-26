$(function(){

    // Prevent User to press Enter
    $("form").keypress(function(e) {
        //Enter key
        if (e.which == 13) {
            return false;
        }
    });

    // Get All the Product Qty Input
    const className = document.querySelectorAll(".product_qty");

    Array.from(className).forEach(element => {

        let rowId = element.id.split('_')[2];

        let idOfEachElement = "#"+element.id;

        $(idOfEachElement).change(function(e){
            let qty = document.querySelector(idOfEachElement).value;

            updateQty(qty, rowId); // make request to Server to Update the Quantity
        });

    });

});

function updateQty(qty, rowId) {
    // Ajax Post Request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/cart",
        method: "PUT",
        data: {
            quantiy: parseInt(qty),
            rowId: rowId
        },
        success: function(response) {
            if(!response.success){
                alert("Something went wrong, please try again later");
            } else {
                // Simple Loading
                document.body.innerHTML = '<div class="spinner" role="status"></div>';

                window.location.href = '/cart';
            }
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
        }
    });

}