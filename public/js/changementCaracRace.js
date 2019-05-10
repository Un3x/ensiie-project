var menu = document.getElementById("race");

function effacer() {
var options = document.querySelectorAll('.info')
for(var i = 0; i < options.length; i++)
{
    options[i].style.display = 'none';
}
}

effacer();
document.getElementById("1").style.display="inline-block";

menu.addEventListener('change', function()

{
    effacer();
    var actuelle = document.getElementById( menu.selectedIndex.toString());
    actuelle.style.display = 'inline-block';
});
