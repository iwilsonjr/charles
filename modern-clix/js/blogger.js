// JavaScript Document

$(document).ready(function(){
//Start JQuery Code
	
	//Outside Links
	$("a.target, #text-2 a, #linkcat-2 a").click(function(){
		window.open($(this).attr("href"));
		return false;
	});		
	
//End JQuery Code
});