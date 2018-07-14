$(document).ready(function(){
  setTimeout(function() {

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
  }, 200);
});

$('#wesic-wysiwyg').trumbowyg({
  lang: 'fr',
});

$.trumbowyg.svgPath = './trumbowyg/ui/icons.svg';



var countChecked = function() {
  var n = $( "input:checked" ).length;
  var inputs = $(this).parent().find('input[value=""]');
  $('input:checkbox').not(this).prop('checked', this.checked);

  if (!inputs.length) {
        // you have empty fields if this section is reached
      }
  // alert(n);
};
countChecked();

$( "#checkAll" ).on( "click", countChecked );

// $("#checkAll").on( "click", function(){
//     $('input:checkbox').not(this).prop('checked', this.checked);
// } );



var selected = [];
$('#checkboxes input:checked').each(function() {
  selected.push($(this).attr('name'));
});





$(document).ready(function(){
  setTimeout(function() {
    document.getElementById("loader-wrapper").style.display = "none";
  }, 400);
});


$('#close-modal').onclick = function() {
  document.getElementById('myModal').style.display = "none";
}

window.onclick = function(event) {
  if (event.target == document.getElementById('myModal')) {
    document.getElementById('myModal').style.display = "none";
  }  
  if (event.target == document.getElementById('featuredModal')) {
    document.getElementById('featuredModal').style.display = "none";
  }  
  if (event.target == document.getElementById('allMediasModal')) {
    document.getElementById('allMediasModal').style.display = "none";
  }
}

function insertMedia(){
  document.getElementById('allMediasModal').style.display = "block";
}

function chooseFeatured(){
  document.getElementById('featuredModal').style.display = "block";
}


function deleteModalCategory(id){
  var modal = document.getElementById('myModal');
  elementname = document.getElementById(id).childNodes[3].childNodes[0].innerHTML;
  document.getElementById('modal-body').innerHTML = "Voulez vous vraiment supprimer <i>'"+elementname+"'</i> ?";
  document.getElementById('modal-helper').innerHTML = "Cette action supprimera la catégorie de tous vos articles";
  document.getElementById('valid-action').setAttribute('href','supprimer-categorie/id/'+id);
  modal.style.display = "block";

}

function deleteModalArticle(id){

  var modal = document.getElementById('myModal');
  elementname = document.getElementById(id).childNodes[3].childNodes[0].innerHTML;
  document.getElementById('modal-body').innerHTML = "Voulez vous vraiment supprimer <i>'"+elementname+"'</i> ?";
  document.getElementById('modal-helper').innerHTML = "Cette action supprime définitivement cet article";
  document.getElementById('valid-action').setAttribute('href','supprimer-article/id/'+id);
  modal.style.display = "block";

}

function deleteModalPage(id){

  var modal = document.getElementById('myModal');
  elementname = document.getElementById(id).childNodes[3].childNodes[0].innerHTML;
  document.getElementById('modal-body').innerHTML = "Voulez vous vraiment supprimer <i>'"+elementname+"'</i> ?";
  document.getElementById('modal-helper').innerHTML = "Cette action supprime définitivement cette page";
  document.getElementById('valid-action').setAttribute('href','supprimer-page/id/'+id);
  modal.style.display = "block";

}

function deleteModalUser(id){

  var modal = document.getElementById('myModal');
  elementname = document.getElementById(id).childNodes[3].childNodes[0].innerHTML;
  document.getElementById('modal-body').innerHTML = "Voulez vous vraiment supprimer <i>'"+elementname+"'</i> ?";
  document.getElementById('modal-helper').innerHTML = "Cette action deplace l'utilisateur à la corbeille";
  document.getElementById('valid-action').setAttribute('href','supprimer-utilisateur/id/'+id);
  modal.style.display = "block";

}


function slugify(text)
{
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')           // Replace spaces with -
    .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
    .replace(/\-\-+/g, '-')         // Replace multiple - with single -
    .replace(/^-+/, '')             // Trim - from start of text
    .replace(/-+$/, '');            // Trim - from end of text
  }



  var drake = dragula([document.querySelector('#left'), document.querySelector('#right')],{
    moves: function (el, container, handle) {
      return handle.classList.contains('handle');
    }
  });


  drake.on('drop', drop);

  function drop (el, to, from) {

   var leftCount = document.getElementById('left').childElementCount;
   var rightCount = document.getElementById('right').childElementCount;
   
   if(leftCount == 0 || rightCount == 0){
    drake.cancel(true);
  }


  var leftCount = document.getElementById('left').childElementCount;
  var rightCount = document.getElementById('right').childElementCount;

  var list =document.getElementsByClassName('draggable');

  saveDashboardOrder(list,leftCount,rightCount);

}

$('#tags-input').keydown(function(e){         
  if(e.which == 13){ 
    event.preventDefault();
    
    var val = $('#tags-input').val();
    $('#tags-input').val('');
    
    var myRegxp = /^([a-zA-ZÀ-ÿ0-9_-]+)$/;
    
    if(myRegxp.test(val)==false)
    {
     return false;
   }


   if(val.length < 3 || val.length > 30){
    return false;
  }

  var tagsHtml = document.getElementsByClassName('tag-element');
  var i;
  var tags = [];
  var x = document.getElementsByName("tags");

  for (i = 0; i < tagsHtml.length; i++) {
    tags.push(tagsHtml[i].innerText);
  }

  if(tags.indexOf(val) == "-1" || !val.indexOf(" ")){
    $('.tag-list').append('<li class="tag-element">'+val+'<span class="icon-cross tag-close" onclick="deleteTag(this)"></span></li>');
    tags.push(val);
    x[0].value = JSON.stringify(tags);
  }
}        
});

function deleteTag(e){
  $(e).parent().remove();
}

function selectMedia(id,type){

  $('#'+id).toggleClass('selected-media-item');

  var insertedMedia = $('#toInsert').attr('value');
  
  if(insertedMedia != undefined){
    insertedMedia = JSON.parse(insertedMedia);
    insertedMediaCount = insertedMedia.length;
  }else{
    insertedMediaCount = 0;
  }

  var mediasId = new Array();

  for (i = 0; i < insertedMediaCount; i++) {
    mediasId.push(insertedMedia[i]); 
  }

  mediasId.push(id);

  $('#media-count').html(mediasId.length);

  $('#toInsert').attr('value',JSON.stringify(mediasId));

}

function insertSelection(){
  var mediasIdRaw = $('#toInsert').attr('value');
  var mediasId = JSON.parse(mediasIdRaw);

  mediasId.forEach(function(element) {
    var current = $('#'+element);
    current.toggleClass('selected-media-item');

    if(current.attr('type')=='1'){
      $('#wesic-wysiwyg').append('<img src="/'+current.attr('path')+'">');
    }    
    if(current.attr('type')=='2'){
      $('#wesic-wysiwyg').append('<iframe width="420" height="315" src="https://www.youtube.com/embed/'+current.attr('path')+'"></iframe');

    }    
    if(current.attr('type')=='3'){
      $('#wesic-wysiwyg').append('<audio controls><source src="/'+current.attr('path')+'" type="audio/mpeg"></audio>');
    }
  });

  $('#toInsert').attr('value','');
  $('#media-count').html('0');
  
  document.getElementById('allMediasModal').style.display = "none";



}

function selectImage(id){
  $('#feature-image').attr('value',id);
  $('#feature-image').attr('src',$('#'+id).attr('src') );
  $('#featuredModal').css('display','none');
}
