//Responsive menu
var content = document.querySelector('#landing-nav');
var sidebarBody = document.querySelector('#sidebar-nav');
sidebarBody.innerHTML = content.innerHTML;

//initialize variables
sidebarBody.style.display = 'none';
sidebarBody.style.opacity = '0';

//Switch menu display from "none" to "block" with fade in out animation on click. 
document.getElementById('nav-toggle').onclick = function(e){ 
    e.preventDefault();
    menuBox = document.getElementById('sidebar-nav');
    if (menuBox.style.display == 'none'){
        $("#sidebar-nav").animate({opacity: 1});
        menuBox.style.display = "block";
        document.getElementById('nav-toggle').innerHTML = "&#10005;";
    } else {
        $("#sidebar-nav").animate({opacity: 0});
        setTimeout("menuBox.style.display = 'none';",280);
        document.getElementById('nav-toggle').innerHTML = "&#9776";
        document.getElementById('nav-toggle').style.zIndex = "3";
    }
}

