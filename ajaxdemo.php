<?php include_once('includeLoginCheck.php'); ?>
<html>
	<head>
		<?php include_once('includehead.php'); ?>
    	<title>AJAX Demo</title>
		<script src="validation.js"></script>
  	</head>
  	<body>
    	<div class="container mb-5">
			<div class="mt-5">
				<h3>AJAX Demo</h3>
                <a href="landing.php" class="btn-sm btn-danger">Return</a>
                <a class='btn-sm btn-secondary' href="#resDiv">Goto results</a><br><br>
				
				<p class="demo-explain">
                The purpose of this page is to show some of the basics of how AJAX works, and some ways it can be used maliciously.<br>
                The basic principle of AJAX is that you can use it to send form data just like with regular HTML forms, but to arbitrary pages.<br>
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

                function submit(){
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
                    <li class="list-group-item">
                        The submit function generates the data from the inputs, issues the post() function to a given URL, and then displays the results
                    </li>
                </ol>
				</p>
				
				<div class="form-cont"><br><br>
                    <div class="row">
                        <div class="col">
                            <label for="paramName">Parameter Name 1:</label>
                            <input type="text" class="form-control" id="paramName1" name="paramName1" placeholder="Forged Parameter">
                            <div class="feedback" id="searchData-feed"></div>
                        </div>
                        <div class="col">
                            <label for="searchData">Data 1:</label>
                            <input type="text" class="form-control" id="searchData1" name="searchData1" placeholder="Forged Data">
                            <div class="feedback" id="searchData-feed"></div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label for="paramName">Parameter Name 2:</label>
                            <input type="text" class="form-control" id="paramName2" name="paramName2" placeholder="Forged Parameter">
                            <div class="feedback" id="searchData-feed"></div>
                        </div>
                        <div class="col">
                            <label for="searchData">Data 2:</label>
                            <input type="text" class="form-control" id="searchData2" name="searchData2" placeholder="Forged Data">
                            <div class="feedback" id="searchData-feed"></div>
                        </div>
                    </div><br>
					
					<div class="form-group">
						<label for="fileUp">File Input:</label>
						<input type="file" class="form-control-file" id="fileUp" name="fileUp" >
						<div class="feedback" id="fileUp-feed"></div>
					</div>
					
					<div class="form-group">
						<label for="destURL">Destination URL:</label>
						<input type="text" class="form-control" id="destURL" name="destURL" placeholder="Injection Site">
						<div class="feedback" id="searchData-feed"></div>
					</div>
               		<button class="btn btn-primary" onclick="submit()">Send Data</button>
				</div><br>
				
				<hr><hr><br>
				
				<h3>Results</h3>
				<div id="resDiv"></div>
				
			</div>
    	</div>
  	</body>
    <script>
        function submit(){
            let resDiv = document.getElementById('resDiv'),
                resSucc = true,
                fileUp = document.getElementById('fileUp');
		
            if(resSucc){
                let formObj = {
                    [document.getElementById('paramName1').value] : document.getElementById('searchData1').value,
                    [document.getElementById('paramName2').value] : document.getElementById('searchData2').value,
                    [fileUp.name] : fileUp.files[0],
                };

                post(document.getElementById('destURL').value, formObj, function(res, xhr){
                    resDiv.innerHTML = res;
                });
            }
        }
    </script>
</html>
