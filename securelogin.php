<html>
    <head>
		<?php include_once('includehead.php'); ?>
        <script src="validation.js"></script>
        <title>Secure Login</title>
    </head>
    <body>
        <div class="container">
		<p class="demo-explain">
				
		</p>
            <div class="form-cont"><br><br>
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
				<div id="resDiv"></div>
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

        function submit(){
            let userRes = ValidateEl(htmlInp.username),
                passRes = ValidateEl(htmlInp.password),
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

                post('loginfn.php', formObj, function(res, xhr){
                    document.getElementById('resDiv').innerHTML = res;
                });
            }
        }
    </script>
</html>
