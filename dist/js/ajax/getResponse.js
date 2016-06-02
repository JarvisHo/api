
var email_confirm = function(email){

    add_pawmaji_leads(email);
    return confirm('我們會發送重要的訂單確認通知到：\n\n'+email+'\n\n請確認您的e-mail是正確的');

}

var paid_confirm = function(email){

    add_pawmaji_sales(email);

}

var add_pawmaji_leads = function(email)
{
    var URLs="/a/dist/get_response/add_pawmaji_leads.php";

    $.ajax({
        url: URLs,
        data: "email="+email,
        type:"POST",
        dataType:'text',

        success: function(msg){
            //alert(msg);
        },

        error:function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
            alert(thrownError);
        }
    });

}

var add_pawmaji_sales = function(email)
{
    var URLs="/a/dist/get_response/add_pawmaji_sales.php";

    $.ajax({
        url: URLs,
        data: "email="+email,
        type:"POST",
        dataType:'text',

        success: function(msg){
            //alert(msg);
        },

        error:function(xhr, ajaxOptions, thrownError){
            alert(xhr.status);
            alert(thrownError);
        }
    });

}