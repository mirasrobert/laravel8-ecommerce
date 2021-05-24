// POPULATE SHIPPING PROVINCE, CITY, BRGY.

$(document).ready(function() {
    // if Dropdown data has been change
    $(".province").change(function() {
        if ($(this).val() != "" || $(this.val() != "Choose")) {
            let select = $(this).attr("id");
            let value = $(this).val(); // Id or value of dropdowwn
            let dependent = $(this).data("dependent"); // Class or Dropdown that will be populated
            let _token = $('input[name="_token"]').val(); // CSRF TOKEN

            $.ajax({
                url: "/populate/city",
                method: "POST",
                data: {
                    select: select,
                    value: value,
                    _token: _token,
                    dependent: dependent
                },
                success: function(result) {
                    $("#" + dependent).html(result);
                    $("#barangay").html(
                        "<option selected='Choose' value='Choose' disabled>Choose...</option>"
                    );
                }
            });
        }
    });

    // PUPULATE THE BARANGAY DROPDOWN
    $(".city").change(function() {
        if ($(this).val() != "" || $(this.val() != "Choose")) {
            let select = $(this).attr("id");
            let value = $(this).val();
            let dependent = $(this).data("dependent");
            let _token = $('input[name="_token"]').val();

            $.ajax({
                url: "/populate/brgy",
                method: "POST",
                data: {
                    select: select,
                    value: value,
                    _token: _token,
                    dependent: dependent
                },
                success: function(result) {
                    $("#" + dependent).html(result);
                }
            });
        }
    });
});
