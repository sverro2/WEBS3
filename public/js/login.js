$( document ).ready(function() {
	//show the login form when the sign in button is clicked
   	$('#signin').click(function(){
   		$('#loginModal').show(150);
   	});

      //close the loginform when either one of the close buttons are clicked, or the area outside the form
      /*
      $('#loginModal').on('click', function(){
   		$('#loginModal').hide(150);
   		console.log('clickie');
   	});
      */
   	//make sure that clicking the form itself won't close it
   	//$(".modal-dialog").click(function(e) { e.stopPropagation(); });

      $('#loginModal').on('click', '.closeform', function(){
         $('#loginModal').hide(150);
         console.log('closing');
      });

});