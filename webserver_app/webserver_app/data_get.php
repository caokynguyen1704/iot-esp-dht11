<?php
/*    if (isset($_GET)){
        if (isset($_GET['sign'])){
			#setup mySQL
			ini_set('error_reporting', E_STRICT);
            $pdo = new PDO('mysql:host=localhost;port=3306;dbname=webserver','root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM device WHERE sign = :xacthuc";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(':xacthuc' => md5($_GET['sign'])));
			$rows = $stmt->fetchAll();
			if (count($rows)==1){
				if ((isset($_GET['dateget']))){
					$val=$_GET['dateget'];
					echo $val;
					$sql = 'SELECT * FROM data WHERE date_post like ":ngay %"';
					$stmt = $pdo->prepare($sql);
					$stmt->execute(array(':ngay' => $val));
					$rows = $stmt->fetchAll();
					echo count($rows);

					#$myJSON = json_encode($response);
					#echo $myJSON;
				}
			}
        }
	}*/
	echo "Chưa xong";
?>