function test(filter) {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('body-ajax').innerHTML = this.responseText;
		}
	};
	xhttp.open("POST", "/admin/utilisateurs-ajax", true);
	xhttp.send();

	console.log(parseUrl(window.location.href));


	var url = window.location.href;
	if(url.substr(url.length - 1) != "/"){
		url += "/";
	}
	window.history.pushState("", "", url+'sort/'+filter);
}


function parseUrl(url){
	
	var urlFragment = url.split("/");

	var newUrl = urlFragment[0]+"//"+urlFragment[2]+""+urlFragment[2]+urlFragment[2];

	console.log(urlFragment);
	console.log(newUrl);

}


function destroyFlash(id){
	// alert(id);
	document.getElementById(id).remove();
	destroy_flash_session(id);

}

function destroy_flash_session(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open('POST','/admin/delete-flash-session-ajax', true);
    xmlhttp.onreadystatechange=function(){
       if (xmlhttp.readyState == 4){
          if(xmlhttp.status == 200){
         }
       }
    };
    xmlhttp.send(null);
}