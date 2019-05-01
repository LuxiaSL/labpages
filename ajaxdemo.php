<?php include_once('includeLoginCheck.php'); ?>
<html>
	<head>
		<?php include_once('includehead.php'); ?>
    	<title>AJAX Demo</title>
		<script src="validation.js"></script>
  	</head>
  	<body>
    	<div class="container">
			<div class="text-center mt-5">
				<h3>AJAX Demo</h3><br>
				
				<p class="demo-explain">
					The purpose of this page is to show some of the basics of how AJAX works, and some ways it can be used maliciously.<br>
					The basic priniciple of AJAX is that you can use it to send form data just like with regular HTML forms, but to arbitrary pages.<br>
					The code doing the AJAX work is complicated, but included below:
					<pre><code>
					function post(destURL, data, callback){
						let xhttp, formData;
						xhttp = new XMLHttpRequest();
						formData = new FormData();

						xhttp.onreadystatechange = function(){
							if(this.readyState == 4){
								if(this.status == 200){
									callback ? callback(this.responseText, this) : console.log("POST succeeded");
								}else{
									console.log(`Something went wrong with the request, response status: ${this.status}, text: ${this.statusText}`);
								}
							}
						};

						xhttp.open('POST', destURL, true);

						for(let entry in data){
							if(data.hasOwnProperty(entry)){
								formData.append(entry, data[entry]);
							}
						}

						xhttp.send(formData);
					}
					</code></pre>
				
					The pseudo-code steps are as follows:<br><br>

					<ol class="list-group">
						<li class="list-group-item">
							Create the request object to be sent over POST, and the data object to be sent.
						</li>
						<li class="list-group-item">
							Establish a function that does something with the result of the POST. In this specifically, it passes the result
							into a function passed by the developer, or logs the error.
						</li>
						<li class="list-group-item">
							Open the POST request to the given site
						</li>
						<li class="list-group-item">
							Generate the data for the forged request, and then send it using the request object.
						</li>
					</ol>
				</p>
				
				<div class="form-cont"><br><br>
					<div class="form-group">
						<label for="searchData">Search Data:</label>
						<input type="text" class="form-control" id="searchData" name="searchData" placeholder="Forged Data">
						<div class="feedback" id="searchData-feed"></div>
					</div>
					
					<div class="form-group">
						<label for="fileUp">File Input:</label>
						<input type="file" class="form-control" id="fileUp" name="fileUp" >
						<div class="feedback" id="fileUp-feed"></div>
					</div>
					
					<div class="form-group">
						<label for="destURL">Destination URL:</label>
						<input type="text" class="form-control" id="destURL" name="destURL" placeholder="Injection Site">
						<div class="feedback" id="searchData-feed"></div>
					</div>
               		<button class="btn btn-primary" onclick="submit()">Send Data</button>
				</div><br>
				
				<hr><br><hr><br>
				
				<h3>Results</h3>
				<div id="resDiv"></div>
				
			</div>
    	</div>
  	</body>
    <script>
        let htmlInp = {
            fileUp : document.getElementById('fileUp'),
            searchData : document.getElementById('searchData'),
            destURL : document.getElementById('destURL'),
        };

        function submit(){
            let resDiv = document.getElementById('resDiv'),
                resSucc = true;
			ValidateEl(htmlInp.fileUp, false);
			ValidateEl(htmlInp.searchData, false);
			ValidateEl(htmlInp.destURL, false);
		
            if(resSucc){
                let formObj = {
                    [htmlInp.username.name] : htmlInp.username.value,
                    [htmlInp.fileUp.name] : htmlInp.fileUp.files[0]
                };

                post(htmlInp.destUrl.value, formObj, function(res, xhr){
                    resDiv = res;
                });
            }
        }
    </script>
</html>
