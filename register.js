const registerButton = document.getElementById('register')
const email = document.getElementById('email')
const accountName = document.getElementById('accountName')
const passwordInput1 = document.getElementById('password1')
const passwordInput2 = document.getElementById('password2')
const nickname = document.getElementById('nickname')
const resultOutput = document.getElementById('result')
const form1 = document.getElementById("form1")
const qq = document.getElementById("qq")

function validate() {
    resultOutput.style.color = '#00f'
    resultOutput.innerText = 'Login..'
    
    $.ajax({
        url: "register_chk.php",
        data: { accountName:accountName.value  ,email: email.value ,password1: passwordInput1.value,password2:passwordInput2.value, nickname:nickname.value},
        type: "POST",
        async: false,
        beforeSend: function() {
            //$('#loading_div').show();
            //beforeSend 發送請求之前會執行的函式
        },
        success: function(msg) {
            if (msg == 'qq ') {
                resultOutput.innerText = '已有相同帳號名稱!';
                resultOutput.style.color = '#f00'
                qq.innerText = 'qq'
            } 
            else if(msg=='qq1 '){
                resultOutput.innerText = '請確認密碼是否一致!';
                resultOutput.style.color = '#f00'
                qq.innerText = 'qq'
            }
            else if(msg=='success '){
                resultOutput.style.color = '#00f'
                resultOutput.innerText = "Hi " + nickname.value + ' !'
                qq.innerText = 'success'
            }
            else {
                resultOutput.innerText = '1'+msg+'1';
                resultOutput.style.color = '#f00'
                qq.innerText = 'qq'
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
    if (qq.innerText === 'qq') return false;
    return true;

}