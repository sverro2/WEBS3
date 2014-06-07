var map;
var timer;

$( document ).ready(function() {

   /*---------------------------CASE INSENSITIVE CONTAINS-----------------------------*/
   $.expr[":"].contains = $.expr.createPseudo(function(arg) {
       return function( elem ) {
           return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
       };
   });

   /*---------------------------TUBULAR BACKGROUND-----------------------------*/
   //$('#wrap').tubular({videoId: 'CeKSL9l-Ghg', start: 46});
   $('#yt').mb_YTPlayer(
      {
         videoURL:'https://www.youtube.com/watch?v=dWZcJHmoS_k', 
         mute:true,
         startAt:15
      });
   
   /*---------------------------LOGIN WINDOW-----------------------------*/
	//show the login form when the sign in button is clicked
   	$('#signin').click(function(){
   		$('#loginModal').show(150);
   	});

      $('#loginModal').on('click', '.closeform', function(){
         $('#loginModal').hide(150);
         console.log('closing');
      });


      /*---------------------------DATEPICKER-----------------------------*/
      $('.datetimefield').datetimepicker(
         {
            step:15,
            format: 'Y-m-d h:m'
         }
      );

      /*---------------------------FACEBOOK EVENT INFO-----------------------------*/
      $('#fb-event-submit').click(function(){
         var fb_id = $('#fb-event-id').val();
         fb_process(fb_id);
      });


      /*---------------------------DRAGGABLE BANNER-----------------------------*/
      $('.eventrow .bg-banner-move').draggable({
         drag: function(event, ui) {
               var left = $('.eventrow .bg-banner').css('left');
               var top = $('.eventrow .bg-banner').css('top');
         $('#banner-top').val(top);
         $('#banner-left').val(left);
         },
         axis: 'y'

      });

      /*---------------------------SLIDE OUT DETAILS-----------------------------*/
      $('.row-content').click(function(){
         var parent = $(this).parents('.eventrow_text:last');
         var child = parent.find('.row-details');
         child.slideToggle("blind");
         var map = child.find('.map');
         var id = map.data('location');
      });

      /*---------------------------LIVE SEARCH-----------------------------*/
      $("#searchfield").keyup(function(){
          clearTimeout(timer);
          var search = function(){livesearch()};
          timer = setTimeout(search, 500);
      });

      /*---------------------------MAP MOVEMENT-----------------------------*/
      $('.map').click(function(){
        var minimap = $(this);
        var latlng = minimap.data('latlng');
        $('.slideleft').hide('slide',function(){
          $('#map-canvas').show('slide', {direction: 'right'}, function(){
            var lat = latlng.replace(/\s*\,.*/, ''); // first 123
            var lng = latlng.replace(/.*,\s*/, ''); // second ,456
            map.setCenter(new google.maps.LatLng(lat, lng));
            map.setZoom(16);
            google.maps.event.trigger(map, 'resize');
          });
        });
      });
});

