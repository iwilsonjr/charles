// Initialization
const localPath = "/wp-content/themes/charles-child/";
const html = document.querySelector("html");
const archives = document.getElementById("archives");
const inputSearch = document.getElementById("inputSearch");
const container = document.querySelector(".container");
const ajaxWindow = document.querySelector(".ajaxWindow");
const btnNavigation = document.getElementById('btnNavigation');
const navFind = document.querySelector("[href='#find']");
//const lastNavItem = document.querySelector(".navPrimary li:last-child");
const selectMonth = document.querySelector("[name='selectMonthArchive']");
const search = document.querySelector("[name='search']");

//JS check for navigation placement
if (html.className.indexOf("no-js") > -1) {
    html.removeAttribute("class");
}

//Open navigation in moble/tablet space
btnNavigation.addEventListener("click", function() {
    openNavigation();
    event.preventDefault();
});

//Open navigation in desktop space
navFind.addEventListener("click", function() {
    openNavigation();
    event.preventDefault();
});

//Open navigation functionality
function openNavigation() {
    container.classList.toggle("jsNavOpen");
    //lastNavItem.parentElementclassList.toggle("selected");	
    navFind.parentElement.classList.toggle("selected");
};

//Select Month validation
selectMonth.addEventListener("click", function() {
    if (archives.value === "Select Month/Year") {
        event.preventDefault();
    }
});

//Search form validation
search.addEventListener("click", function() {
    if (trim(inputSearch.value) === "") {
        event.preventDefault();
    }
});