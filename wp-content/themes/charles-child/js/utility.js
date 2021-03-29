// Initialization
var localPath = "/wp-content/themes/charles-child/";
var html = document.querySelector("html");
var archives = document.getElementById("archives");
var inputSearch = document.getElementById("inputSearch");
var container = document.querySelector(".container");
var ajaxWindow = document.querySelector(".ajaxWindow");
var btnNavigation = document.getElementById('btnNavigation'); //const navFind = document.querySelector("[href*='find']");
//const lastNavItem = document.querySelector(".navPrimary li:last-child");

var selectMonth = document.getElementById("selectMonthArchive");
var search = document.getElementById("search");
var message = ""; //JS check for navigation placement

if (html.className.indexOf("no-js") > -1) {
  html.removeAttribute("class");
} //Open navigation in moble/tablet space


btnNavigation.addEventListener("click", function () {
  openNavigation();
}); //Open navigation in desktop space

/*navFind.addEventListener("click", () => {
    //openNavigation();
});*/
//Open navigation functionality

/*function openNavigation() {
    container.classList.toggle("jsNavOpen");
    //lastNavItem.parentElementclassList.toggle("selected");	
    navFind.parentElement.classList.toggle("selected");
    event.preventDefault();
};*/
//Select Month validation

selectMonth.addEventListener("click", function () {
  if (archives.value === "Select Month/Year") {
    event.preventDefault();

    if (document.querySelector("#archivesForm span") === null) {
      message = "<span class=\"error\" id=\"archivesError\" aria-live=\"polite\">Please select a date.</span>";
      archives.setAttribute("aria-describedby", "archivesError");
      archives.insertAdjacentHTML('beforebegin', message);
      archives.classList.add("errorField");
      archives.focus();
    }
  }
}); //Search form validation

search.addEventListener("click", function () {
  if (inputSearch.value.trim() === "") {
    event.preventDefault();

    if (document.querySelector("#searchForm span") === null) {
      message = "<span class=\"error\" id=\"searchError\" aria-live=\"polite\">Please type some text.</span>";
      inputSearch.setAttribute("aria-describedby", "searchError");
      inputSearch.insertAdjacentHTML('beforebegin', message);
      inputSearch.classList.add("errorField");
      inputSearch.focus();
    }
  }
});
//# sourceMappingURL=utility.js.map
