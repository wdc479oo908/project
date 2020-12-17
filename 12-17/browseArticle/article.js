$(document).ready(function() {

    function load1() {
        $("#feature").hide();
        $.ajax({
            url: "getArticleData.php",
            method: "POST",
            data: {},
            dataType: JSON.stringify(),
            async: false,
            //processData: false,
            //contentType: false,
            success: function(data) {
                //alert('success');
                //console.log(data);
                $('#post_nickname').text("發文者 : " + data[0].nickname);
                $('#post_accountName').text(" @" + data[0].accountName);
                $('#post_date').text("發文日期 : " + data[0].postDate.substr(0, 16));
                $('#post_title').text("標題 : " + data[0].title);
                $('#post_context').text(data[0].context);
                if(data[0].picture!="picture/"){
                    $('#img1').attr("src", data[0].picture);
                }
				
				
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.status);
                alert(XMLHttpRequest.readyState);
                alert(textStatus);
            },
            complete: function() {}
        })
        $("img").each(function(){   
            if($(this).width() > $(this).height()){    
                if($(this).width()>400)$(this).width(400);
            }
            else{
                if($(this).height()>400)$(this).height(400);
            }
        });
    }
    load1();

    function load2() {
        $("#feature").hide();
        $.ajax({
            url: "getCommentData.php",
            method: "POST",
            data: {},
            dataType: JSON.stringify(),
            async: false,
            //processData: false,
            //contentType: false,
            success: function(data) {
                //alert('success');
                console.log(data);
              
				
				content='';
				$("#tbody1").append(content);
                

                for (i = 0; i < data.length; i++) {
                   
                    let content =
                    "<hr/>@" + data[i].accountName+"<br/>"+
                    data[i].commentTime+"<br/>"+
                    data[i].comment;
                    $("#tbody1").append(content);
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.status);
                alert(XMLHttpRequest.readyState);
                alert(textStatus);
            },
            complete: function() {}
        })
      
    }
    load2();

    $('#butt1-4').click(function() {
        $('#feature').toggle();
    });
    $('#feature').click(function() {
        let feature = event.srcElement.id;
        if (feature == 'logout') {
            $.ajax({
                url: "logout.php",
                data: {},
                type: "POST",
                async: false,
                beforeSend: function() {},
                success: function(msg) {
                    //console.log(msg);
                    window.location = "login.html";
                },
                error: function(xhr) {
                    alert('Ajax request 發生錯誤');
                },
                complete: function() {}
            });
        }

    });

})