<html>
    <head>
		<?php include_once('includehead.php'); ?>
        <title>Insecure Login</title>
    </head>
    <body>
        <div class="container mt-5">
            <h3>Insecure Login</h3>
            <a href="index.php" class="btn-sm btn-danger">Return</a>
            <a class='btn-sm btn-secondary' href="#form-start">Goto sign-in</a><br><br>
            <p class="demo-explain">
                This page is the demo page for a very insecure login system. It performs no validations, and doesn't sanitize input.
                <br>
                The corresponding code is as follows:

            <pre><code>
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];

            $conn = db_connect(false);

            $qry = "SELECT COUNT(*) AS Pass FROM loginstore WHERE username='$username' AND active=1 AND password='$password' AND ipaddr='{$_SERVER['REMOTE_ADDR']}'";

            $out = mysqli_query($conn, $qry);
            $pass = mysqli_fetch_assoc($out);

            $pass['Pass'] != 0 ? Login($username, true, $param) : Login($username, false, $param);
            </code></pre><br>

            The pseudo-code steps are as follows:<br><br>

            <ol class="list-group">
                <li class="list-group-item">
                    Retrieve the username and password from the POST
                </li>
                <li class="list-group-item">
                    Establish a connection to the MySQL server
                </li>
                <li class="list-group-item">
                    Generate the SQL statement. Basically, it checks to see if there are any accounts for a given username password, and IP.<br>
                    However, none of the inputs are filtered, and they only use single quotes, making it possible to escape.
                </li>
                <li class="list-group-item">
                    Execute the query, then assign the results.
                </li>
                <li class="list-group-item">
                    Do something with the results. In this, it checks to see whether the user entered the correct information (or simply returns a column named Pass that isnt equal to zero)
                </li>
            </ol>



            </p>
            <br><hr><hr><br>

            <h3>Login form</h3>
            <div class="form-cont"><br><br>
                <form id="form-start" action="loginfn.php" method="POST">
                    <input type="hidden" name="param" value="no">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div id="resDiv">
                        <?php if(isset($_REQUEST['failed'])): ?>
                            <strong>Username, password, and IP combination not found for any active users. Please try again.</strong>
                        <?php endif; ?>
                    </div><br>
                    <button class="btn btn-primary" type="submit">Sign in</button><br>
                </form>
            </div>
        </div>
    </body>
</html>
