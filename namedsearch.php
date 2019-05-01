<?php include_once('includeLoginCheck.php'); ?>
<html>
<head>
	<?php include_once('includehead.php'); ?>
	<script src="validation.js"></script>
	<title>Named Search</title>
</head>
<body>
	<div class="container mt-5">
		<h3>User Login Lookup</h3>
		<a href="landing.php" class="btn-sm btn-danger">Return</a>
		<a class='btn-sm btn-secondary' href="#resDiv">Goto search and table</a><br><br>

		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="user">User to find:</label>
				<input type="text" name="username" placeholder="Use % as a wildcard" id="username" class="form-control">
			</div>
		</div>
		<button class="btn btn-primary" onclick="search()">Search</button>

		<br><hr><hr><br>

		<div id="resDiv">

		</div>
	</div>
</body>
<script>
let htmlInp = {
    username: document.getElementById('username'),
};

function search(){
    let usernameRes = ValidateEl(htmlInp.username, false),
		resSucc = true;

    if((!usernameRes.valid) && (usernameRes.reason != "empty")){
        resSucc = false;
	}

    if(resSucc){
        let formData = {
            [htmlInp.username.name] : htmlInp.username.value,
			type : "named"
		};

        post('searchfn.php', formData, function(res, xhr){
           document.getElementById('resDiv').innerHTML = res;
		});
	}
}
</script>
</html>
