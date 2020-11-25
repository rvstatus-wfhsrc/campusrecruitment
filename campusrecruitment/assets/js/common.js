// $('body').after('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
 //  $(window).on('load', function(){
 //      setTimeout(removeLoader, 2000); //wait for page load PLUS two seconds.
 //  });
 //  function removeLoader(){
 //      $( "#loadingDiv" ).fadeOut(500, function() {
 //        // fadeOut complete. Remove the loading div
 //        $( "#loadingDiv" ).remove(); //makes page more lightweight 
 //    });  
 //  }
  //  $(window).load(function(){
  //     $("#loader").fadeOut("slow");
  //  });
  // $(window).load(function() {
  //     // Animate loader off screen
  //     $(".se-pre-con").fadeOut("slow");
  // });
$(window).on('load', function() {
	$("#loader").fadeOut(1500);
});
function removeLoader() {
	$("div").removeClass("dispNone");
	$(window).ready(); 
}
setTimeout(removeLoader, 1400);