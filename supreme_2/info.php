<?php
error_reporting(0);
$type = $_POST['type'];
if(empty($type)){
	echo "you can't do it!";exit;
}

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "db_test";
 
// 创建连接
$conn = new mysqli($servername, $username, $password,$dbname);
 
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 

if($type == 'register'){
	$username = $_POST['username'] ? $_POST['username'] : "";
	$pass = $_POST['pass'] ? $_POST['pass'] : "";
	if(empty($username)){
		$data['status'] = 0;
		$data['message'] = 'enter one user name!';
		echo json_encode($data);exit();
	}
	if(empty($pass)){
		$data['status'] = 0;
		$data['message'] = 'Please input a password !';
		echo json_encode($data);exit();
	}
	$password = md5($pass);
	
	$sql = "SELECT * FROM user where `username`=".$username;
	$result = $conn->query($sql);
 	$data = array();
	if ($result->num_rows > 0) {
		$data['status'] = 0;
		$data['message'] = 'User name already exists!';
		echo json_encode($data);exit();
	}else{
		$insert = "INSERT INTO user (`username`, `password`, `addtime`) VALUES ('".$username."', '".$password."', '".time()."')";
		if ($conn->query($insert) === TRUE) {
		    $data['status'] = 1;
			$data['message'] = 'Successful registration! Please login!';
		    echo json_encode($data);exit();
		} else {
		    $data['status'] = 0;
			$data['message'] = "mysql error";
		    echo json_encode($data);exit();
		}
	}
}else if($type == 'login'){
	$username = $_POST['username'] ? $_POST['username'] : "";
	$pass = $_POST['pass'] ? $_POST['pass'] : "";
	if(empty($username)){
		$data['status'] = 0;
		$data['message'] = 'enter one user name!';
		echo json_encode($data);exit();
	}
	if(empty($pass)){
		$data['status'] = 0;
		$data['message'] = 'Please input a password !';
		echo json_encode($data);exit();
	}
	$password = md5($pass);
	
	$sql = "SELECT * FROM user where `username`='".$username."' AND `password` = '".$password."'";
	$result = $conn->query($sql);
 	$data = array();
	if ($result->num_rows > 0) {
		$data['status'] = 1;
		$data['message'] = 'login successful!';
		echo json_encode($data);exit();
	}else{
		$data['status'] = 0;
		$data['message'] = "Wrong username or password!";
	    echo json_encode($data);exit();
	}
}else{
	echo "you can't do it!";exit;
}
?>