

$("video").prop('muted', true);

  $("#mute-video").click( function (){
    if( $("video").prop('muted') ) {
          $("video").prop('muted', false);
    } else {
      $("video").prop('muted', true);
    }
});
  
  
  
   $(document).ready(function(){
     $("#show_content").click(function(){
        $("#d_container").show(500);
     });
  
     $("#close").click(function(){
        $("#d_container").hide(500);
     });
  
  });
  
  
  
  


  


