<?php
session_start();
$_SESSION['adresse'] = "hugo.php";
if (!isset($_SESSION['authent']) || $_SESSION['authent']==0) header("Location: accueil.php");
?>

<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Firewolf</title>
<link rel="icon" type="image/png" href="logo.png" id="im" />
<link rel="stylesheet" href="style.css"/>
</head>

<nav>
  <?php
if ($_SESSION['statut']=='M') {
    echo "
    <ul class=\"topnav\">
    <li><a href=\"accueil.php\">Home</a></li>
    <li><a href=\"profil.php\">Profil</a></li>
    <li><a href=\"pageMembre.php\">Membres</a></li>
    <li><a href=\"inscrits.php\">Inscrits</a></li>
    <li><a href=\"nathane/gain.php\">Nathane</a></li>
    <li><a href=\"aime/comment.php\">Aimé</a></li>
    <li class=\"right\"><a href=\"deconnexion.php\">Déconnexion</a></li>
    </ul>";
}
else {
    echo "
    <ul class=\"topnav\">
    <li><a href=\"accueil.php\">Home</a></li>
    <li><a href=\"profil.php\">Profil</a></li>
    <li><a href=\"rn_tmp.php\">Rejoins-nous</a></li>
    <li class=\"right\"><a href=\"deconnexion.php\">Déconnexion</a></li></ul>";
}
?>
</nav>

<script>
function play()
{
var speed = 150;
var rect_w = 45; 
var rect_h = 30; 
var c_score = 50; 
var snake_color = "#006699";
var z;
var d = []; 
var x_j= [-1, 0, 1, 0];
var y_j= [0, -1, 0, 1]; 
var q= [];
var food = 1; 
var p = [];
var r = Math.random;
var X = 5 + (r() * (rect_w - 10))|0; 
var Y = 5 + (r() * (rect_h - 10))|0;
var direction =r() * 3 | 0;
var interval = 0;
var score = 0;
var som = 0, f = 0;
var i, j;
var c = document.getElementById('playArea');
z = c.getContext('2d');


for (i = 0; i < rect_w; i++)
{
p[i] = [];
}

		
function rand_food()
{
var x, y;
do
{
x = r() * rect_w|0;
y = r() * rect_h|0;
}
while (p[x][y]);
p[x][y] = 1;
z.fillStyle = snake_color;
z.strokeRect(x * 10+1, y * 10+1, 8, 8);
}

		
rand_food();
function set_game_speed()
{
if (f)
{
X = (X+rect_w)%rect_w;
Y = (Y+rect_h)%rect_h;
}
--c_score;
if (d.length)
{
j = d.pop();
if ((j % 2) !== (direction % 2))
{
direction = j;
}
}
if ((f || (0 <= X && 0 <= Y && X < rect_w && Y < rect_h)) && 2 !== p[X][Y])
{
if (1 === p[X][Y])
{
score+= Math.max(5, c_score);
c_score = 50;
rand_food();
food++;
}

z.fillRect(X * 10, Y * 10, 9, 9);
p[X][Y] = 2;
q.unshift([X, Y]);
X+= x_j[direction];
Y+= y_j[direction];
if (food < q.length)
{
j = q.pop()
p[j[0]][j[1]] = 0;
z.clearRect(j[0] * 10, j[1] * 10, 10, 10);
}
}
else if (!d.length)
{
var message = document.getElementById("message");
if (score>=100) {
  message.innerHTML = "Thank you for playing game.<br /> Your Score : <b>"+score+"</b><br /><br /><input type='button' value='Play Again' onclick='window.location.reload();' /><br><form action=\"finalPage.php\" class=\"center\"><br/><button type=\"submit\">Étape suivante</button></form><br/>";
}
else message.innerHTML = "Thank you for playing game.<br /> Your Score : <b>"+score+"</b><br /><br /><input type='button' value='Play Again' onclick='window.location.reload();' />";
document.getElementById("playArea").style.display = 'none';
window.clearInterval(interval);
}
}
interval = window.setInterval(set_game_speed, speed);
document.onkeydown = function(e) {
var m = e.keyCode - 37;
if (0 <= m && m < 4 && m !== d[0])
{
d.unshift(m);
}
else if (-5 == m)
{
if (interval)
{
window.clearInterval(interval);
interval = 0;
}
else
{
interval = window.setInterval(set_game_speed, 60);
}
}
else
{
j = som + m;
if (j == 44||j==94||j==126||j==171) {
som+= m
} else if (j === 218) f= 1;
}
}
}
</script>

<body onload="play()" class="center">
<h1>Vous devez maintenant vous confronter à l'épreuve d'Hugzer la nouvelle monnaie !</h1>
<h1>Snake</h1>
<div id="message"></div>
<canvas id="playArea" width="500" height="500 " style="border:1px solid #000000;">Sorry your browser does not support HTML5</canvas>
</body>
</html>
