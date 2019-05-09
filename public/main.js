//Responsive menu 
//Initialize variables
var navContent = document.querySelector('#landing-nav');
var sidebarBody = document.querySelector('#sidebar-nav');
sidebarBody.style.display = 'none';

//Set dropdown menu content
sidebarBody.innerHTML = navContent.innerHTML; 
$("#sidebar-nav").append('<span id="nav-curve"></span>')
document.getElementById('nav-curve').innerHTML = document.querySelector('.curve').outerHTML;
$("#sidebar-nav #login-link").append(" &#10095; ");

//Display menu with sliding animation on click. 
document.getElementById('nav-toggle').onclick = function(e){ 
    e.preventDefault();
    menuBox = document.getElementById('sidebar-nav');
    if (menuBox.style.display == 'none'){
        $("#sidebar-nav").slideDown(100);
        $("#sidebar-nav .nav-link li").show(280);
        document.getElementById('nav-toggle').innerHTML = "&#10005;";
    } else {
        $("#sidebar-nav .nav-link li").hide(280);
        $("#sidebar-nav").slideUp(100).delay(300);
        document.getElementById('nav-toggle').innerHTML = "&#9776";
    }
}

//Change top navigation bar color when scrolling out of header
$(window).scroll(function(){
    if ($(window).scrollTop() >= $("header[id='disconnected']").height()){
        $(".sidebar-container").css("background-color","rgba(1,216,255,0.3)");
    } else {
        $(".sidebar-container").css("background-color","transparent");
    }
})


//Selective display on presentation page
$("#p1").click(function(){ //Show #paces-presentation div when clicking on #p1
    if ($("#tsps-presentation").css("display") == 'block'){
        $("#tsps-presentation").hide();
        $("#paces-presentation").fadeIn(280);
        $("#p1").css("filter","none")
        $("#p2").css("filter","grayscale(90%)")
    }
})

$("#p2").click(function(){ //Show #tsps-presentation div when clicking on #p2
    if ($("#paces-presentation").css("display") == 'block'){
        $("#paces-presentation").hide();
        $("#tsps-presentation").fadeIn(280);
        $("#p2").css("filter","none")
        $("#p1").css("filter","grayscale(90%)")
    }
})
