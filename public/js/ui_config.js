var timer;
var nEvents = 8;
var loading = false;
var root_url;

$( document ).ready(function() {

   /*---------------------------ROUTING-----------------------------*/
    route();

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
         videoURL:returnYoutubeURL(), 
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
      });


      /*---------------------------DATEPICKER-----------------------------*/
      $('.datetimefield').datetimepicker(
         {
            step:15,
            format: 'Y-m-d H:i'
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
      $(document.body).on('click', '.eventrow_text', function(){
         var hash = window.location.hash;
         window.location.hash = "#event=" + $(this).attr('id');
         var parent = $(this);
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
      $('.map').click(function(){movement_openmap($(this))});
      $('#sidebar-content').on('click', '.closemap', function(){movement_closemap()});
      
      /*---------------------------MAP ADDRESS-----------------------------*/
      //submit address
      $('#adress_submit').click(function(){changeAddress()});
      $('#adress_input').keyup(function(e) {
        //alert(e.keyCode);
        if(e.keyCode == 13) {
          changeAddress();
        }
      });
      //address autosuggest
      $("#adress_input").keyup(function(){
        address_suggest();
      });

      /*---------------------------LOAD FACEBOOK IN TO EVENTROWS---------------*/
      $('.eventrow_text').each(function(){
          var fb_id = $(this).data('fb_id');
          fb_load($(this), fb_id);
      });

      /*---------------------------EVENTROW SCROLLING-----------------------------*/
      $(window).scroll(function() {
         if($(window).scrollTop() + $(window).height() == $(document).height() && !loading) {
            event_display(nEvents, 8);
         }
      });

      /*---------------------------ACTION - REMOVING LOCATION-----------------------------*/
      $('.removeLocation').click(function(event){
        var clicked = $(this);
        event.preventDefault();
        if(confirm('Weet je zeker dat je de locatie wil verwijderen?')){
          var locationId = $(this).data('location-id');
          var removeURI = $(this).data('remove-url'); 

          $.post(removeURI, {location: locationId}).done(function(value){
            if(value != "done"){
              alert('De locatie is niet verwijdert.\nEr zijn nog evenementen die van deze locatie gebruik maken');
            }else{
              clicked.closest('tr').hide();
            }
          });
        }
        });

      /*---------------------------RULESET SELECT--------------------------------*/
      $('#event-ruleset-select').change(function(){
        value = $(this).val();
        ruleset_get(value);
      });
});

function returnYoutubeURL(){
   var url = $('#yt').data('url');
   return url;
}

function route(){
  if(window.location.hash) {
    var hash = window.location.hash.substring(1);
    var hashElements = hash.split('&');
    for (var i = hashElements.length - 1; i >= 0; i--) {
      var split = hashElements[i].split('=');
      for (var i2 = split.length - 1; i2 >= 0; i2--) {
        var value = split[i2+1];
        var element = split[i2];
        switch(element) {
            case "userpos":
                {
                  set_userpos(value);
                }
                break;
            case "displaymap":
                {
                  movement_openmap_quick(value);
                }
                break;
            case "event":
                {
                  event_open(value);
                }
                break;
        }
      };
    };
    
  }
}