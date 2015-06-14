$(document).ready(function(){
    $('#pins').imagesLoaded(function(){
        $('#pins').masonry({
          itemSelector: '.box',
          isFitWidth: true,
          isAnimated: true
        });
    });
});
