const accountName = document.getElementById('accountName')
const passwordInput = document.getElementById('password')
const resultOutput = document.getElementById('result')
const form1 = document.getElementById("form1")
const qq = document.getElementById("qq")

function validate() {
    resultOutput.style.color = '#00f'
    resultOutput.innerText = 'Login..'
    
    var name = accountName.value
    var password = passwordInput.value
    $.ajax({
        url: "login_chk.php",
        data: { accountName: name , password: password},
        type: "POST",
        async: false,
        beforeSend: function() {
            //$('#loading_div').show();
            //beforeSend 發送請求之前會執行的函式
        },
        success: function(msg) {
            if (msg == 'qq ') {
                resultOutput.style.color = '#00f'
                resultOutput.innerText = "登入成功!"
                qq.innerText = 'qq2'
            } else {
                resultOutput.innerText = '帳號密碼輸入錯誤!';
                resultOutput.style.color = '#f00'
                qq.innerText = 'qq1'
            }
            
        },
        error: function(xhr) {
            alert('Ajax request 發生錯誤');
        },
        complete: function() {

            // $('#loading_div').hide();   
            //complete請求完成實執行的函式，不管是success或是error
        }
    });
    if (qq.innerText === 'qq1') return false;
    return true;

}