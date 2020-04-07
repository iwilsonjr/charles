// Initialization
var localPath = "/wp-content/themes/charles-child/";

$("main").on("swipeLeft", "#content", function(){
  touchTransition("next");
}); 

$("main").on("swipeRight", "#content", function(){
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

    $("main").height($("#content").height());

    $('#content').animate({opacity: 0}, 250, 'linear', function(){ 

      $('#content').remove();

      $("main").append('<div class="loading"><img src="' + localPath + 'images/content/loading.png" width="163" height="163" alt="Loading..." /></div>');

      $("main").load(targetURL + " #content", function(){

        $('.loading').animate({opacity: 0}, 250, 'linear', function(){ 
          $(".loading").remove();
        });

        $("main").css("height","auto");
        //$("main").removeAttr("style"); 

      });       
    });
  
    History.pushState(null, historyTitle, targetURL);

  }


}

function scrollUp(){
  window.scrollTo(0, 0);  
}
