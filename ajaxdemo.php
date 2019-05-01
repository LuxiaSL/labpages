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
            let fileRes = ValidateEl(htmlInp.fileUp),
                forgeRes = ValidateEl(htmlInp.searchData),
                urlRes = ValidateEl(htmlInp.destURL),
                resDiv = document.getElementById('resDiv'),
                resSucc = true;

            if(!fileRes.pass){
                //do something
                resSucc = false;
            }

            if(!forgeRes.pass){
                //do something
                resSucc = false;
            }

            if(!destURL.pass){
                //do something
                resSucc = false;
            }

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
