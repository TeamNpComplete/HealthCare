$(document).ready(function(){
    var zindex = 10;
    console.log("Loaded card scroipt");
    $(".content-area .current-info .cards .card").click(function(e){
     // e.preventDefault();
        console.log("Button Clicked!");
      var isShowing = false;
  
      if ($(this).hasClass("show")) {
        isShowing = true;
      }
  
      if ($(".content-area .current-info .cards").hasClass("showing")) {
       
        $(".content-area .current-info .cards .card.show")
          .removeClass("show");
  
        if (isShowing) {
          
          $(".content-area .current-info .cards")
            .removeClass("showing");
        } else {
          
          $(this)
            .css({zIndex: zindex})
            .addClass("show");
  
        }
  
        zindex++;
  
      } else {
        
        $(".content-area .current-info .cards")
          .addClass("showing");
        $(this)
          .css({zIndex:zindex})
          .addClass("show");
  
        zindex++;
      }
      
    });
  });