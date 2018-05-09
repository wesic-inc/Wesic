$(document).ready(function(){
  $("#hamburger-menu").click(function(){
    $("#hamburger-menu").toggleClass("is-active");
    $('#navbar').toggleClass("collapsed");
    $('#navbar').toggleClass("toggled");
    $('#hamburger-menu').toggleClass("collapsed");
    $('#main-container').toggleClass("collapsed");
    $('#breadcrumb').toggleClass("collapsed");
  });
  $(".dropdown-link").click(function(){
    $(this).toggleClass("is-open");
  });
  $("#navbar").hover(
    function () {
     if(!$("#hamburger-menu").hasClass('is-active')){

       $('#navbar').removeClass("collapsed");
       $("#hamburger-menu").toggleClass("collapsed");
       $('#breadcrumb').toggleClass("collapsed");
       $('#navbar').toggleClass("toggled");

     }
   },
   function () {
     if(!$("#hamburger-menu").hasClass('is-active')){
      $('#navbar').addClass("collapsed");
      $("#hamburger-menu").toggleClass("collapsed");
      $('#breadcrumb').toggleClass("collapsed");
      $('#navbar').toggleClass("toggled");

    }
  }
  );
});

$('#wesic-wysiwyg').trumbowyg({
  lang: 'fr'
});

$.trumbowyg.svgPath = './trumbowyg/ui/icons.svg';