<html>
    <head>
		<?php include_once('includehead.php'); ?>
        <script src="validation.js"></script>
        <title>Secure Login</title>
        <style>
            #username{
                width: 70%;
            }
            #password{
                width: 70%;
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
        <h3>Secure Login</h3>
        <a href="index.php" class="btn-sm btn-danger">Return</a>
        <a class='btn-sm btn-secondary' href="#form-start">Goto sign-in</a><br><br>

		<p class="demo-explain">
            This page is the demo page for a more secure login system. It uses parameterized and prepared statements
            in order to prevent false injections.
            <br>
            The corresponding code is as follows:

            <pre><code>
                $username = $_REQUEST['username'];
                $password = $_REQUEST['password'];

                $conn = db_connect(true);

                $qry = $conn->prepare("SELECT EXISTS(SELECT * FROM loginstore WHERE username=? AND active=1 AND password=? AND ipaddr=?) AS Pass");

                $qry->bind_param("sss", $username, $password, $_SERVER['REMOTE_ADDR']);

                $qry->execute();

                $qry->bind_result($pass);
	            $qry->fetch();

                $pass != 0 ? Login($username, true, $param) : Login($username, false, $param);
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
                    Prepare the SQL statement. The statement basically checks to see if there is a return for a corresponding active username, password, and IP combo.
                </li>
                <li class="list-group-item">
                    After prepping, assign the values to the statement. Upon assigning the values, the MySQL server handles it such that no user input is allowed to escape from the string.
                </li>
                <li class="list-group-item">
                    Execute the statement, and then do something with the result. In this, the result is checked and a corresponding function executed.
                </li>
            </ol>
		</p>
            <br><hr><hr><br>

            <h3>Login form</h3>
            <div id="form-start" class="form-cont mb-5"><br>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
		    		<div class="invalid-feedback" id="username-feed"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
		    		<div class="invalid-feedback" id="password-feed"></div>
                </div>
				<div id="resDiv"></div><br>
                <button class="btn btn-primary" onclick="submit()">Sign in</button><br>
            </div>
        </div>
    </body>
    <script>
        let htmlInp = {
            username : document.getElementById('username'),
            password : document.getElementById('password'),
        };

        let htmlFeed = {
            username : document.getElementById('username-feed'),
            password : document.getElementById('password-feed')
        };

        htmlInp.username.addEventListener("keydown", function (e) {
            if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
                submit();
            }
        });

        htmlInp.password.addEventListener("keydown", function (e) {
            if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
                submit();
            }
        });

        function submit(){
            let userRes = ValidateEl(htmlInp.username, true),
                passRes = ValidateEl(htmlInp.password, true),
                resSucc = true;

            htmlFeed.username.classList.remove("failedValidation");
            if(!userRes.valid){
                htmlFeed.username.classList.add("failedValidation");
                if(userRes.reason == "empty"){
                    htmlFeed.username.innerHTML = "Empty username!";
                }else{
                    htmlFeed.username.innerHTML = "Some error occurred!";
                }
                resSucc = false;
            }

            htmlFeed.password.classList.remove("failedValidation");
            if(!passRes.valid){
                htmlFeed.password.classList.add("failedValidation");
                if(passRes.reason == "empty"){
                    htmlFeed.password.innerHTML = "Empty password!";
                }else{
                    htmlFeed.password.innerHTML = "Some error occurred!";
                }
                resSucc = false;
            }

            if(resSucc){
                let formObj = {
                    [htmlInp.username.name] : htmlInp.username.value,
                    [htmlInp.password.name] : htmlInp.password.value,
                    param : "yes",
                };

                $('#resDiv').load('loginfn.php', formObj);
            }
        }
    </script>
</html>
