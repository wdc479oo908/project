let x;

$(document).ready(function() {

    $('#login').click(function(){
        var name = $('#accountName').val();
        var password = $('#password').val();
        x=0;
       

         $.ajax({
            url: "login_chk.php",
            method: "POST",
            data: { accountName: name ,password:password},
            dataType: JSON.stringify(),
            async: false,
            //processData: false,
            //contentType: false,
            success: function(data) {
                if(data=="qq ")x=1;
                else{
                    $('#result').text("帳號密碼輸入錯誤");
                    $('#result').css("color","red");
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.status);
                alert(XMLHttpRequest.readyState);
                alert(textStatus);
            },
            complete: function() {}
        })
        //if(x)$('#form1').submit();

    })

});