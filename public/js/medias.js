document.addEventListener('DOMContentLoaded',initMedia);

function initMedia(){
  var medias =  Array.from(document.querySelectorAll('.media-preview-bloc'));
  var selectFilterMedia = document.querySelector('#filter-media');
  selectFilterMedia.addEventListener('change', filterMedia);
  medias.forEach(function(elem) {
      elem.addEventListener("click", function() {
        createModal(elem);
      });
  });
}

function filterMedia(evt){
  var url = 'http://'+window.location.hostname;
  var selectFilterMedia = document.querySelector('#filter-media');
  var filterValue = selectFilterMedia.value;
  let redirectUrl;
  console.log(filterValue);
  if(filterValue == 0){
    redirectUrl = url + '/admin/medias';
  } else if(filterValue == 1 || filterValue == 2 || filterValue == 3){
    console.log('in');
    redirectUrl = url + '/admin/medias/filter/' + filterValue;
  }
  window.open(redirectUrl,'_self');
}

function createModal(media){
  var body = document.querySelector('body');
  var focus = document.createElement('div');
  var modal = document.createElement('div');
  var cross = document.createElement('div');
  var element;
  var type = media.dataset.type;

  focus.classList.add('modal-focus');
  modal.classList.add('modal-media');
  cross.classList.add('media-cross');

; focus.addEventListener('click',function(){
    deleteModal(modal,focus);
  });

  cross.addEventListener('click',function(){
    deleteModal(modal,focus);
  });

  if(type === 'image'){
    element = document.createElement('img');
    element.src = media.firstElementChild.src;
  } else if(type === 'video'){
    element = document.createElement('iframe');
    element.src = "https://www.youtube.com/embed/"+media.dataset.src;
  } else if(type === 'music'){
    element = document.createElement('audio');
    element.controls="controls";
    element.preload="none";
    source = document.createElement('SOURCE');
    source.src = media.dataset.src;
    element.appendChild(source);
  }
  
  modal.appendChild(cross);
  modal.appendChild(element);
  
  body.appendChild(focus);
  body.appendChild(modal);
}

function deleteModal(modal,focus){
  var body = document.querySelector('body');
  body.removeChild(modal);
  body.removeChild(focus);
}


function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}