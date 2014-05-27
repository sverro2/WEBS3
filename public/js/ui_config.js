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
      $('.datetimefield').datetimepicker({step:15});

      /*---------------------------FACEBOOK EVENT INFO-----------------------------*/
      $('#fb-event-submit').click(function(){
         var fb_id = $('#fb-event-id').val();
         fb_process(fb_id);
      });

      $('#addrulebtn').click(function(){
         var rule = $('#addRule').val();
         var val = $('#addVal').val();
         $('#addRule').val('');
         $('#addVal').val('');
         console.log('adding ' + rule + ', ' + val);
         addRuleRow(rule, val);
      });

      $(document).on('click','.deleterulebtn',function(){
         console.log('deleting');
         $('.deleterulebtn').parents('.rulerow:last').remove();
      });
});

