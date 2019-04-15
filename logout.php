<?php
session_start();
unset($_SESSION['username']);
	
If(isset($_SESSION['username'])){
	
	echo "<script>window.location = \"landing.php?failLogout=true\";</script>";
	
}else{
	
	echo "<script>window.location = \"index.php\";</script>";
	
}
?>
