// Initialization
var localPath = "/wp-content/themes/charles/";

$("[role='main']").on("swipeLeft", "#content", function(){
  touchTransition("next");
}); 

$("[role='main']").on("swipeRight", "#content", function(){
  touchTransition("prev");
});


function touchTransition(motion){

  //Initialization
  var targetURL = "";
  var historyTitle = $("title").text();

  //Find location/URL
  if (motion == "next") {

    if ($(".pageNavigation a").hasClass("next")) { 
      targetURL = $(".next").attr("href");      
    } else {
      targetURL = $("[rel='next']").attr("href"); 
      historyTitle = $("[rel='next']").text();
    };

  } else {

    if ($(".pageNavigation a").hasClass("prev")) { 
      targetURL = $(".prev").attr("href");      
    } else {
      targetURL = $("[rel='prev']").attr("href"); 
      historyTitle = $("[rel='prev']").text();      
    };

  }

  //If location is defined, start process.
  //If not, do nothing

  if (targetURL) {

    scrollUp();

    $("[role='main']").height($("#content").height());

    $('#content').animate({opacity: 0}, 250, 'linear', function(){ 

      $('#content').remove();

      $("[role='main']").append('<div class="loading"><img src="' + localPath + 'images/content/loading.png" width="163" height="163" alt="Loading..." /></div>');

      $("[role='main']").load(targetURL + " #content", function(){

        $('.loading').animate({opacity: 0}, 250, 'linear', function(){ 
          $(".loading").remove();
        });

        $("[role='main']").css("height","auto");
        //$("[role='main']").removeAttr("style"); 

      });       
    });
  
    History.pushState(null, historyTitle, targetURL);

  }


}

function scrollUp(){
  window.scrollTo(0, 0);  
}
