<?php
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}

If(!isset($_SESSION['username'])){
	echo "<script>window.location = \"index.php?invalidusername\";</script>";
}

?>
