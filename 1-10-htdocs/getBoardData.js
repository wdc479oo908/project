 const d3_title = document.getElementById('d3-1');
const d3_2rule = document.getElementById('d3-2');
let class1;
let postId;

$(document).ready(function() {
    class1 = "all";

    function load2() {
        $("#feature").hide();
       
        
        $.ajax({
            url: "getBoardData.php",
            method: "POST",
            data:  {class :class1},
            dataType: JSON.stringify(),
            async: false,
            //processData: false,
            //contentType: false,
            success: function(data) {
                //alert('success');
                console.log(data);
				let content =  "<option value=0>"+"看板分類"+"</option>" ;
                for (i = 0; i < data.length; i++) {
                    
                    
						content=content+"<option value="+data[i].class+" >" +data[i].class+"</option>";
                    
                }
				$("#sele1").append(content);
            },
            //  error: function(XMLHttpRequest, textStatus, errorThrown) {
            //      alert(XMLHttpRequest.status);
            //      alert(XMLHttpRequest.readyState);
            //      alert(textStatus);
            // },
            complete: function() {}
        })

        $(".td1").hide();
        
    }
    load2();

   

    $('#t2').click(function() {
        let x = event.srcElement.id;
        if (x.substr(0, 4) == "post") {
            postId = x;
        } else return;
        $.ajax({
            url: "index_chk.php",
            data: { postId: postId },
            type: "POST",
            async: false,
            beforeSend: function() {},
            success: function(msg) {
                //alert(msg);
                $('#form1').submit();
            },
            error: function(xhr) {
                alert('Ajax request 發生錯誤');
            },
            complete: function() {}
        });
    });
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

})