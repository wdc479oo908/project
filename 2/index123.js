const d3_title = document.getElementById('s2');
const d3_2rule = document.getElementById('s3');
let class1;
let postId;
let sort1;
$(document).ready(function() {
    class1 = "all";
	sort1="1";
    function load1() {
        $("#feature").hide();
        $('#tbody1').html('<tr height="50px"><td width="100px">讚數</td><td width="140px">縮圖</td><td width="500px">文章</td><td width="120p" >發文者</td><td width="120px" >發文時間</td><td width="120px" class="td1">postId</td></tr>');

        $.ajax({
            url: "getIndexData.php",
            method: "POST",
            data: { class: class1 ,sort:sort1},
            dataType: JSON.stringify(),
            async: false,
            //processData: false,
            //contentType: false,
            success: function(data) {
                //alert('success1');
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
            // error: function(XMLHttpRequest, textStatus, errorThrown) {
            //     alert(XMLHttpRequest.status);
            //     alert(XMLHttpRequest.readyState);
            //     alert(textStatus);
            // },
            complete: function() {}
        })

        
        $(".td1").hide();
        postId = "";
    }
    load1();

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
                //alert('success2');
                console.log(data);
                for (i = 0; i < data.length; i++) {
                    
                    let content =                   
                        "<tr><th id="+data[i].class+" >" + data[i].class+ "</th>"+
                        "</tr>";
                    $("#tbody2").append(content);
                }
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

    function load3() {
        $("#feature").hide();
        
        
        
        $.ajax({
            url: "getRuleData.php",
            method: "POST",
            data:  {class:class1},
            dataType: JSON.stringify(),
            async: false,
            //processData: false,
            //contentType: false,
            success: function(data) {
                //alert('success3');
                console.log(data);
                    
                   let  content =                   
                        "板規:" + data[0].rule;
                    $("#s3").append(content);
                
            },
            //  error: function(XMLHttpRequest, textStatus, errorThrown) {
            //      alert(XMLHttpRequest.status);
            //      alert(XMLHttpRequest.readyState);
            //      alert(textStatus);
            //  },
            complete: function() {}
        })

        $(".td1").hide();
        
    }
    


    $('#t1').click(function() {
        //there is a bug;
        class1 = event.srcElement.id;
		
		$('#s2').text(class1);
        //d3_title.innerText = class1;   
        d3_2rule.innerText='';

        load1();
        if(class1!='all')
            load3();
    });
	
	$('#sele1').change(function() {
        sort1=$('#sele1').val();
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
                    window.location="/../final/login.html";
                },
                error: function(xhr) {
                    alert('Ajax request 發生錯誤');
                },
                complete: function() {}
            });
        }
       
    });
	$('#search').keydown(function(event){
        if(event.which==13)$('#searchButton').click();
    })
    $('#searchButton').click(function() {
        let search=$('#search').val();
        if(search=="")return;
        $('#tbody1').html('<tr height="50px"><td width="100px">讚數</td><td width="140px">縮圖</td><td width="500px">文章</td><td width="120p" >發文者</td><td width="120px" >發文時間</td><td width="120px" class="td1">postId</td></tr>');
        $.ajax({
            url: "search.php",
            method: "POST",
            data: { search: search ,class: class1 },
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
                        "<td class='td2' id=" + data[i].postId + ">" + "<b id=" + data[i].postId + ">" + data[i].title + "</b>" + "<br>" + data[i].context.substr(0, 30) + "........</td>" +
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

    });

})