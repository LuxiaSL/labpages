<?php include_once('includeLoginCheck.php'); ?>
<html>
  <head>
	<?php include_once('includehead.php'); ?>
    <title>Start</title>
  </head>
  <body>
    <div class="container">
		<div class="text-center mt-5" role="group">
			Landing page<br>
			Choose desired page
			<div class="btn-group btn-group-lg mt-3">
				<a href="namedsearch.php" class="btn btn-secondary">Named Logs (SQL)</a>
				<a href="numberedsearch.php" class="btn btn-secondary">Numbered Logs (SQL)</a>
				<a href="ajaxdemo.php" class="btn btn-warning">AJAX Demo (JS)</a>
			</div>
		</div>
    </div>
  </body>
</html>
