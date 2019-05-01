<?php include_once('includeLoginCheck.php'); ?>
<html>
	<head>
		<?php include_once('includehead.php'); ?>
    	<title>Landing</title>
  	</head>
  	<body>
        <div class="container">
			<div class="text-center mt-5">
                <h3>Landing page</h3><br>
				Choose desired page<br>

				<div class="btn-group btn-group-lg mt-3" role="group">
					<a href="numberedsearch.php" class="btn btn-secondary">Numbered Logs (SQL)</a>
					<a href="ajaxdemo.php" class="btn btn-warning">AJAX Demo (JS)</a>
				</div>
			</div>
    	</div>
  	</body>
    <?php include_once('includefooter.php'); ?>
</html>
