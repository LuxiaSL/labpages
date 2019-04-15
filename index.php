<?php
If(session_status() == PHP_SESSION_NONE){
	session_start();
}
?>
<html>
  <head>
	<?php include_once('includehead.php'); ?>
    <title>Start</title>
  </head>
  <body>
    <div class="container">
		<div class="text-center mt-5" role="group">
			Choose a login page<br>
			<div class="btn-group btn-group-lg mt-3">
				<a href="securelogin.php" class="btn btn-primary">Secure</a>
				<a href="insecurelogin.php" class="btn btn-primary">Insecure</a>
			</div>
		</div>
    </div>
  </body>
</html>
