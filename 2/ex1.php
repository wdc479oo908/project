<?php
$host = 'localhost';
//改成你登入phpmyadmin帳號
$user = 'root';
//改成你登入phpmyadmin密碼
$passwd = 'ab2137';
//資料庫名稱
$database = 'test';
//實例化mysqli(資料庫路徑, 登入帳號, 登入密碼, 資料庫)
$connect = new mysqli($host, $user, $passwd, $database);
 
if ($connect->connect_error) {
    die("連線失敗: " . $connect->connect_error);
}
else echo "連線成功".'<br>';
//設定連線編碼，防止中文字亂碼)
$connect->query("SET NAMES 'utf8'");

$a = 'user03';
// 新增資料列
$insertSql = "INSERT INTO register (accountID,accountName,email,password,nickname) VALUES ('$a','amy002', 'cdykino2@yahoo.com','ab2222','Amy')";
// 呼叫query方法(SQL語法)
$status = $connect->query($insertSql);
 
if ($status) {
    echo '新增成功'.'<br>';
} 
else {
    echo "錯誤: " . $insertSql . "<br>" . $connect->error;
}  

//查詢指令資料列
$selectSql = "SELECT * FROM register WHERE accountId = 'user03'";
//呼叫query方法(SQL語法)
$memberData = $connect->query($selectSql);
//有資料筆數大於0時才執行
if ($memberData-> num_rows > 0) {
//讀取剛才取回的資料
    while ($row = $memberData->fetch_assoc()) {
		foreach($row as $key=>$value)
		echo $key." => ".$value.'<br>';
        // print_r($row);
    }
} 
else{
    echo '0筆資料';
}

//修改指定資料列
$updateSql = "UPDATE register SET nickname = 'jack' WHERE accountID = 'user03'";
//呼叫query方法(SQL語法)
$status = $connect->query($updateSql);
 
if ($status) {
    echo '更新成功'.'<br>';
} 
else {
    echo "錯誤: " . $updateSql . "<br>" . $connect->error;
}

//刪除指定資料列
$deleteSql = "DELETE FROM register WHERE accountID = 'user03' ";
//呼叫query方法(SQL語法)
$status = $connect->query($deleteSql);
 
if ($status) {
    echo '刪除成功'.'<br>';
} 
else{
    echo "錯誤: " . $deleteSql . "<br>" . $connect->error;
}

?>