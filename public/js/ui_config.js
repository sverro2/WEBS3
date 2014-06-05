$( document ).ready(function() {
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
         console.log(child);
         child.toggle("blind");
      });

});

