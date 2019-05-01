<?php include_once('includeLoginCheck.php'); ?>
<html>
<head>
	<?php include_once('includehead.php'); ?>
	<script src="validation.js"></script>
	<title>Numbered Search</title>
</head>
<body>
<div class="container mt-5">
	<h3>User Login Lookup</h3>
	<a href="landing.php" class="btn-sm btn-danger">Return</a>
	<a class='btn-sm btn-secondary' href="#resDiv">Goto search and table</a><br><br>

	<p class="demo-explain">
		This page does not sanitize input, and uses a numbered return in PHP to grab data from MySQL.<br>
		The following code performs the work:
		<pre><code>
		$username = $_REQUEST['username'];

		$sqlQry = "SELECT DATE(datetime) AS Date, TIME(datetime) AS Time, ipaddr, success FROM logins WHERE username LIKE '{$username}' ORDER BY id DESC";

		$out = mysqli_query(db_connect(false), $sqlQry);

		//table head gen

		while($row = mysqli_fetch_array($out)){
			$success = $row[3] == 1 ? "Succeeded" : "Failed";

			$outDoc .= <<&#60HTML
			&#60tr>
				&#60td>{$row[0]}&#60/td>
				&#60td>{$row[1]}&#60/td>
				&#60td>{$row[2]}&#60/td>
				&#60td>{$success}&#60/td>
			&#60/tr>
			HTML;

		}

		//table footer gen and echo
		</code></pre>

		The pseudo-code steps are as follows:<br><br>

		<ol class="list-group">
			<li class="list-group-item">
				Retrieve the username to filter from the POST
			</li>
			<li class="list-group-item">
				Fill in the query (no sanitization performed, and no preparation means injection ready!)
			</li>
			<li class="list-group-item">
				Issue the query, and then generate the table
			</li>
			<li class="list-group-item">
				Table generation uses mysqli_fetch_array, which returns a numbered array of results in the order specified in the SQL statement.
				So for this one, the Date = $row[0], the Time = $row[1], and so on.
			</li>
		</ol>
	</p>
	<br><hr><hr><br>

	<h3>Lookup</h3><br>
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
                type : "numbered"
            };

            post('searchfn.php', formData, function(res, xhr){
                document.getElementById('resDiv').innerHTML = res;
            });
        }
    }
</script>
</html>
