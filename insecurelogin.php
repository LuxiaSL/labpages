<html>
    <head>
		<?php include_once('includehead.php'); ?>
        <title>Start</title>
    </head>
    <body>
        <div class="container">
            <div class="form-cont"><br><br>
                <form action="loginfn.php" method="POST">
                    <input type="hidden" name="param" value="no">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button class="btn btn-primary" type="submit">Sign in</button><br>
                </form>
            </div>
        </div>
    </body>
</html>
