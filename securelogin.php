<html>
    <head>
		<?php include_once('includehead.php'); ?>
        <script src="validation.js"></script>
        <title>Secure Login</title>
        <script>
            let htmlInp = {
                username : document.getElementById('username'),
                password : document.getElementById('password'),
            };

            function submit(){
                let userRes = ValidateEl(htmlInp.username),
                    passRes = ValidateEl(htmlInp.password),
                    resSucc = true;

                if(!userRes.pass){
                    //do something for username
                    resSucc = false;
                }

                if(!passRes.pass){
                    //do something for password
                    resSucc = false;
                }

                if(resSucc){
                    let formObj = {
                        [htmlInp.username.name] : htmlInp.username.value,
                        [htmlInp.password.name] : htmlInp.password.value,
                        param : "yes",
                    };

                    post('loginfn.php', formObj, function(res, xhr){
                        document.getElementById('resDiv').innerHTML = res;
                    });
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="form-cont"><br><br>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
		    		<div class="feedback" id="username-feed"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
		    		<div class="feedback" id="password-feed"></div>
                </div>
				<div id="resDiv"></div>
                <button class="btn btn-primary" onclick="submit()">Sign in</button><br>
            </div>
        </div>
    </body>
</html>
