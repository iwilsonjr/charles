// Initialization
var localPath = "/wp-content/themes/charles/";

//Navigation
if (!$("html").hasClass("ie-8")) {
	$("#btnNavigation, .navPrimary li:nth-child(3) a").on("click", function(){
		$(".container").toggleClass("jsNavOpen");
		$(".ajaxWindow").remove();
		return false;
	});
}

//Navigation Form
$("#archivesForm").on("submit", function(){
	if ($("#archives").val() == '') { 
		return false;
	}		
});

$("#searchForm").on("submit", function(){
	if ($("#inputSearch").val() == '') { 
		return false;
	}	
});	