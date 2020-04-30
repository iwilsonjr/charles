// Initialization
const localPath = "/wp-content/themes/charles-child/";
const html = document.querySelector("html");
const body = document.querySelector("body");
const archives = document.getElementById("archives");
const inputSearch = document.getElementById("inputSearch");
const container = document.querySelector(".container");
const ajaxWindow = document.querySelector(".ajaxWindow");
const btnNavigation = document.getElementById('btnNavigation');
const navFind = document.querySelector("[href='#find']");
const navContact = document.querySelector("[href*='contact/']");
const selectMonth = document.getElementById("selectMonthArchive");
const search = document.getElementById("search");
let message = "";



//JS check for navigation placement
if (html.className.indexOf("no-js") > -1) {
    html.removeAttribute("class");
}

//Open navigation in moble/tablet space
btnNavigation.addEventListener("click", function() {
    openNavigation();
});

//Open navigation in desktop space
navFind.addEventListener("click", function() {
    openNavigation();
});

//Open navigation functionality
function openNavigation() {
    container.classList.toggle("jsNavOpen");
    navContact.parentElement.classList.remove("selected");
    navFind.parentElement.classList.toggle("selected");
    event.preventDefault();
};

//Select Month validation
selectMonth.addEventListener("click", function() {
    if (archives.value === "Select Month/Year") {
        event.preventDefault();
        if (document.querySelector("#archivesForm span") === null) {
            message = `<span class="error" id="archivesError" aria-live="polite">Please select a date.</span>`;
            archives.setAttribute("aria-describedby", "archivesError");
            archives.insertAdjacentHTML('beforebegin', message);
            archives.classList.add("errorField");
            archives.focus();
        };
    };
});

//Search form validation
search.addEventListener("click", function() {
    if (inputSearch.value.trim() === "") {
        event.preventDefault();
        if (document.querySelector("#searchForm span") === null) {
            message = `<span class="error" id="searchError" aria-live="polite">Please type some text.</span>`;
            inputSearch.setAttribute("aria-describedby", "searchError");
            inputSearch.insertAdjacentHTML('beforebegin', message);
            inputSearch.classList.add("errorField");
            inputSearch.focus();
        };
    };
});

//Contact Window
navContact.addEventListener("click", function() {

    event.preventDefault();

    console.log("contact link");

    const contactLink = navContact.parentElement;

    if (!contactLink.classList.contains("selected")) {

        console.log("contact link selected")

        if (container.classList.contains("jsNavOpen")) {
            container.classList.remove("jsNavOpen");
            navFind.parentElement.classList.toggle("selected");

            console.log("find nav replaced")
        }

        if (document.querySelector(".ajaxWindow") === null) {
            var openContact = `<div class="ajaxWindow" aria-live="polite"><div class="loading"><img src="${localPath}images/content/loading.png" width="163" height="163" alt="Loading..." /></div></div>`;
            body.insertAdjacentHTML('afterend', openContact);
        }

    }

});