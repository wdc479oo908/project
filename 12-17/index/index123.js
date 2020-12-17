const d3_title = document.getElementById('d3-1');
let class1;
let postId;

$(document).ready(function() {
    class1 = "all";

    function load1() {
        $("#feature").hide();
        $('#tbody1').html('<tr height="50px"><td width="100px">讚數</td><td width="140px">縮圖</td><td width="500px">文章</td><td width="120p" >發文者</td><td width="120px" >發文時間</td><td width="120px" class="td1">postId</td></tr>');

        $.ajax({
            url: "getIndexData.php",
            method: "POST",
            data: { class: class1 },
            dataType: JSON.stringify(),
            async: false,
            //processData: false,
            //contentType: false,
            success: function(data) {
                //alert('success');
                //console.log(data);
                for (i = 0; i < data.length; i++) {
                    if (data[i].picture == "picture/") data[i].picture = "thumbnail.png";
                    if (data[i].nickname == "") data[i].nickname = "匿名";
                    let content =
                        "<tr >" +
                        "<td>" + data[i].class + "<br>" + "<br>" + data[i].good + "</td>" +
                        "<td>" + "<img src = " + data[i].picture + " width=120px height=120px>" + "</td>" +
                        "<td id=" + data[i].postId + ">" + "<b id=" + data[i].postId + ">" + data[i].title + "</b>" + "<br>" + data[i].context.substr(0, 30) + "........</td>" +
                        "<td>" + data[i].nickname + "</td>" +
                        "<td>" + data[i].postDate.substr(0, 10) + "</td>" +
                        "<td class='td1'>" + data[i].postId + "</td>" +
                        "</tr>";
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
        $(".td1").hide();
        postId = "";
    }
    load1();

    $('#t1').click(function() {
        class1 = event.srcElement.id;
        if (class1 == 'all') d3_title.innerText = "所有看板";
        else if (class1 == 'emotion') d3_title.innerText = "感情看板";
        else if (class1 == 'game') d3_title.innerText = "電玩看板";
        else if (class1 == 'sport') d3_title.innerText = "運動看板";
        else if (class1 == 'food') d3_title.innerText = "美食看板";
        else if (class1 == 'schoolwork') d3_title.innerText = "課業看板";
        else if (class1 == 'politics') d3_title.innerText = "政治看板";
        else if (class1 == 'others') d3_title.innerText = "其它看板";
        load1();
    });
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