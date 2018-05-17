function test(filter) {

	filterVar = filter.slice(-1);

	if($('#'+filter).attr('sort')=='DESC'){
		$('#'+filter).attr('sort','ASC');
	}else{
		$('#'+filter).attr('sort','DESC');
		filterVar = -filterVar;
	}

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('body-ajax').innerHTML = this.responseText;
		}
	};
	var url = "/admin/utilisateurs-ajax/sort/"+filterVar;
	xhttp.open("POST", url, true);
	xhttp.send();

	var params = [];

	params['sort'] = filterVar;
	params['filter'] = "";
	params['p'] = "";

	var pagePos = window.location.href.indexOf('/p/');
	var filterPos = window.location.href.indexOf('/filter/');

	if(pagePos != -1){

		var endValuePos = window.location.href.indexOf('/',pagePos+3);
		
		params['p'] = '/p/'+window.location.href.substr(pagePos+3,endValuePos-(pagePos+3));	
	}

	if(filterPos != -1){

		params['filter'] = '/filter/'+window.location.href.substr(filterPos+8,1);
	}

	var urlRoot = parseUrl(window.location.href);

	var url = window.location.href;
	if(url.substr(url.length - 1) != "/"){
		url += "/";
	}
	window.history.pushState("", "", urlRoot+params['filter']+params['p']+'/sort/'+filterVar);
}


function parseUrl(url){
	
	var urlFragment = url.split("/");

	var urlRoot = urlFragment[0]+"//"+urlFragment[2]+"/"+urlFragment[3]+"/"+urlFragment[4];
	
	return urlRoot;

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