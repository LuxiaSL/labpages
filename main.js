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
	
	xhttp.open('POST', url, true);
	
	for(let entry in data){
		if(data.hasOwnProperty(entry)){
			formData.append(entry, data[entry]);
		}
	}
	
	xhttp.send(formData);
}
