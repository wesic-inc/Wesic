jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 10) {
       jQuery("#navbar").removeClass("initial");
    } 
    if (jQuery(this).scrollTop() < 10){
       jQuery("#navbar").addClass("initial");
    }
});

$(document).ready(function(){
  $("#hamburger-menu").click(function(){
    $(this).toggleClass("is-active");
    $(this).toggleClass("not-active");
    $('#menu').toggleClass("is-active");
    $("#navbar").toggleClass("is-active");	
  });
});


$(document).keyup(function(e) {
     if (e.keyCode == 27) { 
     	$("#hamburger-menu").toggleClass("is-active");
    	$("#hamburger-menu").toggleClass("not-active");
    	$("#navbar").toggleClass("is-active");
    	$('#menu').toggleClass("is-active");
    }
});
