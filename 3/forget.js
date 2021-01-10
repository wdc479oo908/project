let x;
$(document).ready(function() {

    $('#form1').submit(function() {
        let email= $('#email').val()
		x=0;
        $('#result').text("");
        $.ajax({
                url: "forget.php",
                data: {email:email},
                type: "POST",
                async: false,
                //processData: false,
                //contentType: false,
                beforeSend: function() {},
                success: function(msg) {
                    if(msg=='not find'){
                        alert("此信箱尚未註冊");
                    }
                    else{
                        alert("已發送，請至信箱查看");
						x=1;
                    }
                    
                },
                error: function(xhr) {
                    alert('Ajax request 發生錯誤');
                },
                complete: function() {}
        });
		if(x)window.location.href = "login.html";;
    });

})
