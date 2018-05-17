$(document).ready(function(){
  $("#hamburger-menu").click(function(){
    $("#hamburger-menu").toggleClass("is-active");
    $('#navbar').toggleClass("collapsed");
    $('#navbar').toggleClass("toggled");;
    $('#main-container').toggleClass("collapsed");
    $('#second-navbar').toggleClass("collapsed");
    if($('#navbar').hasClass("toggled") == true){
      document.cookie = "toggled-sidebar=false;path=/";
    }else{
      document.cookie = "toggled-sidebar=true;path=/";
    }
  });
  $(".dropdown-link").click(function(){
    $(this).toggleClass("is-open");
  });
  $("#navbar").hover(
    function () {
     if(!$("#hamburger-menu").hasClass('is-active')){
       $('#navbar').removeClass("collapsed");
       $('#navbar').toggleClass("toggled");
       $('#second-navbar').toggleClass("collapsed");
     }
   },
   function () {
     if(!$("#hamburger-menu").hasClass('is-active')){
      $('#navbar').addClass("collapsed");
      $('#second-navbar').toggleClass("collapsed");
      $('#navbar').toggleClass("toggled");

    }
  }
  );
});

$('#wesic-wysiwyg').trumbowyg({
  lang: 'fr'
});

$.trumbowyg.svgPath = './trumbowyg/ui/icons.svg';


function viewMedia(idMedia){
  $('body').toggleClass('modal-open');
  $('.modal').toggleClass('modal-closed');
  $('.modal-overlay').toggleClass('modal-closed');
}

