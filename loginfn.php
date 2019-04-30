<?php
include_once('includehead.php');

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$param = $_REQUEST['param'] == "yes";

print_r($_REQUEST);

if($param){
	
	$conn = db_connect(true);
	
	$qry = $conn->prepare("SELECT EXISTS(SELECT * FROM loginstore WHERE username=? AND active=1 AND password=? AND ipaddr=?) AS Pass");
	
	$qry->bind_param("sss", $username, $password, $_SERVER['REMOTE_ADDR']);
	
	$qry->execute();
	
	$qry->bind_result($pass);
	$qry->fetch();
	
	$pass['Pass'] != 0 ? Login($username, true, $param) : Login($username, false, $param);
		
}else if($param){
	
	$conn = db_connect(false);
	
	$qry = "SELECT COUNT(*) AS Pass FROM loginstore WHERE username='$username' AND active=1 AND password='$password' AND ipaddr='{$_SERVER['REMOTE_ADDR']}'";
	
	$out = mysqli_query($conn, $qry);
	$pass = mysqli_fetch_assoc($out);
	
	$pass['Pass'] != 0 ? Login($username, true, $param) : Login($username, false, $param);
	
}

function Login( $username, $success, $isParam ){
	$conn = db_connect(true);
	$ip = $_SERVER['REMOTE_ADDR'];

	$qry2 = $conn->prepare("INSERT INTO logins (username, success, ipaddr) VALUES(?,?,?)");

	if($success){
		$_SESSION['username'] == $username;

		$logSucc = 1;
		$qry2->bind_param("sis", $username, $logSucc, $ip);

		$qry2->execute();

		echo "<script>window.location = \"landing.php\";</script>";
	}else{
		$logSucc = 0;
		$qry2->bind_param("sis", $username, $logSucc, $ip);

		$qry2->execute();
		
		if($isParam){
			echo "<strong>Username, password, and IP combination not found for any active users. Please try again.</strong>";
		}else{
			echo "<script>window.location = \"insecurelogin.php?failed\";</script>";
		}
	}
}
?>

