var load_product = function () {
    var URLs = "product";
    $.ajax({
        url: URLs,
        data: $('#search').serialize(),
        type: "POST",
        dataType: 'text',
        success: function (msg) {
            $('#products').html(msg);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}
var search = function () {
    var URLs = "php/products.php";
    $.ajax({
        url: URLs,
        data: $('#search').serialize(),
        type: "POST",
        dataType: 'text',
        success: function (msg) {
            $('#products').html(msg);
            setBrandImage();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}
var setBrandImage = function () {
    var URLs = "php/brand.php";
    $.ajax({
        url: URLs,
        type: "POST",
        dataType: 'text',
        success: function (msg) {
            if (msg != '')$('#brandImage').html(msg);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}