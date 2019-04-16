<?php
include_once('includehead.php');

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];

if($_REQUEST['param'] == "Yes"){
	
	$conn = db_connect(true);
	
	$qry = $conn->prepare("SELECT EXISTS(SELECT * FROM logins WHERE username=? AND active=1 AND password=? AND ipaddr=?) AS Pass");
	
	$qry->bind_param("sss", $username, $password, $_SERVER['REMOTE_ADDR']);
	
	$qry->execute();
	
	$qry->bind_result($pass);
	$qry->fetch();
	
	$pass['Pass'] != 0 ? Login($username, true) : Login($username, false);
		
}else{
	
	$conn = db_connect(false);
	
	$qry = "SELECT COUNT(*) AS Pass FROM logins WHERE username='$username' AND active=1 AND password='$password' AND ipaddr='{$_SERVER['REMOTE_ADDR']}'";
	
	$out = mysqli_query($conn, $qry);
	$pass = mysqli_fetch_assoc($out);
	
	$pass['Pass'] != 0 ? Login($username, true) : Login($username, false);
	
}

function Login( string $username, bool $success ){
	$conn = db_connect(true);
	$ip = $_SERVER['REMOTE_ADDR'];

	$qry2 = $conn->prepare("INSERT INTO logintrack (username, success, ipaddr) VALUES(?,?,?)");

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

		echo "<strong>Username, password, and IP combination not found for any active users. Please try again.</strong>";
	}
}
?>

