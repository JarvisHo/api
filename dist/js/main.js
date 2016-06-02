// enable animation
new WOW().init();

// call modal
$(document).ready(function () {
    $("a[rel*=modal]").leanModal({top: 150, overlay: 0.6, closeButton: ".modal_close"});//一般頁面
    $("a[rel*=modal-high]").leanModal({top: 50, overlay: 0.6, closeButton: ".modal_close"});//mobile devices頁面
});

$(document).ready(function () {
    $(".openDetail").fancybox({
        maxWidth: 600,
        // maxHeight : 600,
        autoSize: true,
        closeClick: false,
        openEffect: 'fade',
        closeEffect: 'fade',
        closeBtn: true,
        helpers: {
            overlay: {
                css: {
                    'background': 'rgba(0, 0, 0, 0.6)'
                }
            }
        }
    });
    $('#closeDetail').on('click', function () {
        $.fancybox.close();
    });
});

// open extrnal links in new window
$(document).ready(function () {
    $('a').each(function () {
        var a = new RegExp('/' + window.location.host + '/');
        if (!a.test(this.href)) {
            $(this).click(function (event) {
                event.preventDefault();
                event.stopPropagation();
                window.open(this.href, '_blank');
            });
        }
    });
});

// 登入可以用 ENTER key
$('#loginForm input').keydown(function (event) {
    if (event.keyCode == 13) {
        event.preventDefault(); // <----
        var URLs = "php/ctrl_login.php";
        $.ajax({
            url: URLs,
            data: $('#loginForm').serialize(),
            type: "POST",
            dataType: 'text',
            success: function (msg) {
                if (msg == "OK") {
                    window.location = "../../membership.php";
                } else {
                    alert(msg);
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }
});