let x;

$(document).ready(function() {
	$('#password').keydown(function(event){
		if(event.which==13)$('#login').click();
	})
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
                if(data=="0 "){
					x=1;
					$('#form1').attr("action", "1/index.html");
					// if(data[0].identity==1)
					// {
						// $('#form1').attr("action", "index1.html");
					// }
					// else if(data[0].identity==2){
						// $('#form1').attr('action', "index2.html") ;
					// }
				}
				else if(data=="1 "){
					x=1;
					$('#form1').attr("action", "2/index.html");
				}
				else if(data=="2 "){
					x=1;
					$('#form1').attr("action", "3/index.html");
				}
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
        if(x)$('#form1').submit();

    })

});