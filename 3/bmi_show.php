<?php 
	function getBMI($w, $h){
		if(is_numeric($w)&&is_numeric($h)){
			$h /= 100;
			$bmi = $w /($h * $h);
			$bmi = round($bmi,2);
		}
		else{
			$bmi = '錯誤' ;
		}
		return $bmi;
	}
	$weight = $_POST['w'];
	$height = $_POST['h'];

	$bmi= getBMI($weight,$height);
	
 ?>
<!DOCTYPE html>
<html>
	<head>
		<meta content="text/html" charset="utf-8">
		<title>BMI結果</title>
	</head>
	<body>
		<div>你的 BMI : <?php echo $bmi ; ?></div>
		<a href="bmi.php">回表單</a>
	</body>
</html>