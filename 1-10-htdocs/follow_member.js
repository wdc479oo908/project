//const d3_title = document.getElementById('d3-1');
//const d3_2rule = document.getElementById('d3-2');
let class1;
let accountName;
//alert("QQ");
$(document).ready(function() {
	
    function load1() {
        $("#feature").hide();
		        //$('#tbody5').html('<tr height="50px"><td width="100px">讚數</td><td width="140px">縮圖</td><td width="500px">文章</td><td width="120p" >發文者</td><td width="120px" >發文時間</td><td width="120px" class="td1">postId</td></tr>');
//生日性別介紹圖片
        $('#tbody6').html('<tr height="50px"><td width="100px">追蹤作者</td><td width="100px">生日</td><td width="100px">性別</td><td width="400px">email</td><td width="140px">照片</td><td width="200px">自我介紹</td><td width="120px" class="td1">accountName</td></tr>');
        $.ajax({
            url: "follow_member.php",
            method: "POST",
            data: {},
            dataType: JSON.stringify(),
            async: false,
            //processData: false,
            //contentType: false,
            success: function(data) {
                //alert(data);
                console.log(data);
                 for (i = 0; i < data.length; i++) {
                    
                    let content =
                        "<tr >" +
                        "<td id=" + data[i].accountName + ">" + data[i].nickname +"<b id=" + data[i].accountName + ">"+ "</b>" + "<br>"+
                        "<td>" + data[i].birthday + "</td>" +
						"<td>" + data[i].gender + "</td>" +
						"<td>" + data[i].email + "</td>" +
						"<td>" + "<img src = " + data[i].picture + " width=120px height=120px>" + "</td>"+
						"<td>" + data[i].introction.substr(0, 30) + "</td>" +
                        "<td class='td1'>" + data[i].accountName + "</td>" +
                        "</tr>";
                    $("#tbody6").append(content);
                }
            },
            // error: function(XMLHttpRequest, textStatus, errorThrown) {
            //     alert(XMLHttpRequest.status);
            //     alert(XMLHttpRequest.readyState);
            //     alert(textStatus);
            // },
            complete: function() {}
        })

        
        $(".td1").hide();
        accountName = "";
    }
    load1();
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