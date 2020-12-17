var loadFile = function(event) {
    var output = document.getElementById('img1');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};
$(document).ready(function() {
    function load1() {
        $("#feature").hide();
        $.ajax({
            url: "getMemberData.php",
            method: "POST",
            data: {},
            dataType: JSON.stringify(),
            //async: false,
            success: function(data) {
                //console.log(data);
                $('#accountName').text('帳號　:　' + data[0].accountName);
                $('#email').text('信箱　:　' + data[0].email);
                $('#password').attr("value", data[0].password);
                $('#nickname').attr("value", data[0].nickname);
                $('#gender').attr("value", data[1].gender);
                $('#birthday').attr("value", data[1].birthday);
                $('#introction').attr("value", data[1].introction);
                $('#img1').attr("src", (data[1].picture));
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.status);
                alert(XMLHttpRequest.readyState);
                alert(textStatus);
            },
            complete: function() {}
        })

    }
    function readmode(){
		$('#password').attr("disabled", "disabled");
    	$('#nickname').attr("disabled", "disabled");
   	 	$('#gender').attr("disabled", "disabled");
    	$('#birthday').attr("disabled", "disabled");
    	$('#introction').attr("disabled", "disabled");

    	$('#d2-1').css("display", "none");
    	$('#d2-2').css("display", "none");
    	$("#editbutt").css("display", "block");
        $("#cancelbutt").css("display", "none");
        $("#okbutt").css("display", "none");
	} 
    function editmode(){
		$('#password').removeAttr("disabled");
        $('#nickname').removeAttr("disabled");
        $('#gender').removeAttr("disabled");
        $('#birthday').removeAttr("disabled");
        $('#introction').removeAttr("disabled");
        $('#introction').removeAttr("disabled");

		$('#d2-1').css("display", "block");
        $('#d2-2').css("display", "block");
        $("#editbutt").css("display", "none");
        $("#cancelbutt").css({ "display": "block", "margin-left": "480px" });
        $("#okbutt").css({ "display": "block", "margin-left": "580px", "margin-top": "-30px" });
	}
	load1();
    readmode();

    $('#editbutt').click(function() {
        editmode();
    });
    $('#cancelbutt').click(function() {
    	if (confirm("確定取消編輯嗎？")) {
    		load1();
        	readmode();
    	}
    });

    $('#okbutt').click(function(){
        var formData = new FormData();
        //alert($("#birthday").val());
        var input = $('#uploadImg');
        var inputLength = input[0].files.length;; //No of files selected
        var file;
        if(inputLength){
        	for (var i = 0; i < inputLength; i++) {
		        file = input[0].files[i];
		        formData.append( 'myFile[]', file);
		    }
        }

        formData.append("password",$("#password").val());
        formData.append("nickname",$("#nickname").val());
        formData.append("birthday",$("#birthday").val());
        formData.append("gender",$("#gender").val());
        formData.append("introction",$("#introction").val());

        $.ajax({
            url: "member_chk.php",
            data: formData,
            type: "POST",
            async: false,
            processData: false,
            contentType: false,
            beforeSend: function() {
            },
            success: function(msg) {
            },
            error: function(xhr) {
                alert('Ajax request 發生錯誤');
            },
            complete: function() {
            }
        });
        
		load1();
        readmode();

    })

    $('#butt1-4').click(function() {
        $('#feature').toggle();
    });
    $('#feature').click(function() {
        let feature = event.srcElement.id;
        if(feature=='logout'){
            $.ajax({
                url: "logout.php",
                data: {},
                type: "POST",
                async: false,
                beforeSend: function() {},
                success: function(msg) {
                    //console.log(msg);
                    window.location="login.html";
                },
                error: function(xhr) {
                    alert('Ajax request 發生錯誤');
                },
                complete: function() {}
            });
        }
       
    });
});