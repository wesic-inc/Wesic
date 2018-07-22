function test(filter) {
	
	var params = jQuery.parseJSON($('#params').val());



	filterVar = filter.slice(-1);

	if($('#'+filter).attr('sort')=='DESC'){
		$('#'+filter).attr('sort','ASC');
	}else{
		$('#'+filter).attr('sort','DESC');
		filterVar = -filterVar;
	}

	$("#filter1").removeClass();
	$("#filter2").removeClass();
	$("#filter3").removeClass();
	$("#filter4").removeClass();
	$("#filter5").removeClass();


	$('#'+filter).toggleClass("active-sort");
	$('#'+filter).children().toggleClass("icon icon-sort-alpha-asc");
	$('#'+filter).children().toggleClass("icon icon-sort-alpha-desc");

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById('body-ajax').innerHTML = this.responseText;
		}
	};

	var paramString = ""
	params['p'] = 1;
	params['sort'] = filterVar;
	var perPage = params['perPage']
	
	delete params['perPage'];

	for (var param in params){
		paramString += "/"+param+"/"+params[param];
	}

	var url = "/admin/utilisateurs-ajax"+paramString+"/perPage/"+perPage;
	xhttp.open("POST", url, true);
	xhttp.send();

	var urlRoot = parseUrl(window.location.href);

	var url = window.location.href;
	if(url.substr(url.length - 1) != "/"){
		url += "/";
	}

	window.history.pushState("", "", urlRoot+paramString);
}

function test2(filter) {

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
	var url = "/admin/articles-ajax/sort/"+filterVar;
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


function append_flash_session(type,title,body){
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open('POST','/admin/add-flash-session-ajax/type'+type+'/body'+body+'/title'+title, true);
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState == 4){
			if(xmlhttp.status == 200){

			}
		}
	};
	xmlhttp.send(null);
}


function dismissWelcome(){
	document.getElementById('welcome-bloc').remove();
	
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open('POST','/admin/block-dismiss/type/welcome', true);
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState == 4){
			if(xmlhttp.status == 200){

			}
		}
	};
	xmlhttp.send(null);

}
function dismissLinks(){
	document.getElementById('links-bloc').remove();

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open('POST','/admin/block-dismiss/type/links', true);
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState == 4){
			if(xmlhttp.status == 200){

			}
		}
	};
	xmlhttp.send(null);

}

function saveDashboardOrder(list,leftCount,rightCount){

	var leftParams = "";
	var rightParams = "";

	for(i=0;i<leftCount;i++){
		leftParams += list[i].getAttribute('id');
		if(i!=leftCount-1){
		leftParams += ",";
		}
	}

	for(i=0+leftCount;i<rightCount+leftCount;i++){
		rightParams += list[i].getAttribute('id');
		if(i!=rightCount+leftCount-1){
		rightParams += ",";
		}
	}

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.open('POST','/admin/dashboard-order/left/'+leftParams+'/right/'+rightParams, true);
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState == 4){
			if(xmlhttp.status == 200){

			}
		}
	};
	xmlhttp.send(null);

}

function getPageModalMedia(page){
	

	var paginationInfos = $('#getPageModalImage').attr('value');
	var selectedElements = $('#toInsert').attr('value');
	
	var current = JSON.parse(paginationInfos);

	$('.page-item').removeClass('active');

	$.ajax({
        url: '/admin/media-modal-page-ajax/p/'+page,
        cache: false,
        data: {
		    pagination: paginationInfos,
		    selected: selectedElements
		},
        type: 'POST',
        success: function(response)
        {
            $('#media-modal-elements').html(response);
            $('#page'+page).toggleClass('active');
        }
    });
}
function getPageModalImage(page){
	
	var paginationInfos = $('#getPageModalImage').attr('value');
	
	var current = JSON.parse(paginationInfos);

	$('.page-item').removeClass('active');

	$.ajax({
        url: '/admin/image-modal-page-ajax/p/'+page,
        cache: false,
        data: {
		    pagination: paginationInfos,
		},
        type: 'POST',
        success: function(response)
        {
            $('#images-modal-elements').html(response);
            $('#page'+page).toggleClass('active');
        }
    });
}


function deleteUsersAction(){
  var ids = getSelectedRows();
  var data = JSON.stringify(ids);

  	$.ajax({
        url: '/admin/users-ajax/action/delete',
        cache: false,
        data: {
		    ids: data,
		},
        type: 'POST',
        success: function(response)
        {
            location.reload();
        }
    });
}

function banUsersAction(){

  var ids = getSelectedRows();
  var data = JSON.stringify(ids);

  	$.ajax({
        url: '/admin/users-ajax/action/ban',
        cache: false,
        data: {
		    ids: data,
		},
        type: 'POST',
        success: function(response)
        {
            location.reload();
        }
    });
}

function unPublishPostAction(){
  var ids = getSelectedRows();
  var data = JSON.stringify(ids);

  	$.ajax({
        url: '/admin/articles-ajax/action/unpublish',
        cache: false,
        data: {
		    ids: data,
		},
        type: 'POST',
        success: function(response)
        {
            location.reload();
        }
    });
}

function deletePostAction() {
  var ids = getSelectedRows();
  var data = JSON.stringify(ids);

  	$.ajax({
        url: '/admin/articles-ajax/action/delete',
        cache: false,
        data: {
		    ids: data,
		},
        type: 'POST',
        success: function(response)
        {
            location.reload();
        }
    });
}

function deleteCommentsAction() {
  var ids = getSelectedRows();
  var data = JSON.stringify(ids);

  	$.ajax({
        url: '/admin/comments-ajax/action/delete',
        cache: false,
        data: {
		    ids: data,
		},
        type: 'POST',
        success: function(response)
        {
            location.reload();
        }
    });
}

function disapproveCommentsAction() {
  var ids = getSelectedRows();
  var data = JSON.stringify(ids);

  	$.ajax({
        url: '/admin/comments-ajax/action/disapprove',
        cache: false,
        data: {
		    ids: data,
		},
        type: 'POST',
        success: function(response)
        {
            location.reload();
        }
    });
}

function restoreCommentsAction() {
  var ids = getSelectedRows();
  var data = JSON.stringify(ids);

  	$.ajax({
        url: '/admin/comments-ajax/action/restore',
        cache: false,
        data: {
		    ids: data,
		},
        type: 'POST',
        success: function(response)
        {
            location.reload();
        }
    });
}

function approveCommentsAction() {
  var ids = getSelectedRows();
  var data = JSON.stringify(ids);

  	$.ajax({
        url: '/admin/comments-ajax/action/approve',
        cache: false,
        data: {
		    ids: data,
		},
        type: 'POST',
        success: function(response)
        {
            location.reload();
        }
    });
}

