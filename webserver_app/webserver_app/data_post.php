<?php

    if (isset($_POST)){
		ini_set('error_reporting', E_STRICT);
        $pdo = new PDO('mysql:host=localhost;port=3306;dbname=webserver','root', ''); 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (isset($_POST['sign'])){
			#post dạng form
			#setup mySQL
			$sql = 'SELECT * FROM device WHERE sign = :xacthuc';
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(':xacthuc' => md5($_POST['sign'])));
			$rows = $stmt->fetchAll();
			if (count($rows)==1){
				$sql = 'SELECT * FROM device WHERE sign = :xacthuc';
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(':xacthuc' => md5($data['sign'])));
				$rows = $stmt->fetchAll();
				$device_id=$rows[0]['device_id'];
				if (((isset($_POST['nhietdo'])))&&(isset($_POST['doam']))){
					date_default_timezone_set('Asia/Ho_Chi_Minh');
					$sql = "INSERT INTO data (date_post, nhietdo, doam) VALUES (:datepost, :nhietdo, :doam, :deviceid)";
					$stmt = $pdo->prepare($sql);
					$stmt->execute(array(
						':datepost' => date("d/m/Y H:i"),
						':nhietdo' => $_POST['nhietdo'],
						':doam' => $_POST['doam'],
						':device_id'=>$device_id));
					$response->status = 1;
					$response->msg = "Thêm thành công";
				}else{
					$response->status = 99;
					$response->msg = "Thiếu trường";
				}
			}else{
				$response->status = 200;
				$response->msg = "Xác thực không thành công";
			}
			$myJSON = json_encode($response);
			echo $myJSON;
        }else{
			#post dạng json
			$data = json_decode(file_get_contents('php://input'), true);
			if (isset($data)) {
				if (isset($data['sign'])){
					$sql = 'SELECT * FROM device WHERE sign = :xacthuc';
					$stmt = $pdo->prepare($sql);
					$stmt->execute(array(':xacthuc' => md5($data['sign'])));
					$rows = $stmt->fetchAll();
					if (count($rows)==1){
						$sql = 'SELECT * FROM device WHERE sign = :xacthuc';
						$stmt = $pdo->prepare($sql);
						$stmt->execute(array(':xacthuc' => md5($data['sign'])));
						$rows = $stmt->fetchAll();
						$device_id=$rows[0]['device_id'];
						if (((isset($data['nhietdo'])))&&(isset($data['doam']))){
							date_default_timezone_set('Asia/Ho_Chi_Minh');
							$sql = "INSERT INTO data (date_post, nhietdo, doam, device_id) VALUES (:datepost, :nhietdo, :doam, :deviceid)";
							$stmt = $pdo->prepare($sql);
							$stmt->execute(array(
								':datepost' => date("d/m/Y H:i"),
								':nhietdo' => $data['nhietdo'],
								':doam' => $data['doam'],
								':deviceid'=>$device_id));
							$response->status = 1;
							$response->msg = "Thêm thành công";
						}else{
							$response->status = 99;
							$response->msg = "Thiếu trường";
						}
					}else{
						$response->status = 200;
						$response->msg = "Xác thực không thành công";
					}
					$myJSON = json_encode($response);
					echo $myJSON;
				}
			}
		}
    }
?>