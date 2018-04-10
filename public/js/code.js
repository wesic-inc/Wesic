$(document).ready(function(){
  $("#hamburger-menu").click(function(){
    $(this).toggleClass("is-active");
    $('#menu').toggleClass("is-active");
  });
});

$('#wesic-demo').trumbowyg();