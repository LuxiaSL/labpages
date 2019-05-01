<html>
	<head>
		<?php include_once('includehead.php'); ?>
    	<title>Start</title>
	</head>
  	<body>
    	<div class="container">
			<div class="text-center mt-5">
				Choose a login page<br>
				<div class="btn-group btn-group-lg mt-3" role="group">
					<a href="securelogin.php" class="btn btn-primary">Secure</a>
					<a href="insecurelogin.php" class="btn btn-primary">Insecure</a>
				</div>
                <div class="mt-3">
                    <?php if(isset($_REQUEST['invalidusername'])): ?>
                        <strong>Error: You were not logged in. Please log in.</strong>
                    <?php endif; ?>
                </div>
			</div>
    	</div>
  	</body>
</html>
